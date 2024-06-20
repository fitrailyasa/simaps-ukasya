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
    public $tampil_nilai = false;

    

    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        if($this->gelanggang->jenis != "Solo Kreatif"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/penonton/'.$this->gelanggang->id);
        }
        $this->pengundian_biru = PengundianTGR::find($this->jadwal->sudut_biru);
        $this->pengundian_merah = PengundianTGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->pengundian_biru->atlet_id);
        $this->sudut_merah = TGR::find($this->pengundian_merah->atlet_id);
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->tahap = $this->jadwal->tahap;
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = 0;
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }

    public function check_gelanggang()  {
        if($this->gelanggang->jenis !== "Solo Kreatif"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
    }

    #[On('echo:poin,.tambah-skor-solo')]
    public function tambahNilaiHandler(){
        $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
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

    #[On('echo:arena,.ganti-tahap-solo')]
    public function gantiTahapHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tahap"] == "tampil"){
            $this->waktu = ($data["waktu"] * 60 + 1.1) / 60;
            $this->mulai = true;
            if($data["tampil"] == "merah"){
                $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }else if($data["tampil"] == "biru"){
                $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }
        }else if($data["tahap"] == "keputusan"){
            $this->tahap = $this->jadwal->tahap;
        }else if($data["tahap"] == "tampil nilai"){
            $this->tampil_nilai = true;
            $this->mulai = false;
        }else if($data["tahap"] == "pause"){
            $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            $this->waktu = ($data["waktu"] * 60) / 60;
            $this->mulai = false;
        }
    }
    #[On('echo:arena,.ganti-tampil-solo')]
    public function gantiTampilHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->waktu = 0;
        $this->tampil_nilai = false;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }else{
                $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }
    }

    #[On('echo:arena,.ganti-gelanggang')]
    public function GantiGelanggangHandler(){
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->tahap = $this->jadwal->tahap;
        return redirect('/penonton/'.$this->gelanggang->id);
    }
    public function render()
    {
        return view('livewire.penonton-solo')->extends('layouts.client.app')->section('content');
    }
}
