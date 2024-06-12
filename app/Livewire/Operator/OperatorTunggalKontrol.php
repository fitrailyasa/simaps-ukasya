<?php

namespace App\Livewire\Operator;

use App\Events\Tunggal\GantiTahap;
use App\Events\Tunggal\GantiTampil;
use App\Models\JadwalTGR;
use App\Models\PenaltyTunggal;
use App\Models\PengundianTGR;
use App\Models\PenilaianTunggal;
use App\Models\TGR;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class OperatorTunggalKontrol extends Component
{

    public $jadwal_tunggal;
    public $gelanggang;
    public $sudut_biru;
    public $sudut_merah;
    public $pengundian_merah;
    public $pengundian_biru;
    public $tampil;
    public $penilaian_tunggal_juri_merah;
    public $penalty_tunggal_merah;
    public $penilaian_tunggal_juri_biru;
    public $penalty_tunggal_biru;
    public $waktu;
    public $pemenang;
    public $keputusan_pemenang;
    public $active;
    public $mulai = false;

    public function mount($jadwal_tunggal_id){
        $this->jadwal_tunggal = JadwalTGR::find($jadwal_tunggal_id);
        $this->gelanggang = $this->jadwal_tunggal->Gelanggang;
        $this->sudut_biru = TGR::where('id',$this->jadwal_tunggal->PengundianTGRBiru->atlet_id)->first();
        $this->sudut_merah = TGR::where('id',$this->jadwal_tunggal->PengundianTGRMerah->atlet_id)->first();
        $this->pengundian_merah = PengundianTGR::find($this->jadwal_tunggal->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal_tunggal->sudut_biru);
        if(!$this->jadwal_tunggal->tampil){
            $this->jadwal_tunggal->tampil = $this->jadwal_tunggal->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_tunggal->TampilTGR->TGR;
        $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = 0;
        if(Auth::user()->gelanggang !== $this->jadwal_tunggal->Gelanggang->id){
            return redirect('/auth');
        }
        if($this->jadwal_tunggal->tahap == "persiapan"){
            $this->active = "persiapan";
        }else if(($this->jadwal_tunggal->tahap == "tampil"|| $this->jadwal_tunggal->tahap == "pause" || $this->jadwal_tunggal->tahap == "tampil nilai") && $this->jadwal_tunggal->tampil == $this->jadwal_tunggal->sudut_biru){
            $this->active = "sudutbiru";
        }else if(($this->jadwal_tunggal->tahap == "tampil"|| $this->jadwal_tunggal->tahap == "pause" || $this->jadwal_tunggal->tahap == "tampil nilai") && $this->jadwal_tunggal->tampil == $this->jadwal_tunggal->sudut_merah){
            $this->active = "sudutmerah";
        }else  if($this->jadwal_tunggal->tahap == "keputusan"){
            $this->active = "keputusan";
        }
    }
     //operator start
     public function kurangiWaktu(){
        if($this->waktu == $this->gelanggang->waktu){
            return;
        }
        $this->waktu = ($this->waktu * 60 + 1) / 60;
    }
    public function gantiTampil($sudut){
        $this->waktu = 0;
        if($sudut == "merah"){
            $this->active = "sudutmerah";
            $this->tampil = $this->sudut_merah;
            $this->jadwal_tunggal->tahap = "tampil";
            $this->jadwal_tunggal->tampil = $this->pengundian_merah->id;
            $this->jadwal_tunggal->save();
        }else if($sudut == "biru"){
            $this->active = "sudutbiru";
            $this->tampil = $this->sudut_biru;
            $this->jadwal_tunggal->tahap = "tampil";
            $this->jadwal_tunggal->tampil = $this->pengundian_biru->id;
            $this->jadwal_tunggal->save();
        }
        GantiTampil::dispatch($this->tampil,$this->jadwal_tunggal);
    }
    public function gantiTahap($tahap,$tampil,$keputusan_pemenang){
        if($tahap == "keputusan"){
            $this->active = "keputusan";
            $this->mulai = false;
            if($tampil == "merah"){
                $this->jadwal_tunggal->pemenang = $this->pengundian_merah->id;
            }else if($tampil == "biru"){
                $this->jadwal_tunggal->pemenang = $this->pengundian_biru->id;
            }
            $this->jadwal_tunggal->jenis_kemenangan = $keputusan_pemenang;
            $this->jadwal_tunggal->save();
            $next_partai = JadwalTGR::where("partai",$this->jadwal_tunggal->next_partai)->first();
            if($this->jadwal_tunggal->next_sudut == 1){
                $next_partai->sudut_biru = $this->jadwal_tunggal->pemenang;
            }else{
                $next_partai->sudut_merah = $this->jadwal_tunggal->pemenang;
            }
        $next_partai->save();
        }else if($tahap == "tampil"){
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_tunggal->tahap = "tampil nilai";
            $this->jadwal_tunggal->save();
        }else if($tahap == "pause"){
            if($this->tampil->id == $this->jadwal_tunggal->PengundianTGRBiru->id){
                $this->penalty_tunggal_biru->performa_waktu = $this->waktu;
                $this->penalty_tunggal_biru->save();
            }else{
                $this->penalty_tunggal_merah->performa_waktu = $this->waktu;
                $this->penalty_tunggal_merah->save();
            }
            $this->mulai = false;
        }else if($tahap == "persiapan"){
            $this->active = "persiapan";
            $this->mulai = false;
            $this->jadwal_tunggal->tahap = "persiapan";
            $this->jadwal_tunggal->save();
        }
        $this->jadwal_tunggal->tahap = $tahap;
        $this->jadwal_tunggal->save();
        $this->tampil = $this->jadwal_tunggal->TampilTGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_tunggal,$this->waktu);
    }
    //operator endpublic function render()

    #[On('echo:poin,.tambah-skor-tunggal')]
    public function tambahNilaiHandler($data){
        if($this->jadwal_tunggal->id == $data["jadwal_tunggal"]["id"]){
            
            $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.salah-gerakan-tunggal')]
    public function salahGerakanHandler($data){
        if($this->jadwal_tunggal->id == $data["jadwal_tunggal"]["id"]){
            
            $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.penalty-tunggal')]
    public function tambahPenaltyHandler($data){
        if($this->jadwal_tunggal->id == $data["jadwal_tunggal"]["id"]){
            
            $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    #[On('echo:poin,.hapus-penalty-tunggal')]
    public function hapusPenaltyHandler($data){
        if($this->jadwal_tunggal->id == $data["jadwal_tunggal"]["id"]){

            $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    public function render()
    {
        return view('livewire.operator.operator-tunggal-kontrol')->extends('layouts.operator.app');
    }
}
