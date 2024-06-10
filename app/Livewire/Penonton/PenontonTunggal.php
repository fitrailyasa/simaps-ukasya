<?php

namespace App\Livewire\Penonton;
use App\Models\PengundianTGR;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianTunggal;
use App\Models\PenaltyTunggal;
use App\Models\User;

class PenontonTunggal extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $penilaian_tunggal_juri;
    public $penalty_tunggal;
    public $juris;
    public $mulai = false;
    public $tahap;
    public $tampil;
    public $penilaian_tunggal_juri_merah;
    public $penalty_tunggal_merah;
    public $penilaian_tunggal_juri_biru;
    public $penalty_tunggal_biru;
    public $tampil_nilai;
    public $jenis = "tunggal";
    

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
        $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = $this->gelanggang->waktu;
        if ($this->jadwal->tahap == "tampil nilai") {
            $this->tampil_nilai = true;
        }
    }
    public function check_gelanggang()  {
        if($this->gelanggang->jenis !== "Tunggal"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 - 0.1) / 60;
        }
    }

    #[On('echo:poin,.tambah-skor-tunggal')]
    public function tambahNilaiHandler(){
        $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
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
    #[On('echo:arena,.ganti-tahap-tunggal')]
    public function gantiTahapHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->tampil = $data["sudut_tampil"];
        if($data["tahap"] == "tampil"){
            $this->tampil_nilai = false;
            $this->mulai = true;
        }else if($data["tahap"] == "keputusan"){
            
        }else if($data["tahap"] == "pause"){
            $this->waktu = $this->gelanggang->waktu;
            $this->mulai = false;
        }else if($data["tahap"] == "tampil nilai"){
            $this->tampil_nilai = true;
            $this->mulai = false;
        }
    }

    #[On('echo:arena,.ganti-tampil-tunggal')]
    public function gantiTampilHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->tampil_nilai = false;
        $this->tampil = $data["tampil"];
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }else{
                $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }
    }
    

    public function render()
    {
        return view('livewire.penonton-tunggal')->extends('layouts.client.app')->section('content');
    }
}
