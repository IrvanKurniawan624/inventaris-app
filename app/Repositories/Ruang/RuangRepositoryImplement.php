<?php

namespace App\Repositories\Ruang;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Ruang;

class RuangRepositoryImplement extends Eloquent implements RuangRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Ruang $model)
    {
        $this->model = $model;
    }

    public function getRuangOrderByNama(){
        return $this->model->orderBy('nama_ruang', 'asc')->get();
    }

    public function getRuangWithUpdatedBy()
    {
        return $this->model->with('updated_by')->orderBy('nama_ruang', 'asc')->get();
    }

    public function updateOrCreate($condition, $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }
}
