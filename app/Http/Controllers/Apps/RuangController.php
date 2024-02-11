<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Helpers\ApiFormatter;
use App\Http\Requests\RuangRequest;
use App\Repositories\Ruang\RuangRepository;
use Yajra\DataTables\Facades\DataTables;

class RuangController extends Controller
{
    protected $mainRepository;

    public function __construct(RuangRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    public function index(){
        return view('apps.ruang');
    }

    public function detail($id){
        $data = $this->mainRepository->find($id);
        return ApiFormatter::success(200, 'success', $data);
    }

    public function datatables(){
        $data = $this->mainRepository->getRuangWithUpdatedBy();

        return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
    }

    public function store_update(RuangRequest $request){
        $this->mainRepository->updateOrCreate(['id' => $request->id], $request->all());
        $message = isset($request->id) ? 'Ruang Berhasil Diupdate...!' : 'Ruang Berhasil Ditambahkan...!';

        return ApiFormatter::success(200, $message);
    }

    public function delete($id){
        $this->mainRepository->delete($id);

        return ApiFormatter::success(200, 'Ruang Berhasil Dihapus...!');
    }
}
