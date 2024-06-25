<?php

namespace App\Livewire\KetuaPertandingan;
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
        if($this->gelanggang->jenis != "Solo Kreatif"){
            return redirect('/ketuapertandingan/'.$this->gelanggang->id);
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/ketua/'.$this->gelanggang->id);
        }
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
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

    public function getListeners()
    {
        return [
            "echo-private:poin-{$this->jadwal->id},.tambah-skor-solo" => 'tambahNilaiHandler',
            "echo-private:poin-{$this->jadwal->id},.penalty-solo" => 'tambahPenaltyHandler',
            "echo-private:poin-{$this->jadwal->id},.hapus-penalty-solo" => 'hapusPenaltyHandler',
            "echo-private:arena-{$this->jadwal->id},.ganti-tahap-solo" => 'gantiTahapHandler',
            "echo-private:arena-{$this->jadwal->id},.ganti-tampil-solo" => 'gantiTampilHandler',
           "echo-private:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function tambahNilaiHandler($data){
         if($this->gelanggang->id == $data["gelanggang"]["id"]){
             $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
             $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
         }
    }
    public function tambahPenaltyHandler(){
    }
    public function hapusPenaltyHandler(){
       $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
    }
    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->tahap = $this->jadwal->tahap;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }else{
                $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }
    }
    public function gantiTahapHandler($data){
            $this->tahap = $this->jadwal->tahap;
            $this->tampil = $this->jadwal->TampilTGR->TGR;
            if($data["tahap"] == "tampil"){
                if($data["tampil"] == "merah"){
                    $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }else if($data["tampil"] == "biru"){
                    $this->penilaian_solo_juri = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_solo = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }
            }else if($data["tahap"] == "keputusan"){
                $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
            }
    }

    public function GantiGelanggangHandler($data){
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
            $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
            $this->tahap = $this->jadwal->tahap;
            return redirect('/ketuapertandingan/'.$this->gelanggang->id);
        }
    }
    public function render()
    {
        return view('livewire.ketua-solo')->extends('layouts.client.app')->section('content');
    }
}
