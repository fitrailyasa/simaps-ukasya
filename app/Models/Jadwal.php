<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = ['partai', 'tanggal', 'gelanggang', 'babak', 'kelompok', 'pemain_biru', 'partai_biru', 'pemain_merah', 'partai_merah', 'status', 'pemenang', 'aktif'];    

}
