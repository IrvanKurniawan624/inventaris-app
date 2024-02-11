<?php

namespace App\Repositories\Supplier;

use App\Models\Supplier;
use LaravelEasyRepository\Implementations\Eloquent;

class SupplierRepositoryImplement extends Eloquent implements SupplierRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }

    public function getSupplierSelect2(){
        return $this->model->select(['id','nama_supplier'])->orderBy('nama_supplier', 'ASC')->get();
    }

    public function getSupplierWithUpdatedBy()
    {
        return $this->model->with('updated_by')->orderBy('nama_supplier', 'asc')->get();
    }

    public function updateOrCreate($condition, $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }
}
