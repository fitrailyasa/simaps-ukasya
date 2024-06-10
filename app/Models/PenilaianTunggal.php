<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianTunggal extends Model
{
    use HasFactory;

    protected $table = 'penilaian_tunggal';
    protected $fillable = ['uuid','penilaian_waktu','jadwal_tunggal','sudut','skor','salah','flow_skor','juri','standard_deviation'];

    public function TGR()
    {
        return $this->belongsTo(TGR::class, 'sudut', 'id');
    }
    public function JadwalTGR()
    {
        return $this->belongsTo(JadwalTGR::class, 'jadwal_tunggal', 'id');
    }
    public function Juri()
    {
        return $this->belongsTo(User::class, 'juri', 'id');
    }
}
