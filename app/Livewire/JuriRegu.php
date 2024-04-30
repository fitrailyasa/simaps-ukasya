<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Regu\TambahNilai;
use App\Events\Regu\SalahGerakan;
use App\Models\PenilaianRegu;


class JuriRegu extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_regu;
    
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Regu')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->penilaian_regu = PenilaianRegu::where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
    }

    public function tambahNilaiTrigger($value){
        $this->flow_score = $value/100;
        TambahNilai::dispatch($this->jadwal->id,$this->sudut_biru->id,$this->sudut_merah->id,$this->flow_score,Auth::user()->id);
    }

    public function salahGerakanTrigger(){
        SalahGerakan::dispatch($this->jadwal->id,$this->sudut_biru->id,$this->sudut_merah->id,Auth::user()->id);
    }

    #[On('echo:poin,.tambah-skor-regu')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-regu')]
    public function salahGerakanHandler(){
    }

    public function render()
    {
        return view('livewire.juri-regu',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
