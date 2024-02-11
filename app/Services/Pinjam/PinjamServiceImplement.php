<?php

namespace App\Services\Pinjam;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Barang\BarangRepository;
use App\Repositories\Peminjam\PeminjamRepository;
use App\Repositories\Pinjam\PinjamRepository;
use App\Repositories\PinjamDetail\PinjamDetailRepository;

class PinjamServiceImplement extends Service implements PinjamService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;
     protected $barangRepository;
     protected $peminjamRepository;
     protected $pinjamDetailRepository;

    public function __construct(PinjamRepository $mainRepository, BarangRepository $barangRepository, PeminjamRepository $peminjamRepository, PinjamDetailRepository $pinjamDetailRepository)
    {
      $this->mainRepository = $mainRepository;
      $this->barangRepository = $barangRepository;
      $this->peminjamRepository = $peminjamRepository;
      $this->pinjamDetailRepository = $pinjamDetailRepository;
    }

    public function getIndexData(){
      $data['barang'] = $this->barangRepository->getBarangSelect2WithJumlah();
      $data['peminjam'] = $this->peminjamRepository->all();
      $data['kode_pinjam'] = "PNJ-" . Date::now()->format('Ymd') . $this->mainRepository->count() + 1;
      return $data;
    }

    public function datatables(){
        $data = $this->barangRepository->getLastestBarangWithAllHaveJumlah();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function storePinjam($data){
      DB::beginTransaction();
      $tanggalArray = explode(" - ", $data->tanggal_pinjam);
      $tanggal_masuk = Carbon::createFromFormat('d/m/Y', $tanggalArray[0])->format('Y-m-d');
      $tanggal_keluar = Carbon::createFromFormat('d/m/Y', $tanggalArray[1])->format('Y-m-d');

      try{
        $pinjam = $this->mainRepository->create([
          "kode_pinjam" => $data->kode_pinjam,
          "id_peminjam" => $data->id_peminjam,
          "tanggal_pinjam" => $tanggal_masuk,
          "tanggal_kembali" => $tanggal_keluar,
          "status" => 0
        ]);
        
        foreach ($data->id_barang as $key => $item) {
          $this->pinjamDetailRepository->create([
              "id_pinjam" => $pinjam->id,
              "id_barang" => $item,
              "jumlah" => $data->jumlah[$key],
          ]);

          $barang = $this->barangRepository->find($item);
          if($data->jumlah[$key] > $barang->jumlah){
            return [
              'status' => 300,
              'message' => 'Oops! jumlah pinjaman barang [ ' . $barang->nama_barang . ' ] melebihi stok barang yang ada..!'
            ];
          }
          
          $barang->jumlah -= $data->jumlah[$key];
          $barang->jumlah_dipinjam += $data->jumlah[$key];
          $barang->save();
        }

        DB::commit();

        return [
          'status' => 200,
          'message' => 'Pinjam Barang Berhasil',
          'kode' => $data->kode_pinjam,
        ];
      }catch (\Exception $e) {
          DB::rollback();
          $message = 'Oops! Terjadi kesalahan silahkan hubungi admin jika berkelanjutan';
          return [
              'status' => 300,
              'message' => $message
          ];
      }
    }

    public function datatablesPengembalian(){
      $data = $this->mainRepository->getDataPinjam();

      return Datatables::of($data)
          ->addIndexColumn()
          ->make(true);
    }

    public function detailPengembalian($id){
      return $this->mainRepository->getDataWithAll($id);
    }

    public function storePengembalian($data){
      DB::beginTransaction();
      try{
        $id = $data->id_pinjam;
        $this->mainRepository->find($data->id_pinjam)->update(['status' => 1]);

        $pinjam_detail = $this->mainRepository->getDetailWithPinjamDetail($id)->pinjam_detail;
        foreach ($pinjam_detail as $key => $item) {
          $this->barangRepository->find($item->id_barang)->update([
              'jumlah' => DB::raw('jumlah + ' . $item->jumlah),
              'jumlah_dipinjam' => DB::raw('jumlah_dipinjam - ' . $item->jumlah),
          ]);
        }

        // DB::commit();

        return [
          'status' => 200,
          'message' => 'Pengembalian Barang Berhasil',
        ];
      } catch (\Exception $e) {
          DB::rollback();
          $message = 'Oops! Terjadi kesalahan silahkan hubungi admin jika berkelanjutan';
          return [
              'status' => 300,
              'message' => $message
          ];
      }
    }
}
