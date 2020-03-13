<?php


namespace App\Observers;
use App\Models\Event as Model;
use App\Notifications\Events\InviteUserNotification;

class EventObserver
{
    /**
     * @param Model $model
     * @return void
     */
    public function created(Model $model)
    {
        if($model->users->isNotEmpty()) {
            # email
            $notification = app(InviteUserNotification::class, [ $model ]);

            # enviar e-mail de confirmação.
            $model->users->each->notify($notification);
        }
    }
}