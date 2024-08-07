<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelanggang extends Model
{
    use HasFactory;

    protected $table = 'gelanggang';
    protected $fillable = ['nama', 'waktu', 'jenis','jadwal'];      

    public function JadwalTGR()
    {
        return $this->hasMany(JadwalTGR::class, 'gelanggang', 'id');
    }

    public function JadwalTanding()
    {
        return $this->hasMany(JadwalTanding::class, 'gelanggang', 'id');  
    }

    public function Jadwal_TGR()
    {
        return $this->belongsTo(JadwalTGR::class, 'jadwal', 'id');
    }

    public function Jadwal_Tanding()
    {
        return $this->belongsTo(JadwalTanding::class, 'jadwal', 'id');
    }

}
