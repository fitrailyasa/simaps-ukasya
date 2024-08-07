<?php

namespace App\Livewire\KetuaPertandingan;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianRegu;
use App\Models\PenaltyRegu;
use App\Models\User;

class KetuaRegu extends Component
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
            return redirect('/ketuapertandingan/'.$this->gelanggang->id);
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/ketua/'.$this->gelanggang->id);
        }
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->juris = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
        $this->tahap = $this->jadwal->tahap;
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
    }
    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal->id},.tambah-skor-regu" => 'tambahNilaiHandler',
            "echo:poin-{$this->jadwal->id},.penalty-regu" => 'tambahPenaltyHandler',
            "echo:poin-{$this->jadwal->id},.salah-gerakan-regu" => 'salahGerakanHandler',
            "echo:poin-{$this->jadwal->id},.hapus-penalty-regu" => 'hapusPenaltyHandler',
            "echo:arena-{$this->jadwal->id},.ganti-tahap-regu" => 'gantiTahapHandler',
            "echo:arena-{$this->jadwal->id},.ganti-tampil-regu" => 'gantiTampilHandler',
           "echo:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function tambahNilaiHandler($data){
        if($this->jadwal->id == $data["jadwal_regu"]["id"]){
            $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->jadwal->TampilTGR->TGR->id)->get();
            $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->jadwal->TampilTGR->TGR->id)->first();
        }
    }
    public function hapusPenaltyHandler(){
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
    }

    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->tahap = $this->jadwal->tahap;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }else{
                $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }
    }
        public function gantiTahapHandler($data){
        $this->tahap = $data["tahap"];
            $this->tahap = $this->jadwal->tahap;
            $this->tampil = $this->jadwal->TampilTGR->TGR;
            if($data["tahap"] == "tampil"){
                if($data["tampil"] == "merah"){
                    $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }else if($data["tampil"] == "biru"){
                    $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }
            }else if($data["tahap"] == "keputusan"){
                $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
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
        return view('livewire.ketua-regu')->extends('layouts.client.app')->section('content');
    }
}
