<?php

namespace App\Services\Barang;

use LaravelEasyRepository\Service;
use App\Repositories\Barang\BarangRepository;
use App\Repositories\Kategori\KategoriRepository;
use App\Repositories\Ruang\RuangRepository;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class BarangServiceImplement extends Service implements BarangService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;
     protected $kategoriRepository;
     protected $ruangRepository;

    public function __construct(BarangRepository $mainRepository,  KategoriRepository $kategoriRepository, RuangRepository $ruangRepository)
    {
      $this->mainRepository = $mainRepository;
      $this->kategoriRepository = $kategoriRepository;
      $this->ruangRepository = $ruangRepository;
    }

    public function getBarangIndexData()
    {
      $data['kategori'] = $this->kategoriRepository->getKategoriOrderByNama();
      $data['ruang'] = $this->ruangRepository->getRuangOrderByNama();
      return $data;
    }

    public function storeUpdate($data){
      DB::beginTransaction();
      try{
        $image = null;
        if (!empty($data->file('gambar'))) {
          if(!empty($data->id)){
            $this->deleteImage($data->id);
          }
          $path = 'berkas/master-barang/';
          $file = $data->file('gambar');
          $name = md5(time() . "_" . $file->getClientOriginalName()) . ".webp";
          Image::make($file)->encode('webp', 90)->fit(250, 250)->save(public_path( $path .  $name));
          $image = $name;
        } else if(empty($data->file('gambar') && !empty($data->avatar_remove))){
          $this->deleteImage($data->id);
        }
        $data->request->add(['image' => $image]);
        $barang = $this->mainRepository->updateOrCreate(['id' => $data->id], $data->all());
        
        DB::commit();

        $message = 'Barang ' . $barang->nama_barang . ' Berhasil ' . (isset($data->id) ? 'Diupdate' : 'Ditambahkan');
        return [
          'status' => 200,
          'message' => $message,
        ];
      } catch(\Exception $e){
        if (!empty($image) && file_exists(public_path($path . $image))) {
          unlink(public_path($path . $image));
        }
        DB::rollback();
        $message = 'Oops! Terjadi kesalahan silahkan hubungi admin jika berkelanjutan';
        return [
          'status' => 300,
          'message' => $message
        ];
      } 
    }

    public function delete($id){
      $this->deleteImage($id);
      $this->mainRepository->delete($id);
      return [
        'status' => 200,
        'message' => 'Barang Berhasil Dihapus...!',
      ];
    }

    private function deleteImage($id){
      $oldModel = $this->mainRepository->find($id);    
      if (!empty($oldModel) && !empty($oldModel->image)) {
          $oldImagePath = public_path('berkas/master-barang/') . $oldModel->image;
          if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
          }
      }
      return;
    }

}
