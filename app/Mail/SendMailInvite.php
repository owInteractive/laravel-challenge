<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Event;
use App\User;

class SendMailInvite extends Mailable
{
    public $event;
    public $nome;
    use Queueable, SerializesModels;

    public function __construct(Event $event, $nome)
    {
         $this->event = $event;
         $this->nome = $nome;
    }

    public function build()
    {
      return $this->from('app@app.com.br')
                ->view('emails.invite')
                ->with([
                    'event'   => $this->event,
                    'nome'    => $this->nome,
                    'usuario' => auth()->user()->name,
                ]);
    }
}
