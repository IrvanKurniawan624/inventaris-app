<?php

namespace App\Repositories\Ruang;

use LaravelEasyRepository\Repository;

interface RuangRepository extends Repository{

    // Write something awesome :)
    public function getRuangOrderByNama();
    public function getRuangWithUpdatedBy();
    public function updateOrCreate($condition, $data);
}
