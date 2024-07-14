<?php

namespace App\Livewire\Penonton;
use App\Models\PengundianTGR;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianGanda;
use App\Models\PenaltyGanda;
use App\Models\User;

class PenontonGanda extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $penilaian_ganda_juri_merah;
    public $penalty_ganda_merah;
    public $penilaian_ganda_juri_biru;
    public $penalty_ganda_biru;
    public $penilaian_ganda_juri;
    public $penalty_ganda;
    public $juris;
    public $mulai = false;
    public $tahap ;
    public $tampil;
    public $jenis = "ganda";
    public $tampil_nilai = false;

    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        if($this->gelanggang->jenis != "Ganda"){
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
        $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = 0;
    }

    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal->id},.tambah-skor-ganda" => 'tambahNilaiHandler',
            "echo:poin-{$this->jadwal->id},.penalty-ganda" => 'tambahPenaltyHandler',
            "echo:poin-{$this->jadwal->id},.hapus-penalty-ganda" => 'hapusPenaltyHandler',
            "echo:arena-{$this->jadwal->id},.ganti-tahap-ganda" => 'gantiTahapHandler',
            "echo:arena-{$this->jadwal->id},.ganti-tampil-ganda" => 'gantiTampilHandler',
           "echo:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }

    public function check_gelanggang()  {
        if($this->gelanggang->jenis !== "Ganda"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
    }

    public function tambahNilaiHandler(){
        $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
    }
  
    public function hapusPenaltyHandler(){
       $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
    }

    public function gantiTahapHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        if($data["tahap"] == "tampil"){
            $this->waktu = ($data["waktu"] * 60 + 1.1) / 60;
            $this->mulai = true;
            if($data["tampil"] == "merah"){
                $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }else if($data["tampil"] == "biru"){
                $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }
        }else if($data["tahap"] == "keputusan"){
            $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
            $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        }else if($data["tahap"] == "tampil nilai"){
            $this->tampil_nilai = true;
            $this->mulai = false;
        }else if($data["tahap"] == "pause"){
            $this->waktu = ($data["waktu"] * 60) / 60;
            $this->mulai = false;
        }
    }
    public function gantiTampilHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->waktu = 0;
        $this->tampil_nilai = false;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }else{
                $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }
    }

    public function GantiGelanggangHandler(){
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->tahap = $this->jadwal->tahap;
        return redirect('/penonton/'.$this->gelanggang->id);
    }
    public function render()
    {
        return view('livewire.penonton-ganda')->extends('layouts.client.app')->section('content');
    }
}
