<?php

namespace App\Http\Controllers\Pinjam;

use App\Http\Controllers\Controller;
use App\Http\Requests\PinjamRequest;
use App\Services\Pinjam\PinjamService;
use App\Helpers\ApiFormatter;
use Illuminate\Http\Request;

class PinjamController extends Controller
{

    protected $pinjamService;

    public function __construct(PinjamService $pinjamService)
    {
        $this->pinjamService = $pinjamService;
    }

    public function index(){
        $data = $this->pinjamService->getIndexData();
        return view('pinjam.index', $data);
    }

    public function datatables(){
        return $this->pinjamService->datatables();
    }

    public function store_pinjam(PinjamRequest $request){
        $response = $this->pinjamService->storePinjam($request);
        return $response['status'] === 200
        ? ApiFormatter::success(200, $response['message'], $response['kode'])
        : ApiFormatter::error(500, $response['message']);
    }


    public function index_pengembalian(){
        return view('pinjam.pengembalian');
    }
    
    public function datatables_pengembalian(){
        return $this->pinjamService->datatablesPengembalian();
    }

    public function detail_pengembalian($id){
        $data = $this->pinjamService->detailPengembalian($id);
        return ApiFormatter::success(200, 'success', $data);
    }

    public function store_pengembalian(Request $request){
        $response = $this->pinjamService->storePengembalian($request);
        return $response['status'] === 200
        ? ApiFormatter::success(200, $response['message'])
        : ApiFormatter::error(500, $response['message']);
    }
}
