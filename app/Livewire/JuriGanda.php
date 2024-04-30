<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Ganda\TambahNilai;
use App\Events\Ganda\SalahGerakan;
use App\Models\PenilaianGanda;


class JuriGanda extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_ganda;
    
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Ganda')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->penilaian_ganda = PenilaianGanda::where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
    }

    public function tambahNilaiTrigger($value,$jenis_skor){
        TambahNilai::dispatch($this->jadwal->id,$this->sudut_biru->id,$this->sudut_merah->id,$value/100,Auth::user()->id,$jenis_skor);
    }

    public function salahGerakanTrigger(){
        SalahGerakan::dispatch($this->jadwal->id,$this->sudut_biru->id,$this->sudut_merah->id,Auth::user()->id);
    }

    #[On('echo:poin,.tambah-skor-ganda')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-ganda')]
    public function salahGerakanHandler(){
    }

    public function render()
    {
        return view('livewire.juri-ganda',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
