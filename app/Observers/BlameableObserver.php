<?php

namespace App\Observers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class BlameableObserver
{
    public function creating(Model $model)
    {
        $model->created_by = optional(Auth::user())->id ?? optional(auth('api')->user())->id;
        $model->updated_by = optional(Auth::user())->id ?? optional(auth('api')->user())->id;
    }

    public function updating(Model $model)
    {
        $model->updated_by = optional(Auth::user())->id ?? optional(auth('api')->user())->id;
    }
}
