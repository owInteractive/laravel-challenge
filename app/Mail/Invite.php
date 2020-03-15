<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invite extends Mailable
{
	use Queueable, SerializesModels;
	
	public $event, $user;
	
	/**
	 * Invite constructor.
	 *
	 * @param $event
	 */
	public function __construct($event)
	{
		$this->event = $event;
		$this->user = auth()->user();
	}
	
	/**
	 * build
	 * @author Luan Magalhães Pereira
	 * 15/03/20 - 12:19
	 *
	 * @return \App\Mail\Invite
	 */
	public function build()
	{
		return $this->view('emails.invite');
	}
}
