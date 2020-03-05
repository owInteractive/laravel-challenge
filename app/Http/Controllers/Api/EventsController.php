<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\StoreRequest;
use App\Http\Requests\Api\Events\UpdateRequest;
use App\Models\Event;
use Illuminate\Http\Request;
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
    public function index()
    {
        return app(Event::class)->all();
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
     * Atualizar evento.
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
