<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Blameable;

class Pinjam extends Model
{
    use HasFactory, Blameable;

    protected $guarded = ['id'];
    protected $table = 'pinjam';


    public function peminjam(){
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id');
    }

    public function pinjam_detail(){
        return $this->hasMany(PinjamDetail::class, 'id_pinjam', 'id');
    }

    public function created_by(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
