<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianGanda extends Model
{
    use HasFactory;
    protected $table = 'penilaian_ganda';
    protected $fillable = ['uuid','jadwal_ganda','sudut','skor','attack_skor','firmness_skor','soulfulness_skor','juri'];

    public function TGR()
    {
        return $this->belongsTo(TGR::class, 'sudut', 'id');
    }
    public function JadwalTGR()
    {
        return $this->belongsTo(JadwalTGR::class, 'jadwal_ganda', 'id');
    }
    public function Juri()
    {
        return $this->belongsTo(User::class, 'juri', 'id');
    }
}
