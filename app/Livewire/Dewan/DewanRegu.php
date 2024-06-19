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
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu = 0;
    public $tampil;
    public $mulai = false;
    public $penalty_regu;

    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Regu"){
            return redirect('auth');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($this->jadwal->tampil == $this->pengundian_biru->id){
            $this->penalty_regu = PenaltyRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_regu){
                $this->penalty_regu = PenaltyRegu::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_biru->id,
                    'jadwal_regu'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_regu = PenaltyRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_regu){
                $this->penalty_regu = PenaltyRegu::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_merah->id,
                    'jadwal_regu'=>$this->jadwal->id
                ]);
            }
        }
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
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
        PenaltyDewan::dispatch($this->jadwal,$this->jadwal->tampil == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_regu,Auth::user());
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
        HapusPenalty::dispatch($this->jadwal,$this->jadwal->tampil == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_regu,Auth::user());
    }

   

    #[On('echo:poin,.penalty-regu')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.hapus-penalty-regu')]
    public function hapusPenaltyHandler(){
    }
    #[On('echo:arena,.ganti-tahap-regu')]
    public function gantiTahapHandler($data){
        $this->waktu = ($data["waktu"] * 60 + 1.1) / 60;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tahap"] == "tampil"){
            $this->tampil_nilai = false;
            $this->mulai = true;
        }else if($data["tahap"] == "keputusan"){
            
        }else if($data["tahap"] == "pause"){
            $this->mulai = false;
            $this->waktu = ($data["waktu"] * 60) / 60;
        }else if($data["tahap"] == "tampil nilai"){
            $this->tampil_nilai = true;
            $this->mulai = false;
        }
    }

    #[On('echo:arena,.ganti-tampil-regu')]
    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->waktu = 0;
        if($this->tampil->id == $this->sudut_biru->id){
            $this->penalty_regu = PenaltyRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_regu){
                $this->penalty_regu = PenaltyRegu::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->jadwal->sudut_biru->id,
                    'jadwal_regu'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_regu = PenaltyRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_regu){
                $this->penalty_regu = PenaltyRegu::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->jadwal->sudut_merah->id,
                    'jadwal_regu'=>$this->jadwal->id
                ]);
            }
        }
    }

    public function render()
    {
        
        return view('livewire.dewan-regu')->extends('layouts.dewan.app')->section('content');
    }
}
