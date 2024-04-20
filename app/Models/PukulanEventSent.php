<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PukulanEventSent extends Model
{
    protected $table = 'pukulan_event_sent';
    protected $fillable = ['uuid','event_sent','jadwal_tanding','sudut'];
    
    public function JadwalTanding()
    {
        return $this->belongsTo(JadwalTanding::class,'jadwal_tanding', 'id');
    }
    public function Sudut(){
        return $this->belongsTo(Tanding::class,'sudut', 'id');
    }
}
