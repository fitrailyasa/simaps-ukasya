<?php

namespace App\Livewire\KetuaPertandingan;
use App\Models\PengundianTGR;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\PenilaianTunggal;
use App\Models\PenaltyTunggal;
use App\Models\User;

class KetuaTunggal extends Component
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
    public $jenis = "tunggal";
    

    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        if($this->gelanggang->jenis != "Tunggal"){
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
        $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
        $this->waktu = 0;
    }

    #[On('echo:poin,.tambah-skor-tunggal')]
    public function tambahNilaiHandler($data){
        if($this->jadwal->id == $data["jadwal_tunggal"]["id"]){
            $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->jadwal->TampilTGR->TGR->id)->get();
            $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->jadwal->TampilTGR->TGR->id)->first();
        }
    }
    #[On('echo:poin,.salah-gerakan-tunggal')]
    public function salahGerakanHandler(){
    }
    #[On('echo:poin,.penalty-tunggal')]
    public function tambahPenaltyHandler(){
    }
    #[On('echo:poin,.hapus-penalty-tunggal')]
    public function hapusPenaltyHandler(){
        $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
        $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
    }

    #[On('echo:arena,.ganti-tampil-tunggal')]
    public function gantiTampilHandler($data){
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->tahap = $this->jadwal->tahap;
        if($data["tampil"]['id'] == $this->sudut_merah->id){
                $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }else{
                $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
            }
    }
    
    #[On('echo:arena,.ganti-tahap-tunggal')]
    public function gantiTahapHandler($data){
        $this->tahap = $data["tahap"];
            $this->tahap = $this->jadwal->tahap;
            $this->tampil = $this->jadwal->TampilTGR->TGR;
            if($data["tahap"] == "tampil"){
                if($data["tampil"] == "merah"){
                    $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }else if($data["tampil"] == "biru"){
                    $this->penilaian_tunggal_juri = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->get();
                    $this->penalty_tunggal = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->tampil->id)->first();
                }
            }else if($data["tahap"] == "keputusan"){
                $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->get();
                $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_merah->id)->first();
                $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->get();
                $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal->id)->where('sudut',$this->sudut_biru->id)->first();
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
        return view('livewire.ketua-tunggal')->extends('layouts.client.app')->section('content');
    }
}
