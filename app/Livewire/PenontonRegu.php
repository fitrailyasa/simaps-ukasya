<?php

namespace App\Livewire;
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
    public $gelanggang;
    public $waktu ;
    public $penilaian_regu_juri;
    public $penalty_regu;
    public $juris;
    public $mulai = false;
    public $tahap = 'tampil';
    public $nilai_masuk = true;
    

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Regu')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->get();
        $this->penalty_regu = Penaltyregu::where('jadwal_regu',$this->jadwal->id)->where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
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
