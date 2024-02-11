<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pinjam_detail';
    public $timestamps = false;

    public function pinjam(){
        return $this->belongsTo(Pinjam::class, 'id_pinjam', 'id');
    }

    public function master_barang(){
        return $this->belongsTo(MasterBarang::class, 'id_barang', 'id');
    }
}
