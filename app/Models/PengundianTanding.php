<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengundianTanding extends Model
{
    use HasFactory;

    protected $table = 'pengundian_tanding';
    protected $fillable = ['nama', 'no_undian'];    

}
