<?php

namespace App\Repositories\PinjamDetail;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\PinjamDetail;

class PinjamDetailRepositoryImplement extends Eloquent implements PinjamDetailRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(PinjamDetail $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
