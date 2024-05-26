<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Tunggal\PenaltyDewan;
use App\Events\Tunggal\HapusPenalty;
use App\Models\PenaltyTunggal;

class DewanTunggal extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $tampil;
    public $mulai = false;
    public $penalty_tunggal;

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Tunggal')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->tampil = $this->sudut_biru->id;
        if($this->tampil == $this->sudut_biru->id){
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->tampil,
                    'jadwal_tunggal'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->tampil,
                    'jadwal_tunggal'=>$this->jadwal->id
                ]);
            }
        }
    }

    public function penaltyTrigger($jenis_penalty){
        PenaltyDewan::dispatch($this->jadwal->id,$this->tampil,Auth::user()->id,$jenis_penalty);
    }
    public function hapusPenaltyTrigger($jenis_penalty){
        HapusPenalty::dispatch($this->jadwal->id,$this->tampil,Auth::user()->id,$jenis_penalty);
    }

    #[On('echo:poin,.penalty-tunggal')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.hapus-penalty-tunggal')]
    public function hapusPenaltyHandler(){
    }

    public function render()
    {
        
        return view('livewire.dewan-tunggal')->extends('layouts.dewan.app')->section('content');
    }
}
