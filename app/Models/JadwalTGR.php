<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTGR extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tgr';
    protected $fillable = ['partai', 'gelanggang', 'babak', 'sudut_biru', 'sudut_merah', 'next_sudut', 'next_partai', 'skor_biru', 'skor_merah', 'pemenang'];    

    public function Gelanggang()    
    {
        return $this->belongsTo(Gelanggang::class, 'gelanggang');
    }

    public function PengundianTGRBiru() 
    {
        return $this->belongsTo(PengundianTGR::class, 'sudut_biru', 'id');
    }

    public function PengundianTGRMerah()
    {
        return $this->belongsTo(PengundianTGR::class, 'sudut_merah', 'id');
    }

    public function PemenangTGR()
    {
        return $this->belongsTo(PengundianTGR::class, 'pemenang', 'id');
    }

}
