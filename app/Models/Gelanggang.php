<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelanggang extends Model
{
    use HasFactory;

    protected $table = 'gelanggang';
    protected $fillable = ['nama', 'waktu', 'audio', 'jenis', 'jumlah_tanding', 'jumlah_tgr'];      

    public function JadwalTGR()
    {
        return $this->hasMany(JadwalTGR::class);
    }

    public function JadwalTanding()
    {
        return $this->hasMany(JadwalTanding::class);  
    }

}
