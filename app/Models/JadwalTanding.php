<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTanding extends Model
{
    use HasFactory;

    protected $table = 'jadwal_tanding';
    protected $fillable = ['partai', 'jenis_kemenangan', 'gelanggang', 'babak', 'sudut_biru', 'sudut_merah', 'next_sudut', 'next_partai', 'skor_biru', 'skor_merah', 'pemenang', 'babak_tanding', 'tahap', 'berat_biru', 'status_biru', 'berat_merah', 'status_merah'];

    public function Gelanggang()
    {
        return $this->belongsTo(Gelanggang::class, 'gelanggang');
    }

    public function PengundianTandingBiru()
    {
        return $this->belongsTo(PengundianTanding::class, 'sudut_biru', 'id');
    }

    public function PengundianTandingMerah()
    {
        return $this->belongsTo(PengundianTanding::class, 'sudut_merah', 'id');
    }

    public function PemenangTanding()
    {
        return $this->belongsTo(PengundianTanding::class, 'pemenang', 'id');
    }
}
