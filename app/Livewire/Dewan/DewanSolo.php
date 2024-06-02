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
    public $gelanggang;
    public $waktu ;
    public $tampil;
    public $sudut_biru;
    public $sudut_merah;
    public $mulai = false;
    public $penalty_solo;

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Solo_kreatif')->first();
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->tampil = $this->sudut_merah;
        $this->penalty_solo = PenaltySolo::where('sudut',$this->tampil->id)->where('jadwal_solo',$this->jadwal->id)->where('dewan',Auth::user()->id)->first();
        if(!$this->penalty_solo){
            $this->penalty_solo = PenaltySolo::create([
                'dewan'=>Auth::user()->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                'sudut'=>$this->tampil->id,
                'jadwal_solo'=>$this->jadwal->id
            ]);
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
        PenaltyDewan::dispatch($this->jadwal, $this->tampil->id == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_solo,Auth::user());
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
        HapusPenalty::dispatch($this->jadwal, $this->tampil->id == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penalty_solo,Auth::user());
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
