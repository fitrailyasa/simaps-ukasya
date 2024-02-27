<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengundian extends Model
{
    use HasFactory;

    protected $table = 'pengundian';
    protected $fillable = ['nama', 'golongan', 'kelas_kategori', 'jenis_kelamin', 'kontingen', 'no_undian'];    

}
