<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Repositories\Peminjam\PeminjamRepository;
use App\Helpers\ApiFormatter;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PeminjamRequest;

class PeminjamController extends Controller
{
    protected $mainRepository;

    public function __construct(PeminjamRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function index(){
        return view('apps.peminjam');
    }

    public function detail($id){
        $data = $this->mainRepository->find($id);
        return ApiFormatter::success(200, 'success', $data);
    }

    public function datatables(){
        $data = $this->mainRepository->getLastestPeminjamWithUpdatedBy();

        return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
    }

    public function store_update(PeminjamRequest $request){
        $this->mainRepository->updateOrCreate(['id' => $request->id], $request->all());
        $message = isset($request->id) ? 'Peminjam Berhasil Diupdate...!' : 'Peminjam Berhasil Ditambahkan...!';

        return ApiFormatter::success(200, $message);
    }

    public function delete($id){
        $this->mainRepository->delete($id);

        return ApiFormatter::success(200, 'Peminjam Berhasil Dihapus...!');
    }
}
