<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable=[
        'token',
        'email'
    ];
    use Notifiable;

    /**
     * Get the notification_url's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
    /**
     * Get the mail representation of the notification_url.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Greetings!')
            ->line('This is to invite you to join our platform ' . config('app.name'))
            ->action('Notification Action',$this->notification_url)
            ->line('Thank you for using our application!');
    }
    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray()
    {
        return [
            //
        ];
    }
}
