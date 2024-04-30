<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianTunggal;
use App\Models\PenaltyTunggal;
use App\Models\User;

class KetuaTunggal extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $penilaian_tunggal_juri;
    public $penalty_tunggal;
    public $juris;
    public $mulai = false;
    public $tahap = 'tampil';
    public $tampil;
    public $nilai_masuk = true;
    

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Tunggal')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->tampil = $this->sudut_biru->id;
        $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil)->get();
        $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
    }

    #[On('echo:poin,.tambah-skor-tunggal')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-tunggal')]
    public function salahGerakanHandler(){
    }
    #[On('echo:poin,.penalty-tunggal')]
    public function tambahPenaltyHandler(){
    }
    #[On('echo:poin,.hapus-penalty-tunggal')]
    public function hapusPenaltyHandler(){
    }

    public function render()
    {
        return view('livewire.ketua-tunggal')->extends('layouts.client.app')->section('content');
    }
}
