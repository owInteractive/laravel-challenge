<?php

namespace App\Repositories;

use App\Event;

class EventRepository
{
	private $model;

	public function __construct(Event $model)
	{
		$this->model = $model;
	}

	public function findAll()
	{
		return $this->model->orderby('ts_start')->paginate(10);

	}

	public function getEventsToday()
	{

   return $this->model->where('ts_start', '>=', date('Y-m-d 00:00:00'))
	 		->where('ts_start', '<=', date('Y-m-d 23:59:59'))
	 		->get();
	}

	public function getEventsNext5Days()
	{

	return $this->model->where('ts_start', '>=', date('Y-m-d 00:00:00'))
		 ->where('ts_start', '<=', date('Y-m-d 23:59:59', strtotime('+5 days')))
		 ->get();

	}

  public function findById($id)
  {
    return $this->model->find($id);
  }


  public function create(array $data)
  {
      return $this->model->create($data);
  }

  public function update(array $data, $id)
  {
    return $this->model->find($id)->update($data);
  }

  public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

}
