<?php

namespace App\Observers;

use App\Models\User as Model;
use App\Support\GenerateUniqueToken;

class UserObserver
{
    /**
     * @param Model $model
     * @return void
     */
    public function creating(Model $model): void
    {
        $model->api_token = GenerateUniqueToken::run();
        $model->password = bcrypt($model->password);
    }

    /**
     * @param Model $model
     * @return void
     */
    public function updating(Model $model): void
    {
        if ($model->isDirty('password')) {
            # caso a senha seja alterada.
            $model->password = bcrypt($model->password);
        }
    }
}
