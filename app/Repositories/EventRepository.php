<?php

namespace App\Repositories;

use App\Models\Event;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class EventRepository.
 */
class EventRepository extends BaseRepository
{
	/**
	 * @return string
	 *  Return the model
	 */
	public function model()
	{
		return Event::class;
	}
}
