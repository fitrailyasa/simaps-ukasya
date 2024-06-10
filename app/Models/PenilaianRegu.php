<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianRegu extends Model
{
    use HasFactory;
    protected $table = 'penilaian_regu';
    protected $fillable = ['uuid','jadwal_regu','sudut','skor','salah','flow_skor','juri'];

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
    public function Juri()
    {
        return $this->belongsTo(User::class, 'juri', 'id');
    }
}
