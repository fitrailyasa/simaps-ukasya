<?php

namespace App\Livewire;

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
use App\Models\PenaltyGanda;

class DewanGanda extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penalty_ganda;

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Ganda')->first();
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->penalty_ganda = PenaltyGanda::where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->where('jadwal_ganda',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
        if(!$this->penalty_ganda){
            $this->penalty_ganda = PenaltyGanda::create([
                'dewan'=>Auth::user()->id,
                'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->sudut_merah->id.'-'.$this->jadwal->id,
                'sudut_merah'=>$this->sudut_merah->id,
                'sudut_biru'=>$this->sudut_biru->id,
                'jadwal_ganda'=>$this->jadwal->id
            ]);
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
    }

    public function render()
    {
        
        return view('livewire.dewan-ganda')->extends('layouts.dewan.app')->section('content');
    }
}
