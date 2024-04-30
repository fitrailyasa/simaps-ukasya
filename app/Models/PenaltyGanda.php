<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyGanda extends Model
{
    use HasFactory;
    protected $table = 'penalty_ganda';
    protected $fillable = ['uuid','jadwal_ganda','sudut_merah','sudut_biru','dewan','toleransi_waktu','keluar_arena','menyentuh_lantai','pakaian','tidak_bergerak','senjata_jatuh'];

    public function TGR_1()
    {
        return $this->belongsTo(TGR::class, 'sudut_merah', 'id');
    }
    public function TGR_2()
    {
        return $this->belongsTo(TGR::class, 'sudut_biru', 'id');
    }
    public function JadwalTGR()
    {
        return $this->belongsTo(JadwalTGR::class, 'jadwal_tunggal', 'id');
    }
    public function Dewan()
    {
        return $this->belongsTo(User::class, 'dewan', 'id');
    }
}
