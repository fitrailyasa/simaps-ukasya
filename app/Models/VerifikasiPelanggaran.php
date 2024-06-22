<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPelanggaran extends Model
{
    use HasFactory;
    protected $table = 'verifikasi_pelanggaran';
    protected $fillable = ['uuid','jadwal_tanding','dewan','data','status'];
    
    public function JadwalTanding()
    {
        return $this->belongsTo(JadwalTanding::class, 'jadwal_tanding', 'id');
    }
    public function Dewan()
    {
        return $this->belongsTo(User::class, 'dewan', 'id');
    }
}
