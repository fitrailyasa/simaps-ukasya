<?php

namespace App\Livewire\Dewan;

use App\Events\Ganda\GantiTahap;
use App\Events\Ganda\GantiTampil;
use App\Models\PenaltyGanda;
use App\Models\PengundianTGR;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Ganda\TambahNilai;
use App\Events\Ganda\SalahGerakan;
use App\Events\Ganda\PenaltyDewan;
use App\Events\Ganda\HapusPenalty;

class DewanGanda extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penalty_ganda;
    public $tampil;

    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Ganda"){
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
        $this->penalty_ganda = PenaltyGanda::where('sudut',$this->tampil->id)->where('jadwal_ganda',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
        if(!$this->penalty_ganda){
            $this->penalty_ganda = PenaltyGanda::create([
                'dewan'=>Auth::user()->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                'sudut'=>$this->tampil->id,
                'jadwal_ganda'=>$this->jadwal->id
            ]);
        }
        $this->waktu = 0;
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }

    public function penaltyTrigger($jenis_penalty){
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_ganda->increment('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_ganda->increment('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_ganda->increment('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_ganda->increment('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_ganda->increment('tidak_bergerak');
                break;
            case 'senjata_jatuh':
                $this->penalty_ganda->increment('senjata_jatuh');
                break;
        }
        PenaltyDewan::dispatch($this->jadwal, [$this->sudut_biru , $this->sudut_merah],$this->penalty_ganda,Auth::user());
    }
    public function hapusPenaltyTrigger($jenis_penalty){
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_ganda->decrement('toleransi_waktu');
                if($this->penalty_ganda->toleransi_waktu < 0){
                    $this->penalty_ganda->toleransi_waktu = 0;
                    $this->penalty_ganda->save();
                    return;
                }
                break;
            case 'keluar_arena':
                $this->penalty_ganda->decrement('keluar_arena');
                if($this->penalty_ganda->keluar_arena < 0){
                    $this->penalty_ganda->keluar_arena = 0;
                    $this->penalty_ganda->save();
                    return;
                }
                break;
            case 'menyentuh_lantai':
                $this->penalty_ganda->decrement('menyentuh_lantai');
                if($this->penalty_ganda->menyentuh_lantai < 0){
                    $this->penalty_ganda->menyentuh_lantai = 0;
                    $this->penalty_ganda->save();
                    return;
                }
                break;
            case 'pakaian':
                $this->penalty_ganda->decrement('pakaian');
                if($this->penalty_ganda->pakaian < 0){
                    $this->penalty_ganda->pakaian = 0;
                    $this->penalty_ganda->save();
                    return;
                }
                break;
            case 'tidak_bergerak':
                $this->penalty_ganda->decrement('tidak_bergerak');
                if($this->penalty_ganda->tidak_bergerak < 0){
                    $this->penalty_ganda->tidak_bergerak = 0;
                    $this->penalty_ganda->save();
                    return;
                }
                break;
            case 'senjata_jatuh':
                $this->penalty_ganda->decrement('senjata_jatuh');
                if($this->penalty_ganda->senjata_jatuh < 0){
                    $this->penalty_ganda->senjata_jatuh = 0;
                    $this->penalty_ganda->save();
                    return;
                }
                break;
        }
        HapusPenalty::dispatch($this->jadwal, [$this->sudut_biru , $this->sudut_merah],$this->penalty_ganda,Auth::user());
    }

    #[On('echo:poin,.penalty-ganda')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.hapus-penalty-ganda')]
    public function hapusPenaltyHandler(){
        if($this->jadwal->tampil == $this->pengundian_biru->id){
            $this->penalty_ganda = PenaltyGanda::where('sudut',$this->sudut_biru->id)->where('jadwal_ganda',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_ganda){
                $this->penalty_ganda = PenaltyGanda::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_biru->id,
                    'jadwal_ganda'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_ganda = PenaltyGanda::where('sudut',$this->sudut_merah->id)->where('jadwal_ganda',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_ganda){
                $this->penalty_ganda = PenaltyGanda::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->sudut_merah->id,
                    'jadwal_ganda'=>$this->jadwal->id
                ]);
            }
        }
    }

    #[On('echo:arena,.ganti-tahap-ganda')]
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

    #[On('echo:arena,.ganti-tampil-ganda')]
    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->waktu = 0;
        if($this->tampil->id == $this->sudut_biru->id){
            $this->penalty_ganda = PenaltyGanda::where('sudut',$this->sudut_biru->id)->where('jadwal_ganda',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_ganda){
                $this->penalty_ganda = PenaltyGanda::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->jadwal->sudut_biru,
                    'jadwal_ganda'=>$this->jadwal->id
                ]);
            }
        }else{
            $this->penalty_ganda = PenaltyGanda::where('sudut',$this->sudut_merah->id)->where('jadwal_ganda',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
            if(!$this->penalty_ganda){
                $this->penalty_ganda = PenaltyGanda::create([
                    'dewan'=>Auth::user()->id,
                    'uuid'=>date('Ymd-His').'-'.$this->jadwal->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                    'sudut'=>$this->jadwal->sudut_merah,
                    'jadwal_ganda'=>$this->jadwal->id
                ]);
            }
        }
    }

    #[On('echo:arena,.ganti-gelanggang')]
    public function GantiGelanggangHandler(){
        if(Auth::user()->Gelanggang->jenis != "Ganda" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
    }

    public function render()
    {
        
        return view('livewire.dewan-ganda')->extends('layouts.dewan.app')->section('content');
    }
}
