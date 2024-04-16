<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Babak extends Model
{
    use HasFactory;

    protected $table = 'penilaian_tanding';
    protected $fillable = ['babak','pukulan', 'tendangan', 'binaan','peringatan','teguran','jatuhan','atlet'];
    
    public function Tanding()
    {
        return $this->belongsTo(Tanding::class, 'tanding','atlet', 'id');
    }
}
