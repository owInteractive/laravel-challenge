<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invite;

class InviteController extends Controller
{
	private $eventRepository, $request;
	
	/**
	 * InviteController constructor.
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
	 * create
	 * Página para criar os convites para o evento
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 12:10
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 */
	public function create($id)
	{
		try {
			$event = $this->eventRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_event'))
				->error()
				->important();
			return redirect()->route('events.index');
		}
		return view('events.invite', compact([
			'event',
		]));
	}
	
	/**
	 * store
	 * Envia os convites para o evento
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 12:14
	 *
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store($id)
	{
		try {
			$event = $this->eventRepository->getById($id);
		} catch (ModelNotFoundException $e) {
			flash(trans('system.text.not_found_event'))
				->error()
				->important();
			return redirect()->route('events.index');
		}
		if (!is_null($this->request->input('emails')) && !empty($this->request->input('emails'))) {
			$emails = explode(',', preg_replace('/\s*/m', '', $this->request->input('emails')));
			foreach ($emails as $email) {
				Mail::to($email)
					->send(new Invite($event));
			}
			flash(trans('system.text.invite_event_success'))
				->success()
				->important();
		}
		return redirect()->route('events.index');
	}
}
