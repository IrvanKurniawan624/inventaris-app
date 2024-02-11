<?php

namespace App\Services\Transaksi;

use LaravelEasyRepository\Service;
use App\Repositories\Barang\BarangRepository;
use App\Repositories\Kategori\KategoriRepository;
use App\Repositories\Ruang\RuangRepository;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Transaksi\TransaksiRepository;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class TransaksiServiceImplement extends Service implements TransaksiService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;
     /**
     * Additional repositories
     */
     protected $barangRepository;
     protected $kategoriRepository;
     protected $ruangRepository;
     protected $supplierRepository;

    public function __construct(TransaksiRepository $mainRepository, BarangRepository $barangRepository, KategoriRepository $kategoriRepository, RuangRepository $ruangRepository, SupplierRepository $supplierRepository)
    {
      $this->mainRepository = $mainRepository;
      $this->barangRepository = $barangRepository;
      $this->kategoriRepository = $kategoriRepository;
      $this->ruangRepository = $ruangRepository;
      $this->supplierRepository = $supplierRepository;
    }

    public function getBarangMasukIndexData(){
      $data['barang'] = $this->barangRepository->getBarangSelect2();
      $data['kategori'] = $this->kategoriRepository->getKategoriOrderByNama();
      $data['ruang'] = $this->ruangRepository->getRuangOrderByNama();
      $data['supplier'] = $this->supplierRepository->getSupplierSelect2();
      return $data;
    }
    
    public function getBarangMasukSelect2Data(){
      $data = $this->barangRepository->getBarangSelect2();
      return $data;
    }

    public function storeTransaksi($data){
      DB::beginTransaction();
      try{
        if($data->barang_taken == '1'){
          $image = null;
          if (!empty($data->file('gambar'))) {
            $path = 'berkas/master-barang/';
            $file = $data->file('gambar');
            $name = md5(time() . "_" . $file->getClientOriginalName()) . ".webp";
            Image::make($file)->encode('webp', 90)->fit(250, 250)->save(public_path( $path .  $name));
            $image = $name;
          }
          $barang = $this->barangRepository->create([
            "kode_barang" => $data->kode_barang,
            "image" => $image,
            "nama_barang" => $data->nama_barang,
            "spesifikasi" => $data->spesifikasi,
            "jumlah" => $data->jumlah,
            "keterangan" => $data->keterangan,
            "spesifikasi" => $data->spesifikasi,
            "ruang_id" => $data->ruang_id,
            "kategori_id" => $data->kategori_id,
          ]);
          $barang_id = $barang->id;
        }else {
          $barang_id = $data->barang_from_table;
          $barang = $this->barangRepository->find($barang_id);
          $barang->jumlah += $data->jumlah;
          $barang->save();
        }
        $this->mainRepository->create([
          "id_barang" => $barang_id,
          "jumlah" => $data->jumlah,
          "harga" => $data->harga,
          "keterangan" => $data->keterangan_transaksi,
          "type" => 1
        ]);

      DB::commit();

      return [
        'status' => 200,
        'message' => 'Transaksi Berhasil Dilakukan',
      ];
      }catch(\Exception $e){
        DB::rollback();
        $message = 'Oops! Terjadi kesalahan silahkan hubungi admin jika berkelanjutan';
        return [
          'status' => 300,
          'message' => $message
        ];
      }
    }

    public function getBarangKeluarIndexData(){
      $data['barang'] = $this->barangRepository->getBarangSelect2WithJumlah();
      return $data;
    }

    public function getBarangKeluarSelect2Data(){
      $data = $this->barangRepository->getBarangSelect2WithJumlah();
      return $data;
    }

    public function barangKeluarTransaksi($data){
      DB::beginTransaction();
      try{
        foreach ($data->id_barang as $key => $item) {
          $barang = $this->barangRepository->find($item);
          if($data->jumlah[$key] > $barang->jumlah){
            return [
              'status' => 300,
              'message' => 'Oops! jumlah pengurangan barang [ ' . $barang->nama_barang . ' ] melebihi stok barang yang ada..!'
            ];
          }
          $barang->jumlah -= $data->jumlah[$key];
          $barang->save();

          $this->mainRepository->create([
            "id_barang" => $item,
            "jumlah" => $data->jumlah[$key],
            "keterangan" => $data->keterangan_transaksi,
            "type" => 2
          ]);
        };
        DB::commit();

        return [
          'status' => 200,
          'message' => 'Transaksi Berhasil Dilakukan',
        ];
      }catch(\Exception $e){
        return $e;
        DB::rollback();
        $message = 'Oops! Terjadi kesalahan silahkan hubungi admin jika berkelanjutan';
        return [
          'status' => 300,
          'message' => $message
        ];
      }
    }

}
