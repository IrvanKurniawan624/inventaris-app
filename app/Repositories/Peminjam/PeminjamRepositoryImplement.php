<?php

namespace App\Repositories\Peminjam;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Peminjam;

class PeminjamRepositoryImplement extends Eloquent implements PeminjamRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Peminjam $model)
    {
        $this->model = $model;
    }

    public function getLastestPeminjamWithUpdatedBy()
    {
        return $this->model->with('updated_by')->orderBy('id','DESC')->get();
    }

    public function updateOrCreate($condition, $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    // Write something awesome :)
}
