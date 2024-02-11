<?php

namespace App\Repositories\Kategori;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Kategori;

class KategoriRepositoryImplement extends Eloquent implements KategoriRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Kategori $model)
    {
        $this->model = $model;
    }

    public function getKategoriOrderByNama(){
        return $this->model->orderBy('nama_kategori', 'ASC')->get();
    }

    public function getLastestKategoriWithUpdatedBy()
    {
        return $this->model->with('updated_by')->orderBy('id','DESC')->get();
    }

    public function updateOrCreate($condition, $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    // Write something awesome :)
}
