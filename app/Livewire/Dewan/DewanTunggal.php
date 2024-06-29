<?php

namespace App\Livewire\Dewan;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Tunggal\PenaltyDewan;
use App\Events\Tunggal\HapusPenalty;
use App\Events\Tunggal\GantiTahap;
use App\Models\PenaltyTunggal;

class DewanTunggal extends Component
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
    public $penalty_tunggal;

    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Tunggal"){
            return redirect('auth');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/dewan/'.$this->gelanggang->id);
        }
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($this->jadwal->tampil == $this->pengundian_biru->id){
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_biru->id,
                    'jadwal_tunggal'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_merah->id,
                    'jadwal_tunggal'=>$this->jadwal->id
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
        PenaltyDewan::dispatch($this->jadwal,$this->jadwal->tampil == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_tunggal,Auth::user());
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
        HapusPenalty::dispatch($this->jadwal,$this->jadwal->tampil == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_tunggal,Auth::user());
    }

   

    #[On('echo:poin,.penalty-tunggal')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.hapus-penalty-tunggal')]
    public function hapusPenaltyHandler(){
        if($this->jadwal->tampil == $this->pengundian_biru->id){
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_biru->id,
                    'jadwal_tunggal'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_merah->id,
                    'jadwal_tunggal'=>$this->jadwal->id
                ]);
            }
        }
    }
    #[On('echo:arena,.ganti-tahap-tunggal')]
    public function gantiTahapHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tahap"] == "tampil"){
            $this->waktu = ($data["waktu"] * 60 + 1.1) / 60;
            $this->mulai = true;
        }else if($data["tahap"] == "keputusan"){
            
        }else if($data["tahap"] == "pause"){
            $this->mulai = false;
            $this->waktu = ($data["waktu"] * 60) / 60;
        }else if($data["tahap"] == "tampil nilai"){
            $this->mulai = false;
        }
    }

    #[On('echo:arena,.ganti-tampil-tunggal')]
    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->waktu = 0;
        if($this->tampil->id == $this->sudut_biru->id){
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_biru->id,
                    'jadwal_tunggal'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_tunggal = PenaltyTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_tunggal){
                $this->penalty_tunggal = PenaltyTunggal::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_merah->id,
                    'jadwal_tunggal'=>$this->jadwal->id
                ]);
            }
        }
    }

    #[On('echo:arena,.ganti-gelanggang')]
    public function GantiGelanggangHandler(){
        if(Auth::user()->Gelanggang->jenis != "Tunggal" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
    }

    public function render()
    {
        
        return view('livewire.dewan-tunggal')->extends('layouts.dewan.app')->section('content');
    }
}
