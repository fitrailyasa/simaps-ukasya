<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimbangUlang extends Model
{
    use HasFactory;

    protected $table = 'timbang_ulang';
    protected $fillable = ['partai', 'gelanggang', 'babak', 'kelas', 'sudut_biru', 'berat_biru', 'status_biru', 'sudut_merah', 'berat_merah', 'status_merah', 'pemenang'];

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
