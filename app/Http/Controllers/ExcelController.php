<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use Illuminate\Http\Request;
use Excel;

class ExcelController extends Controller
{
	private $eventRepository, $request;
	
	/**
	 * ExcelController constructor.
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
	 * Página para importar eventos
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 11:50
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		return view('events.import');
	}
	
	/**
	 * export
	 * Exporta os eventos em formato csv
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 11:40
	 *
	 * @return mixed
	 */
	public function export()
	{
		$events = $this->eventRepository
			->where('user_id', auth()->user()->id)
			->get()
			->toArray();
		
		return Excel::create('calendar_events', function ($excel) use ($events)
		{
			$excel->sheet('mySheet', function ($sheet) use ($events)
			{
				$sheet->fromArray($events);
			});
		})
			->download('csv');
	}
	
	/**
	 * import
	 * Importa os eventos em formato csv para o sistema
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 11:59
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function import()
	{
		$path = $this->request->file('events_file')
			->getRealPath();
		$events = Excel::load($path)
			->get();
		
		$values = $this->values($events);
		
		if (count($values)) {
			$this->eventRepository->createMultiple($values);
			
		}
		flash(trans('system.text.import_event_success'))->success();
		
		return redirect()->route('events.index');
	}
	
	/**
	 * values
	 * Valores para importar os eventos
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 11:59
	 *
	 * @param $events
	 *
	 * @return array
	 */
	private function values($events)
	{
		$values = [];
		if (count($events)) {
			foreach ($events as $event) {
				$values[] = [
					'user_id'     => auth()->user()->id,
					'title'       => $event->title,
					'description' => $event->description,
					'start_at'    => $event->start_at,
					'end_at'      => $event->end_at,
				];
			}
		}
		return $values;
	}
}
