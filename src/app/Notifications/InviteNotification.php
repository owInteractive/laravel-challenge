<?php

namespace App\Notifications;

use App\Event;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $notification_url;
    protected $eventId;
    /**
     * Create a new notification_url instance.
     *
     * @param $notification_url
     */

    public function __construct($notification_url, $eventId)
    {
        $this->notification_url = $notification_url;
        $this->eventId = $eventId;
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
        $event = Event::find($this->eventId);

        return (new MailMessage)
                    ->line('You are receiving this Event Invitation.')
                    ->line("It would be very good receiving you and your family to: ".$event->title)
                    ->line("with additional details below: ")
                    ->line($event->description." .")
                    ->line("This event is scheduled to begin at: ". Carbon::createFromDate($event->start)->format('d-m-Y H:m:s') ." and to finish at: ".Carbon::createFromDate($event->end)->format('d-m-Y H:m:s'))
                    ->action('Click this link to register and be updated with my new events: ', $this->notification_url)
                    ->line('I hope see you soon!');
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
