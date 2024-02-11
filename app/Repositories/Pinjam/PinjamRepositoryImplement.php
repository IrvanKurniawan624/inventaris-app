<?php

namespace App\Repositories\Pinjam;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Pinjam;

class PinjamRepositoryImplement extends Eloquent implements PinjamRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Pinjam $model)
    {
        $this->model = $model;
    }

    public function count(){
        return $this->model->count();
    }

    public function getAllData(){
        return $this->model->with('peminjam')->orderBy('id', 'desc')->get();
    }

    public function getDataPinjam(){
        return $this->model->with('peminjam')->with('pinjam_detail')->where('status', '=', 0)->orderBy('id', 'desc')->get();
    }

    public function getAllDataWithAll(){
        return $this->model
        ->with(['peminjam' => function ($query) {
            $query->select('id', 'nama_peminjam');
        }])
        ->with(['pinjam_detail.master_barang' => function ($query) {
            $query->select('id', 'nama_barang', 'image', 'kode_barang', 'jumlah', 'ruang_id');
            $query->with(['ruang' => function ($query) {
                $query->select('id', 'nama_ruang');
            }]);
        }])
        ->get();
    }

    public function getdataWithAll($id){
        return $this->model
        ->with(['peminjam' => function ($query) {
            $query->select('id', 'nama_peminjam');
        }])
        ->with(['pinjam_detail.master_barang' => function ($query) {
            $query->select('id', 'nama_barang', 'image', 'kode_barang', 'jumlah', 'ruang_id');
            $query->with(['ruang' => function ($query) {
                $query->select('id', 'nama_ruang');
            }]);
        }])
        ->find($id);
    }

    public function getDetailWithPinjamDetail($id){
        return $this->model->with('pinjam_detail')->find($id);
    }

    // Write something awesome :)
}
