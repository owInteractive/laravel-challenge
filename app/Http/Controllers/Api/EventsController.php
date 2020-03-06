<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\StoreRequest;
use App\Http\Requests\Api\Events\UpdateRequest;
use App\Models\Event;
use App\Support\Filter;
use Exception;
use Illuminate\Http\Request;
use Laracsv\Export;
use Throwable;

class EventsController extends Controller
{
    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->user = $request->user();
    }

    /**
     * Listar eventos.
     *
     * @return void
     */
    public function index(Filter $filter, Event $model)
    {
        $filter->setModel($model);

        # aplicar usuario no filtro
        $model->where('user_id', $this->user->id);

        return $filter->response();
    }

    /**
     * Exportar eventos
     *
     * @param Request $request
     * @return void
     */
    public function export(Request $request, Event $model)
    {
        $events = $model->whereIn('id', $request->input('events'))->get();

        $csv = app(Export::class);
        $csv->build($events, ['title' => 'Evento', 'description' => 'Descrição', 'start_at' => 'Inicio', 'close_at' => 'Fim']);

        return $csv->download();
    }

    /**
     * Cadastrar evento.
     *
     * @param StoreRequest $request
     * @return void
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

            # autorizar
            $db->commit();

            $response = response()->json($event, 201);
        } catch (Throwable $e) {
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
     * @return mixed
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
            $event->saveOrFail();

            # autorizar
            $db->commit();

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
     * @return void
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
