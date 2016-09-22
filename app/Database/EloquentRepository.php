<?php

namespace Barryvanveen\Database;

use Illuminate\Database\Eloquent\Model;

class EloquentRepository
{
    /**
     * @param Model $model
     *
     * @return Model
     */
    public function save(Model $model)
    {
        $model->save();

        return $model;
    }
}
