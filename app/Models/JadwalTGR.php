<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTGR extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tgr';
    protected $fillable = ['partai', 'tanggal', 'gelanggang', 'babak', 'kelompok', 'pemain_biru', 'partai_biru', 'pemain_merah', 'partai_merah', 'status', 'pemenang', 'aktif'];    

}
