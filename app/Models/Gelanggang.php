<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelanggang extends Model
{
    use HasFactory;

    protected $table = 'gelanggang';
    protected $fillable = ['nama', 'waktu', 'jenis','jadwal_tanding'];      

    public function JadwalTGR()
    {
        return $this->hasMany(JadwalTGR::class, 'gelanggang', 'id');
    }

    public function JadwalTanding()
    {
        return $this->hasMany(JadwalTanding::class, 'gelanggang', 'id');  
    }

}
