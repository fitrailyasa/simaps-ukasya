<?php

namespace App\Livewire\Dewan;

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
    public $sudut_merah;
    public $sudut_biru;
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penalty_solo;
    public $tampil;

    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Solo Kreatif"){
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
        $this->penalty_solo = PenaltySolo::where('sudut',$this->tampil->id)->where('jadwal_solo',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
        if(!$this->penalty_solo){
            $this->penalty_solo = PenaltySolo::create([
                'dewan'=>Auth::user()->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                'sudut'=>$this->tampil->id,
                'jadwal_solo'=>$this->jadwal->id
            ]);
        }
        $this->waktu = 0;
    }

    public function getListeners()
    {
        return [
            "echo-private:poin-{$this->jadwal->id},.hapus-penalty-solo" => 'hapusPenaltyHandler',
            "echo-private:arena-{$this->jadwal->id},.ganti-tahap-solo" => 'gantiTahapHandler',
            "echo-private:arena-{$this->jadwal->id},.ganti-tampil-solo" => 'gantiTampilHandler',
           "echo-private:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }

    public function penaltyTrigger($jenis_penalty){
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_solo->increment('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_solo->increment('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_solo->increment('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_solo->increment('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_solo->increment('tidak_bergerak');
                break;
            case 'senjata_jatuh':
                $this->penalty_solo->increment('senjata_jatuh');
                break;
        }
        PenaltyDewan::dispatch($this->jadwal, [$this->sudut_biru , $this->sudut_merah],$this->penalty_solo,Auth::user());
    }
    public function hapusPenaltyTrigger($jenis_penalty){
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_solo->decrement('toleransi_waktu');
                if($this->penalty_solo->toleransi_waktu < 0){
                    $this->penalty_solo->toleransi_waktu = 0;
                    $this->penalty_solo->save();
                    return;
                }
                break;
            case 'keluar_arena':
                $this->penalty_solo->decrement('keluar_arena');
                if($this->penalty_solo->keluar_arena < 0){
                    $this->penalty_solo->keluar_arena = 0;
                    $this->penalty_solo->save();
                    return;
                }
                break;
            case 'menyentuh_lantai':
                $this->penalty_solo->decrement('menyentuh_lantai');
                if($this->penalty_solo->menyentuh_lantai < 0){
                    $this->penalty_solo->menyentuh_lantai = 0;
                    $this->penalty_solo->save();
                    return;
                }
                break;
            case 'pakaian':
                $this->penalty_solo->decrement('pakaian');
                if($this->penalty_solo->pakaian < 0){
                    $this->penalty_solo->pakaian = 0;
                    $this->penalty_solo->save();
                    return;
                }
                break;
            case 'tidak_bergerak':
                $this->penalty_solo->decrement('tidak_bergerak');
                if($this->penalty_solo->tidak_bergerak < 0){
                    $this->penalty_solo->tidak_bergerak = 0;
                    $this->penalty_solo->save();
                    return;
                }
                break;
            case 'senjata_jatuh':
                $this->penalty_solo->decrement('senjata_jatuh');
                if($this->penalty_solo->senjata_jatuh < 0){
                    $this->penalty_solo->senjata_jatuh = 0;
                    $this->penalty_solo->save();
                    return;
                }
                break;
        }
        HapusPenalty::dispatch($this->jadwal, [$this->sudut_biru , $this->sudut_merah],$this->penalty_solo,Auth::user());
    }

    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.hapus-penalty-solo')]
    public function hapusPenaltyHandler(){
        if($this->jadwal->tampil == $this->pengundian_biru->id){
            $this->penalty_solo = PenaltySolo::where('sudut',$this->sudut_biru->id)->where('jadwal_solo',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_solo){
                $this->penalty_solo = PenaltySolo::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_biru->id,
                    'jadwal_solo'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_solo = PenaltySolo::where('sudut',$this->sudut_merah->id)->where('jadwal_solo',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_solo){
                $this->penalty_solo = PenaltySolo::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_merah->id,
                    'jadwal_solo'=>$this->jadwal->id
                ]);
            }
        }
    }

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

    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->waktu = 0;
        if($this->tampil->id == $this->sudut_biru->id){
            $this->penalty_solo = PenaltySolo::where('sudut',$this->sudut_biru->id)->where('jadwal_solo',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_solo){
                $this->penalty_solo = PenaltySolo::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_biru->id,
                    'jadwal_solo'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_solo = PenaltySolo::where('sudut',$this->sudut_merah->id)->where('jadwal_solo',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_solo){
                $this->penalty_solo = PenaltySolo::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_merah->id,
                    'jadwal_solo'=>$this->jadwal->id
                ]);
            }
        }
    }

    public function GantiGelanggangHandler(){
        if(Auth::user()->Gelanggang->jenis != "Solo Kreatif" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
    }

    public function render()
    {
        
        return view('livewire.dewan-solo')->extends('layouts.dewan.app')->section('content');
    }
}
