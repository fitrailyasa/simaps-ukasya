<?php

namespace App\Livewire\Penonton;
use App\Models\PengundianTGR;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianSolo;
use App\Models\PenaltySolo;
use App\Models\User;

class PenontonSolo extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $penilaian_solo_juri_merah;
    public $penalty_solo_merah;
    public $penilaian_solo_juri_biru;
    public $penalty_solo_biru;
    public $penilaian_solo_juri;
    public $penalty_solo;
    public $juris;
    public $mulai = false;
    public $tahap ;
    public $tampil;
    public $jenis = "solo";

    

    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal->sudut_biru);
        $this->pengundian_merah = PengundianTGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->pengundian_biru->atlet_id);
        $this->sudut_merah = TGR::find($this->pengundian_merah->atlet_id);
        $this->tampil = TGR::find($this->jadwal->tampil == $this->pengundian_merah->atlet_id ? $this->sudut_merah->id : $this->sudut_biru->id);
        $this->tahap = $this->jadwal->tahap;
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
    }

    public function check_gelanggang()  {
        if($this->gelanggang->jenis !== "Solo Kreatif"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
    }

    #[On('echo:poin,.tambah-skor-solo')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-solo')]
    public function salahGerakanHandler(){
    }
    #[On('echo:poin,.penalty-solo')]
    public function tambahPenaltyHandler(){
    }
    #[On('echo:poin,.hapus-penalty-solo')]
    public function hapusPenaltyHandler(){
    }

    public function render()
    {
        return view('livewire.penonton-solo')->extends('layouts.client.app')->section('content');
    }
}
