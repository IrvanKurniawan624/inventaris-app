<?php

namespace App\Services\Pinjam;

use LaravelEasyRepository\BaseService;

interface PinjamService extends BaseService{

    public function getIndexdata();
    public function datatables();
    public function storePinjam($data);

    public function datatablesPengembalian();
    public function detailPengembalian($id);
    public function storePengembalian($data);
}
