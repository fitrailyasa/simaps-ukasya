<?php

namespace App\Livewire\Penonton;
use App\Models\PengundianTGR;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianRegu;
use App\Models\PenaltyRegu;
use App\Models\User;

class PenontonRegu extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $penilaian_regu_juri;
    public $penalty_regu;
    public $juris;
    public $mulai = false;
    public $tahap;
    public $tampil;
    public $penilaian_regu_juri_merah;
    public $penalty_regu_merah;
    public $penilaian_regu_juri_biru;
    public $penalty_regu_biru;
    public $jenis = "regu";


    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->pengundian_merah = PengundianTGR::find($this->jadwal->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal->sudut_biru);
        $this->sudut_biru = TGR::find($this->pengundian_biru->atlet_id);
        $this->sudut_merah = TGR::find($this->pengundian_merah->atlet_id);
        $this->tampil = TGR::find($this->jadwal->tampil == $this->pengundian_merah->atlet_id ? $this->sudut_merah->id : $this->sudut_biru->id);
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->tahap = $this->jadwal->tahap;
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = $this->gelanggang->waktu;
    }

    public function check_gelanggang()  {
        if($this->gelanggang->jenis !== "Regu"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
    }

    #[On('echo:poin,.tambah-skor-regu')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-regu')]
    public function salahGerakanHandler(){
    }
    #[On('echo:poin,.penalty-regu')]
    public function tambahPenaltyHandler(){
    }
    #[On('echo:poin,.hapus-penalty-regu')]
    public function hapusPenaltyHandler(){
    }

    public function render()
    {
        return view('livewire.penonton-regu')->extends('layouts.client.app')->section('content');
    }
}
