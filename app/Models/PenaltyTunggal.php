<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyTunggal extends Model
{
    use HasFactory;
    protected $table = 'penalty_tunggal';
    protected $fillable = ['uuid','performa_waktu','jadwal_tunggal','sudut','dewan','toleransi_waktu','keluar_arena','menyentuh_lantai','pakaian','tidak_bergerak'];

    public function TGR()
    {
        return $this->belongsTo(TGR::class, 'sudut', 'id');
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
