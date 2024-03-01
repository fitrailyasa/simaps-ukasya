<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTanding extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tanding';
    protected $fillable = ['partai', 'tanggal', 'gelanggang', 'babak', 'kelompok', 'pemain_biru', 'partai_biru', 'pemain_merah', 'partai_merah', 'status', 'pemenang', 'aktif'];    

    public function Gelanggang()
    {
        return $this->belongsTo(Gelanggang::class, 'gelanggang');
    }
}
