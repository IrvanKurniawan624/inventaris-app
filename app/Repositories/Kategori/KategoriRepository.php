<?php

namespace App\Repositories\Kategori;

use LaravelEasyRepository\Repository;

interface KategoriRepository extends Repository{

    // Write something awesome :)
    public function getKategoriOrderByNama();
    public function getLastestKategoriWithUpdatedBy();
    public function updateOrCreate($condition, $data);
}
