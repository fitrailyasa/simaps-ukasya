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
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
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
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_tunggal->increment('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_tunggal->increment('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_tunggal->increment('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_tunggal->increment('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_tunggal->increment('tidak_bergerak');
                break;
        }
        PenaltyDewan::dispatch($this->jadwal,$this->tampil == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_tunggal,Auth::user());
    }
    public function hapusPenaltyTrigger($jenis_penalty){
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_tunggal->decrement('toleransi_waktu');
                if($this->penalty_tunggal->toleransi_waktu < 0){
                    $this->penalty_tunggal->toleransi_waktu = 0;
                    $this->penalty_tunggal->save();
                    return;
                }
                break;
            case 'keluar_arena':
                $this->penalty_tunggal->decrement('keluar_arena');
                if($this->penalty_tunggal->keluar_arena < 0){
                    $this->penalty_tunggal->keluar_arena = 0;
                    $this->penalty_tunggal->save();
                    return;
                }
                break;
            case 'menyentuh_lantai':
                $this->penalty_tunggal->decrement('menyentuh_lantai');
                if($this->penalty_tunggal->menyentuh_lantai < 0){
                    $this->penalty_tunggal->menyentuh_lantai = 0;
                    $this->penalty_tunggal->save();
                    return;
                }
                break;
            case 'pakaian':
                $this->penalty_tunggal->decrement('pakaian');
                if($this->penalty_tunggal->pakaian < 0){
                    $this->penalty_tunggal->pakaian = 0;
                    $this->penalty_tunggal->save();
                    return;
                }
                break;
            case 'tidak_bergerak':
                $this->penalty_tunggal->decrement('tidak_bergerak');
                if($this->penalty_tunggal->tidak_bergerak < 0){
                    $this->penalty_tunggal->tidak_bergerak = 0;
                    $this->penalty_tunggal->save();
                    return;
                }
                break;
        }
        HapusPenalty::dispatch($this->jadwal,$this->tampil == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_tunggal,Auth::user());
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
