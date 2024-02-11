<?php

namespace App\Services\Transaksi;

use LaravelEasyRepository\BaseService;

interface TransaksiService extends BaseService{

    //? Barang Masuk
    public function getBarangMasukIndexData();
    public function getBarangMasukSelect2Data();
    public function storeTransaksi($data);

    //? Barang Keluar
    public function getBarangKeluarIndexData();
    public function getBarangKeluarSelect2Data();
    public function barangKeluarTransaksi($data);
}
