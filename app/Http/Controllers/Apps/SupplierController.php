<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Repositories\Supplier\SupplierRepository;
use App\Helpers\ApiFormatter;
use App\Http\Requests\SupplierRequest;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    protected $mainRepository;

    public function __construct(SupplierRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function index(){
        return view('apps.supplier');
    }

    public function detail($id){
        $data = $this->mainRepository->find($id);
        return ApiFormatter::success(200, 'success', $data);
    }

    public function datatables(){
        $data = $this->mainRepository->getSupplierWithUpdatedBy();

        return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
    }

    public function store_update(SupplierRequest $request){
        $this->mainRepository->updateOrCreate(['id' => $request->id], $request->all());
        $message = isset($request->id) ? 'Supplier Berhasil Diupdate...!' : 'Supplier Berhasil Ditambahkan...!';

        return ApiFormatter::success(200, $message);
    }

    public function delete($id){
        $this->mainRepository->delete($id);

        return ApiFormatter::success(200, 'Supplier Berhasil Dihapus...!');
    }
}
