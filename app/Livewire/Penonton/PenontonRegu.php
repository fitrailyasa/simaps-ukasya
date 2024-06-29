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
    public $tampil_nilai= false;
    public $tahap;
    public $tampil;
    public $penilaian_regu_juri_merah;
    public $penalty_regu_merah;
    public $penilaian_regu_juri_biru;
    public $penalty_regu_biru;
    public $jenis = "regu";


    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        if($this->gelanggang->jenis != "Regu"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/penonton/'.$this->gelanggang->id);
        }
        $this->pengundian_merah = PengundianTGR::find($this->jadwal->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal->sudut_biru);
        $this->sudut_biru = TGR::find($this->pengundian_biru->atlet_id);
        $this->sudut_merah = TGR::find($this->pengundian_merah->atlet_id);
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->tahap = $this->jadwal->tahap;
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = 0;
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }

    #[On('echo:poin,.tambah-skor-regu')]
    public function tambahNilaiHandler(){
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
       }
    #[On('echo:poin,.salah-gerakan-regu')]
    public function salahGerakanHandler(){
    }
    #[On('echo:poin,.penalty-regu')]
    public function tambahPenaltyHandler(){
    }
    #[On('echo:poin,.hapus-penalty-regu')]
    public function hapusPenaltyHandler(){
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
    }
    #[On('echo:arena,.ganti-tahap-regu')]
    public function gantiTahapHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tahap"] == "tampil"){
            $this->waktu = ($data["waktu"] * 60 + 1.1) / 60;
            $this->tampil_nilai = false;
            $this->mulai = true;
        }else if($data["tahap"] == "keputusan"){
            
        }else if($data["tahap"] == "pause"){
            $this->penalty_solo = PenaltyRegu::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            $this->waktu = ($data["waktu"]) / 60;
            $this->mulai = false;
        }else if($data["tahap"] == "tampil nilai"){
            $this->tampil_nilai = true;
            $this->mulai = false;
        }else{

        }
    }

    #[On('echo:arena,.ganti-tampil-regu')]
    public function gantiTampilHandler($data){
        $this->tahap = $this->jadwal->tahap;
        $this->tampil_nilai = false;
        $this->waktu = 0;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }else{
                $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil)->get();
                $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil)->first();
            }
    }
    public function check_gelanggang()  {
        if($this->gelanggang->jenis !== "Regu"){
            return redirect('/penonton/'.$this->gelanggang->id);
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
        return view('livewire.penonton-regu')->extends('layouts.client.app')->section('content');
    }
}
