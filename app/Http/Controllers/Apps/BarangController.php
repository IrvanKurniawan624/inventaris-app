<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Helpers\ApiFormatter;
use App\Http\Requests\BarangRequest;
use App\Services\Barang\BarangService;
use App\Repositories\Barang\BarangRepository;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    protected $barangService;
    protected $mainRepository; 

    public function __construct(BarangService $barangService, BarangRepository $mainRepository)
    {
        $this->barangService = $barangService;
        $this->mainRepository = $mainRepository; 
    }

    public function index(){
        $data = $this->barangService->getBarangIndexData();
        return view('apps.barang', $data);
    }

    public function detail($id){
        $data = $this->mainRepository->find($id);
        return ApiFormatter::success(200, 'success', $data);
    }

    public function datatables(){
        $data = $this->mainRepository->getLastestBarangWithAll();

        return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
    }

    public function print_pdf(){
        $data['barang'] = $this->mainRepository->getLastestBarangWithAll();
        $pdf = PDF::loadView('pdf.list-barang', $data);
        return $pdf->stream();
    }

    public function store_update(BarangRequest $request){
        $response = $this->barangService->storeUpdate($request);
        return $response['status'] === 200
        ? ApiFormatter::success(200, $response['message'])
        : ApiFormatter::error(500, $response['message']);
    }

    public function delete($id){
        $response = $this->barangService->delete($id);
        return $response['status'] === 200
        ? ApiFormatter::success(200, $response['message'])
        : ApiFormatter::error(500, $response['message']);
    }
}
