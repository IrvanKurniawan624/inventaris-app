<?php

namespace App\Repositories\Barang;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MasterBarang as Barang;
use PDO;

class BarangRepositoryImplement extends Eloquent implements BarangRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Barang $model)
    {
        $this->model = $model;
    }

    public function getBarangSelect2(){
        return $this->model->select(['id', 'kode_barang', 'nama_barang', 'image', 'jumlah'])->orderBy('nama_barang', 'ASC')->get();
    }

    public function getBarangSelect2WithJumlah(){
        return $this->model->select(['id', 'kode_barang', 'nama_barang', 'jumlah', 'image'])->where('jumlah', '>', 0)->orderBy('nama_barang', 'ASC')->get();
    }

    public function getLastestBarangWithAll()
    {
        return $this->model->with('kategori')->with('ruang')->orderBy('id','DESC')->get();
    }

    public function getLastestBarangWithAllHaveJumlah()
    {
        return $this->model->with('kategori')->with('ruang')->where('jumlah', '>', 0)->orderBy('id','DESC')->get();
    }

    public function updateOrCreate($condition, $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    // Write something awesome :)
}
