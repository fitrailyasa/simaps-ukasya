<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanding extends Model
{
    use HasFactory;

    protected $table = 'tanding';
    protected $fillable = ['nama', 'img', 'jenis_kelamin', 'tinggi_badan', 'berat_badan', 'kontingen', 'golongan', 'kelas'];

    public function PengundianTanding()
    {
        return $this->hasMany(PengundianTanding::class);
    }

}
