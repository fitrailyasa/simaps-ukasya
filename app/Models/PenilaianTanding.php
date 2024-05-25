<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianTanding extends Model
{
    use HasFactory;

    protected $table = 'penilaian_tanding';
    protected $fillable = ['uuid','aktif','jenis','status','jadwal_tanding','sudut','juri_1','juri_2','juri_3','dewan','babak'];
    
    public function Tanding()
    {
        return $this->belongsTo(Tanding::class, 'tanding','sudut', 'id');
    }
    public function JadwalTanding()
    {
        return $this->belongsTo(JadwalTanding::class, 'jadwal_tanding', 'id');
    }
    
}
