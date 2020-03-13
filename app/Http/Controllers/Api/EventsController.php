<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\StoreRequest;
use App\Http\Requests\Api\Events\UpdateRequest;
use App\Models\Event;
use App\Models\User;
use App\Notifications\Events\InviteUserNotification;
use App\Support\Users\Filter as UserFilter;
use Exception;
use Illuminate\Http\Request;
use Laracsv\Export;
use League\Csv\CannotInsertRecord;
use ReflectionException;
use Throwable;

class EventsController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    /**
     * @param UserFilter $filter
     * @param Event $model
     * @return mixed
     * @throws ReflectionException
     */
    public function index(UserFilter $filter, Event $model)
    {
        $filter
            ->setUser($this->user)
            ->setModel($model);

        return $filter->response();
    }

    /**
     * Exportar eventos via csv.
     *
     * @param Request $request
     * @param Event $model
     * @throws CannotInsertRecord
     * @return mixed
     */
    public function export(Request $request, Event $model)
    {
        $ids = explode(',', $request->input('events'));

        # filtrar selecionados.
        count($ids) > 0 && $model->whereIn('id', $ids);

        # obter lista
        $events = $model->get();

        $options = [
            'title' => 'Evento',
            'description' => 'Descrição',
            'start_at' => 'Inicio',
            'close_at' => 'Fim',
        ];

        /** @var Export $csv */
        $csv = app(Export::class);
        $csv->build($events, $options);

        return $csv->download();
    }

    /**
     * Cadastrar evento.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $db = app('db');
        $response = null;

        try {
            # iniciar
            $db->beginTransaction();

            $event = app(Event::class);
            $event->fill($request->all());
            $event->user()->associate($this->user);
            $event->saveOrFail();

            if ($request->has('users')) {
                # convidar usuarios.
                $event->users()->sync($request->input('users'));

                # carregar usuarios vinculados ao evento
                $event->load(['users' => function ($query) {
                    $query
                        ->select('event_user.user_id', 'users.id', 'users.name', 'users.updated_at')
                        ->orderBy('name', 'asc');
                }]);
            }

            # autorizar
            $db->commit();

            # enviar convites
            $event->users
                ->each(function (User $user) use ($event) {
                    $user->notify(new InviteUserNotification($event, $user));
                });

            $response = response()->json($event, 201);
        } catch (Throwable $e) {
            dump($e);
            # reverter
            $db->rollback();

            $response = response()->json($e->getMessage(), 400);
        } finally {
            return $response;
        }
    }

    /**
     * Atualizar evento.
     *
     * @param UpdateRequest $request
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Event $event)
    {
        $db = app('db');
        $response = null;

        try {
            # iniciar
            $db->beginTransaction();

            if ($event->status === 'close' && !$request->has('status')) {
                throw new Exception('determine o status aberto ou pendente para um evento encerrado.');
            }

            $event->fill($request->all());

            if ($request->has('users')) {
                $invites = [];

                // convidar usuarios.
                foreach ($request->input('users') as $user) {
                    if (is_array($user)) {
                        $invites[] = $user['id'];
                        continue;
                    }

                    $invites[] = $user;
                }
                # re-sincronizar
                $event->users()->sync($invites);

                # carregar usuarios vinculados ao evento
                $event->load(['users' => function ($query) {
                    $query
                        ->select('users.id', 'event_user.confirmed', 'users.name')
                        ->orderBy('name', 'asc');
                }]);
            }

            # atualizar
            $event->saveOrFail();

            # autorizar
            $db->commit();

            # notificar usuarios
            $event->users
                ->filter(function ($user) {return !$user->confirmed;})
                ->each(function (User $user) use ($event) {
                    $user->notify(new InviteUserNotification($event, $user));
                });

            $response = response()->json($event);
        } catch (Throwable $e) {
            # reverter
            $db->rollback();

            $response = response()->json($e->getMessage(), 400);
        } finally {
            return $response;
        }
    }

    /**
     * Remover evento.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Event $event)
    {
        $this->authorize('events.delete', $event);

        $db = app('db');
        $response = null;

        try {
            # iniciar
            $db->beginTransaction();

            # remover
            $event->delete();

            # autorizar
            $db->commit();

            $response = response()->json('evento removido.');
        } catch (Throwable $e) {
            # reverter
            $db->rollback();

            $response = response()->json($e->getMessage(), 400);
        } finally {
            return $response;
        }
    }
}
