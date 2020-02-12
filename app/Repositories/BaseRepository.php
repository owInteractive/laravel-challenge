<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function get()
    {
        return $this->model->get();
    }

    public function update(Model $model, array $data)
    {
        return $model->update($data);
    }

}