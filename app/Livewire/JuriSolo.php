<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Solo\TambahNilai;
use App\Events\Solo\SalahGerakan;
use App\Models\PenilaianSolo;


class JuriSolo extends Component
{
    public $jadwal;
    public $sudut;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_solo;
    
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Solo_kreatif')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut = TGR::find($this->jadwal->sudut_merah);
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->penilaian_solo = PenilaianSolo::where('sudut',$this->sudut->id)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
    }

    public function tambahNilaiTrigger($value,$jenis_skor){
        TambahNilai::dispatch($this->jadwal->id,$this->sudut->id,$value/100,Auth::user()->id,$jenis_skor);
    }

    public function salahGerakanTrigger(){
        SalahGerakan::dispatch($this->jadwal->id,$this->sudut->id,Auth::user()->id);
    }

    #[On('echo:poin,.tambah-skor-solo')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-solo')]
    public function salahGerakanHandler(){
    }

    public function render()
    {
        return view('livewire.juri-solo',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
