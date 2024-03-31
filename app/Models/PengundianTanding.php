<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengundianTanding extends Model
{
    use HasFactory;

    protected $table = 'pengundian_tanding';
    protected $fillable = ['atlet_id', 'no_undian'];

    public function Tanding()
    {
        return $this->belongsTo(Tanding::class, 'atlet_id', 'id');
    }

    public function JadwalTanding()
    {
        return $this->hasMany(JadwalTanding::class);
    }

}
