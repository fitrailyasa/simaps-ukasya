<?php

namespace App\Livewire\KetuaPertandingan;

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

class KetuaGanda extends Component
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
    

    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        if($this->gelanggang->jenis != "Ganda"){
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
        $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
    }

    #[On('echo:poin,.tambah-skor-ganda')]
    public function tambahNilaiHandler($data){
         if($this->gelanggang->id == $data["gelanggang"]["id"]){
             $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
             $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
         }
    }
    #[On('echo:poin,.salah-gerakan-ganda')]
    public function salahGerakanHandler(){
    }
    #[On('echo:poin,.penalty-ganda')]
    public function tambahPenaltyHandler(){
    }
    #[On('echo:poin,.hapus-penalty-ganda')]
    public function hapusPenaltyHandler(){
       $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
    }
    #[On('echo:arena,.ganti-tampil-ganda')]
    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }else{
                $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }
    }
    
    #[On('echo:arena,.ganti-tahap-ganda')]
    public function gantiTahapHandler($data){
        $this->tahap = $data["tahap"];
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
            $this->tahap = $this->jadwal->tahap;
            $this->tampil = $this->jadwal->TampilTGR->TGR;
            if($data["tahap"] == "tampil"){
                if($data["tampil"] == "merah"){
                    $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }else if($data["tampil"] == "biru"){
                    $this->penilaian_ganda_juri = PenilaianGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_ganda = PenaltyGanda::where('jadwal_ganda',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }
            }else if($data["tahap"] == "keputusan"){
                
            }
        }
    }

    #[On('echo:arena,.ganti-gelanggang')]
    public function GantiGelanggangHandler($data){
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
            $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
            $this->tahap = $this->jadwal->tahap;
            return redirect('/ketuapertandingan/'.$this->gelanggang->id);
        }
    }

    public function render()
    {
        return view('livewire.ketua-ganda')->extends('layouts.client.app')->section('content');
    }
}
