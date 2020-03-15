<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $fillable = [
		'title',
		'description',
		'start_at',
		'end_at',
		'user_id',
	];
	
	protected $hidden = [
		'user_id',
	];
	
	/**
	 * user
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 14:04
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
