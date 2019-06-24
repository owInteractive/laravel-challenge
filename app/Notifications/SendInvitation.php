<?php

namespace App\Notifications;

use App\Models\Event;
use App\Models\Guest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendInvitation extends Notification
{
    use Queueable;

    /**
     * @var Guest
     */
    private $guest;

    /**
     * @var Event
     */
    private $event;

    /**
     * Create a new notification instance.
     *
     * @param Guest $guest
     */
    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
        $this->event = $guest->event;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("Event: {$this->event->title}")
                    ->greeting('Hello!')
                    ->line('You were invited to an event.')
                    ->line('Click the link below to see more information.')
                    ->action("Event: {$this->event->title}", $this->guest->linkShowEventWithToken())
                    ->line('Thank you for using our application!');
    }
}
