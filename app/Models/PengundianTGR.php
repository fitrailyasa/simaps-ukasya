<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengundianTGR extends Model
{
    use HasFactory;

    protected $table = 'pengundian_tgr';
    protected $fillable = ['atlet_id', 'no_undian'];

    public function TGR()
    {
        return $this->belongsTo(TGR::class, 'atlet_id', 'id');
    }

    public function JadwalTGR()
    {
        return $this->hasMany(JadwalTGR::class);
    }

}
