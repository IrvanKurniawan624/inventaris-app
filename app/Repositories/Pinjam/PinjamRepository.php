<?php

namespace App\Repositories\Pinjam;

use LaravelEasyRepository\Repository;

interface PinjamRepository extends Repository{

    // Write something awesome :)
    public function count();
    public function getAllData();
    public function getDataPinjam();
    public function getAllDataWithAll();
    public function getDetailWithPinjamDetail($id);
    public function getDataWithAll($id);

}
