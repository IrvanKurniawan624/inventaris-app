<?php

namespace App\Http\Controllers\Transaksi;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\BarangKeluarRequest;
use App\Http\Requests\BarangMasukRequest;
use App\Services\Transaksi\TransaksiService;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    protected $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    
    //?? Barang Masuk
    
    public function index_barang_masuk(){
        $data = $this->transaksiService->getBarangMasukIndexData();
        return view('transaksi.barang-masuk.index', $data);
    }
    
    public function getBarangMasukSelect2Data(){
        $data = $this->transaksiService->getBarangMasukSelect2Data();
        return ApiFormatter::success(200, 'success', $data);
    }

    public function barang_masuk_transaksi(BarangMasukRequest $request){
        $response = $this->transaksiService->storeTransaksi($request);
        return $response['status'] === 200
        ? ApiFormatter::success(200, $response['message'])
        : ApiFormatter::error(500, $response['message']);
    }

    //? Barang Keluar

    public function index_barang_keluar(){
        $data = $this->transaksiService->getBarangKeluarIndexData();
        return view('transaksi.barang-keluar.index', $data);
    }

    public function getBarangKeluarSelect2Data(){
        $data = $this->transaksiService->getBarangKeluarSelect2Data();
        return ApiFormatter::success(200, 'success', $data);
    }

    public function barang_keluar_transaksi(BarangKeluarRequest $request){
        $response = $this->transaksiService->barangKeluarTransaksi($request);
        return $response['status'] === 200
        ? ApiFormatter::success(200, $response['message'])
        : ApiFormatter::error(500, $response['message']);
    }
    
}
