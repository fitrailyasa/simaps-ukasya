<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengundianTGR extends Model
{
    use HasFactory;

    protected $table = 'pengundian_tgr';
    protected $fillable = ['nama', 'no_undian'];    

}
