<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianTanding extends Model
{
    use HasFactory;

    protected $table = 'penilaian_tanding';
    protected $fillable = ['uuid','jadwal_tanding','babak','pukulan', 'tendangan', 'binaan','peringatan','teguran','jatuhan','atlet','skor'];
    
    public function Tanding()
    {
        return $this->belongsTo(Tanding::class, 'tanding','atlet', 'id');
    }
    public function JadwalTanding()
    {
        return $this->belongsTo(JadwalTanding::class, 'jadwal_tanding', 'id');
    }
    
}
