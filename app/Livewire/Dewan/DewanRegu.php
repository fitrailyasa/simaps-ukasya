<?php

namespace App\Livewire\Dewan;

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
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->tampil = $this->sudut_biru->id;
        $this->penalty_regu = PenaltyRegu::where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
        if(!$this->penalty_regu){
            $this->penalty_regu = PenaltyRegu::create([
                'dewan'=>Auth::user()->id,
                'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->sudut_merah->id.'-'.$this->jadwal->id,
                'sudut_merah'=>$this->sudut_merah->id,
                'sudut_biru'=>$this->sudut_biru->id,
                'jadwal_regu'=>$this->jadwal->id
            ]);
        }

    }

    public function penaltyTrigger($jenis_penalty){
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_regu->increment('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_regu->increment('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_regu->increment('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_regu->increment('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_regu->increment('tidak_bergerak');
                break;
        }
        PenaltyDewan::dispatch($this->jadwal,[$this->sudut_biru , $this->sudut_merah],$this->penalty_regu,Auth::user());    
    }
    public function hapusPenaltyTrigger($jenis_penalty){
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_regu->decrement('toleransi_waktu');
                if($this->penalty_regu->toleransi_waktu < 0){
                    $this->penalty_regu->toleransi_waktu = 0;
                    $this->penalty_regu->save();
                    return;
                }
                break;
            case 'keluar_arena':
                $this->penalty_regu->decrement('keluar_arena');
                if($this->penalty_regu->keluar_arena < 0){
                    $this->penalty_regu->keluar_arena = 0;
                    $this->penalty_regu->save();
                    return;
                }
                break;
            case 'menyentuh_lantai':
                $this->penalty_regu->decrement('menyentuh_lantai');
                if($this->penalty_regu->menyentuh_lantai < 0){
                    $this->penalty_regu->menyentuh_lantai = 0;
                    $this->penalty_regu->save();
                    return;
                }
                break;
            case 'pakaian':
                $this->penalty_regu->decrement('pakaian');
                if($this->penalty_regu->pakaian < 0){
                    $this->penalty_regu->pakaian = 0;
                    $this->penalty_regu->save();
                    return;
                }
                break;
            case 'tidak_bergerak':
                $this->penalty_regu->decrement('tidak_bergerak');
                if($this->penalty_regu->tidak_bergerak < 0){
                    $this->penalty_regu->tidak_bergerak = 0;
                    $this->penalty_regu->save();
                    return;
                }
                break;
        }
        HapusPenalty::dispatch($this->jadwal,[$this->sudut_biru , $this->sudut_merah],$this->penalty_regu,Auth::user());    
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
