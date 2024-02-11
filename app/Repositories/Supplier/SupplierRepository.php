<?php

namespace App\Repositories\Supplier;

use LaravelEasyRepository\Repository;

interface SupplierRepository extends Repository{

    public function getSupplierSelect2();
    public function getSupplierWithUpdatedBy();
    public function updateOrCreate($condition, $data);

}
