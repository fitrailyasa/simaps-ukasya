<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianJuri extends Model
{
    use HasFactory;

     protected $table = 'penilaian_juri';
    protected $fillable = ['uuid','juri','sudut','data'];
    
    public function Tanding()
    {
        return $this->belongsTo(Tanding::class, 'sudut', 'id');
    }
    public function Gelanggang()
    {
        return $this->belongsTo(Gelanggang::class, 'gelanggang', 'id');
    }
    public function Juri()
    {
        return $this->belongsTo(User::class, 'juri', 'id');
    }
}
