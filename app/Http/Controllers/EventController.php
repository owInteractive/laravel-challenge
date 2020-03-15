<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
	private $eventRepository, $request;
	
	/**
	 * EventController constructor.
	 *
	 * @param \App\Repositories\EventRepository $eventRepository
	 * @param \Illuminate\Http\Request $request
	 */
	public function __construct(
		EventRepository $eventRepository,
		Request $request
	) {
		$this->eventRepository = $eventRepository;
		$this->request = $request;
	}
	
	/**
	 * index
	 * Listagem de eventos
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 17:26
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$query = $this->eventRepository
			->where('user_id', auth()->user()->id)
			->orderBy('id', 'DESC');
		
		if (!is_null($this->request->query('filter'))) {
			if ($this->request->query('filter') == 'next') {
				$query
					->where('start_at', date('Y-m-d 23:59:59', strtotime('+5 days')), '<=')
					->where('end_at', date('Y-m-d 00:00:00'), '>=');
			} else if ($this->request->query('filter') == 'today') {
				$query
					->where('end_at', date('Y-m-d 23:59:59'), '<=');
			}
		}
		$events = $query->paginate(15);
		return view('events.index', compact([
			'events',
		]));
	}
	
	/**
	 * create
	 * Página para criar um novo evento
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 17:29
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return view('events.create');
	}
	
	/**
	 * store
	 * Criar um novo evento
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 17:45
	 *
	 * @param \App\Http\Requests\CreateEventRequest $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(CreateEventRequest $request)
	{
		$this->eventRepository
			->create($this->values($request));
		
		flash(trans('system.text.store_event_success'))->success();
		
		return redirect()->route('events.index');
	}
	
	/**
	 * edit
	 * Página para editar um evento
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 17:49
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function edit($id)
	{
		try {
			$event = $this->eventRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_event'))
				->error()
				->important();
			return redirect()->route('events.index');
		}
		return view('events.edit', compact([
			'event',
		]));
	}
	
	/**
	 * update
	 * Editar um evento
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 18:06
	 *
	 * @param \App\Http\Requests\UpdateEventRequest $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdateEventRequest $request, $id)
	{
		try {
			$event = $this->eventRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_event'))
				->error()
				->important();
			return redirect()->route('events.index');
		}
		$this->eventRepository
			->updateById($event->id, $this->values($request));
		
		flash(trans('system.text.update_event_success'))
			->success()
			->important();
		
		return redirect()->route('events.index');
	}
	
	/**
	 * destroy
	 * Remover um evento existente
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 18:07
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		try {
			$event = $this->eventRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_event'))
				->error()
				->important();
			return redirect()->route('events.index');
		}
		$this->eventRepository
			->deleteById($event->id);
		
		flash(trans('system.text.destroy_event_success'))
			->success()
			->important();
		
		return redirect()->route('events.index');
	}
	
	/**
	 * values
	 * Valores para inserir e editar um evento
	 * @author Luan Magalhães Pereira
	 * 14/03/20 - 18:05
	 *
	 * @param $request
	 *
	 * @return array
	 */
	private function values($request)
	{
		return [
			'title'       => $request->input('title'),
			'start_at'    => date('Y-m-d H:i', strtotime($request->input('start_at'))),
			'end_at'      => date('Y-m-d H:i', strtotime($request->input('end_at'))),
			'description' => $request->input('description'),
			'user_id'     => auth()->user()->id,
		];
	}
}
