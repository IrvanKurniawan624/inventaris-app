<?php

namespace App\Services\Barang;

use LaravelEasyRepository\BaseService;

interface BarangService extends BaseService{

    public function getBarangIndexData();
    public function storeUpdate($data);
    public function delete($id);
}
