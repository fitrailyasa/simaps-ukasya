<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimbangUlang extends Model
{
    use HasFactory;

    protected $table = 'timbang_ulang';
    protected $fillable = ['partai', 'berat_biru', 'status_biru', 'berat_merah', 'status_merah'];

    public function JadwalTanding()
    {
        return $this->belongsTo(JadwalTanding::class, 'partai', 'id');
    }
}
