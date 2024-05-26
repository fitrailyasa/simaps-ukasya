<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Solo\TambahNilai;
use App\Events\Solo\SalahGerakan;
use App\Events\Solo\PenaltyDewan;
use App\Events\Solo\HapusPenalty;
use App\Models\PenaltySolo;

class DewanSolo extends Component
{
    public $jadwal;
    public $sudut;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penalty_solo;

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Solo_kreatif')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut = TGR::find($this->jadwal->sudut_merah);
        $this->tampil = $this->jadwal->sudut_merah;
        $this->penalty_solo = PenaltySolo::where('sudut',$this->sudut->id)->where('jadwal_solo',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
        if(!$this->penalty_solo){
            $this->penalty_solo = PenaltySolo::create([
                'dewan'=>Auth::user()->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                'sudut'=>$this->tampil,
                'jadwal_solo'=>$this->jadwal->id
            ]);
        }
    }

    public function penaltyTrigger($jenis_penalty){
        PenaltyDewan::dispatch($this->jadwal->id,$this->sudut->id,Auth::user()->id,$jenis_penalty);
    }
    public function hapusPenaltyTrigger($jenis_penalty){
        HapusPenalty::dispatch($this->jadwal->id,$this->sudut->id,Auth::user()->id,$jenis_penalty);
    }

    #[On('echo:poin,.penalty-solo')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.hapus-penalty-solo')]
    public function hapusPenaltyHandler(){
    }

    public function render()
    {
        
        return view('livewire.dewan-solo')->extends('layouts.dewan.app')->section('content');
    }
}
