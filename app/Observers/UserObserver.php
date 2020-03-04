<?php

namespace App\Observers;

use App\Models\User as Model;

class UserObserver
{
    /**
     * @param Model $model
     * @return void
     */
    public function created(Model $model): void
    {
        $model->api_token = str_random(60);
    }
}
