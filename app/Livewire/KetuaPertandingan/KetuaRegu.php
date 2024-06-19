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
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
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

    #[On('echo:poin,.tambah-skor-regu')]
    public function tambahNilaiHandler($data){
        if($this->jadwal->id == $data["jadwal_regu"]["id"]){
            $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->jadwal->TampilTGR->TGR->id)->get();
            $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->jadwal->TampilTGR->TGR->id)->first();
        }
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

    #[On('echo:arena,.ganti-tampil-regu')]
    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }else{
                $this->penilaian_regu_juri = PenilaianRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_regu = PenaltyRegu::where('jadwal_regu',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }
    }
    
    #[On('echo:arena,.ganti-tahap-regu')]
    public function gantiTahapHandler($data){
        $this->tahap = $data["tahap"];
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
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
        return view('livewire.ketua-regu')->extends('layouts.client.app')->section('content');
    }
}
