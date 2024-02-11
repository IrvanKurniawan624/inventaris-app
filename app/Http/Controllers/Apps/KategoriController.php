<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Repositories\Kategori\KategoriRepository;
use App\Helpers\ApiFormatter;
use App\Http\Requests\KategoriRequest;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    protected $mainRepository;

    public function __construct(KategoriRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function index(){
        return view('apps.kategori');
    }

    public function detail($id){
        $data = $this->mainRepository->find($id);
        return ApiFormatter::success(200, 'success', $data);
    }

    public function datatables(){
        $data = $this->mainRepository->getLastestKategoriWithUpdatedBy();

        return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
    }

    public function store_update(KategoriRequest $request){
        $this->mainRepository->updateOrCreate(['id' => $request->id], $request->all());
        $message = isset($request->id) ? 'Kategori Berhasil Diupdate...!' : 'Kategori Berhasil Ditambahkan...!';

        return ApiFormatter::success(200, $message);
    }

    public function delete($id){
        $this->mainRepository->delete($id);

        return ApiFormatter::success(200, 'Kategori Berhasil Dihapus...!');
    }
}
