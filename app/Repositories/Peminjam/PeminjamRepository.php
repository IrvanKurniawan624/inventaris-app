<?php

namespace App\Repositories\Peminjam;

use LaravelEasyRepository\Repository;

interface PeminjamRepository extends Repository{

    // Write something awesome :)
    public function getLastestPeminjamWithUpdatedBy();
    public function updateOrCreate($condition, $data);
}
