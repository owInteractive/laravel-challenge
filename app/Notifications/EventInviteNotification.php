<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EventInviteNotification extends Notification
{
    use Queueable;

    public $event;
    public $invite;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event, $invite)
    {
        $this->event = $event;
        $this->invite = $invite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('events.show', $this->event->id));
        $urlInvite = url(route('events.accept_invite', [$this->event->id, $this->invite->token]));

        $owner = "**{$this->event->owner->name} ({$this->event->owner->email})**";
        return (new MailMessage)
                    ->subject('Event invitation')
                    ->line($owner.' invited you to attend the event **'. $this->event->title.'**')
                    ->action('Accept Invitation', $urlInvite)
                    ->line('Thank you for using our application!')
                    ->markdown('mail.invite.invite_user', ['eventUrl' => $url, 'level'=>'success']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
