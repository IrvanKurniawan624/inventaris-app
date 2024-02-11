<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Repositories\Pinjam\PinjamRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPinjamanController extends Controller
{
    protected $mainRepository;

    public function __construct(PinjamRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function index(){
        // return $this->mainRepository->getAllDataWithAll();
        return view('laporan.pinjaman');
    }

    public function datatables(){
        $data = $this->mainRepository->getAllData();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function print_pdf(){
        $data['barang'] = $this->mainRepository->getAllDataWithAll();
        $pdf = PDF::loadView('pdf.list-pinjaman', $data);
        return $pdf->stream();
    }
}
