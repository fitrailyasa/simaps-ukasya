<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianSolo;
use App\Models\PenaltySolo;
use App\Models\User;

class KetuaSolo extends Component
{
    public $jadwal;
    public $sudut;
    public $gelanggang;
    public $waktu ;
    public $penilaian_solo_juri;
    public $penalty_solo;
    public $juris;
    public $mulai = false;
    public $tahap = 'tampil';
    public $nilai_masuk = true;
    

    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Solo_Kreatif')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut = TGR::find($this->jadwal->sudut_merah);
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut->id)->get();
        $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut->id)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
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
        return view('livewire.ketua-solo')->extends('layouts.client.app')->section('content');
    }
}
