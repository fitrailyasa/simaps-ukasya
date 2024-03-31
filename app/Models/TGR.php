<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TGR extends Model
{
    use HasFactory;

    protected $table = 'tgr';
    protected $fillable = ['nama', 'img', 'jenis_kelamin', 'kontingen', 'golongan', 'kategori'];

    public function PengundianTGR()
    {
        return $this->hasMany(PengundianTGR::class);
    }

}
