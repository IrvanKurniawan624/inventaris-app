<?php

namespace App\Repositories\Barang;

use LaravelEasyRepository\Repository;

interface BarangRepository extends Repository{

    public function getBarangSelect2();
    public function getBarangSelect2WithJumlah();
    public function getLastestBarangWithAllHaveJumlah();
    public function updateOrCreate($condition, $data);
    public function getLastestBarangWithAll();
}
