<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Regu\TambahNilai;
use App\Events\Regu\SalahGerakan;
use App\Events\Regu\PenaltyDewan;
use App\Events\Regu\HapusPenalty;
use App\Models\PenaltyRegu;

class DewanRegu extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $tampil;
    public $mulai = false;
    public $penalty_regu;

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Regu')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->tampil = $this->sudut_biru->id;
        $this->penalty_regu = PenaltyRegu::where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();

    }

    public function penaltyTrigger($jenis_penalty){
        PenaltyDewan::dispatch($this->jadwal->id,$this->sudut_merah->id,$this->sudut_biru->id,Auth::user()->id,$jenis_penalty);
    }
    public function hapusPenaltyTrigger($jenis_penalty){
        HapusPenalty::dispatch($this->jadwal->id,$this->tampil,Auth::user()->id,$jenis_penalty);
    }

    #[On('echo:poin,.penalty-regu')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.hapus-penalty-regu')]
    public function hapusPenaltyHandler(){
    }

    public function render()
    {
        
        return view('livewire.dewan-regu')->extends('layouts.dewan.app')->section('content');
    }
}
