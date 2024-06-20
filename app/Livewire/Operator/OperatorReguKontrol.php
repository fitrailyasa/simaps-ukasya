<?php

namespace App\Livewire\Operator;

use App\Events\GantiGelanggang;
use App\Events\Regu\GantiTahap;
use App\Events\Regu\GantiTampil;
use App\Events\Regu\HapusPenalty;
use App\Models\JadwalTGR;
use App\Models\PenaltyRegu;
use App\Models\PengundianTGR;
use App\Models\PenilaianRegu;
use App\Models\TGR;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class OperatorReguKontrol extends Component
{

    public $jadwal_regu;
    public $jadwal_regus;
    public $next;
    public $gelanggang;
    public $sudut_biru;
    public $sudut_merah;
    public $pengundian_merah;
    public $pengundian_biru;
    public $tampil;
    public $penilaian_regu_juri_merah;
    public $penalty_regu_merah;
    public $penilaian_regu_juri_biru;
    public $penalty_regu_biru;
    public $waktu;
    public $pemenang;
    public $keputusan_pemenang;

    public $active;
    public $mulai = false;

    public function mount($jadwal_regu_id){
        $this->jadwal_regus= JadwalTGR::orderBy('partai')->where('jenis',"Regu")->get();
        $this->jadwal_regu = JadwalTGR::find($jadwal_regu_id);
        foreach ($this->jadwal_regus as $key => $jadwal) {     
            if ($this->jadwal_regu->id == $jadwal->id) {
                if($key+1 == count($this->jadwal_regus)){
                    $this->next = $this->jadwal_regus[$key]->id;
            }else{
                $this->next = $this->jadwal_regus[$key+1]->id;
            }
            }
        }
        $this->gelanggang = $this->jadwal_regu->Gelanggang;
        $this->sudut_biru = $this->jadwal_regu->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal_regu->PengundianTGRMerah->TGR;
        $this->pengundian_merah = $this->jadwal_regu->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal_regu->PengundianTGRBiru;
        if(!$this->jadwal_regu->tampil){
            $this->jadwal_regu->tampil = $this->jadwal_regu->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_regu->TampilTGR->TGR;
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = 0;
        if(Auth::user()->gelanggang !== $this->jadwal_regu->Gelanggang->id){
            return redirect('/auth');
        }
        if($this->jadwal_regu->tahap == "persiapan"){
            $this->active = "persiapan";
        }else if(($this->jadwal_regu->tahap == "tampil"|| $this->jadwal_regu->tahap == "pause" || $this->jadwal_regu->tahap == "tampil nilai") && $this->jadwal_regu->tampil == $this->jadwal_regu->sudut_biru){
            $this->active = "sudutbiru";
        }else if(($this->jadwal_regu->tahap == "tampil"|| $this->jadwal_regu->tahap == "pause" || $this->jadwal_regu->tahap == "tampil nilai") && $this->jadwal_regu->tampil == $this->jadwal_regu->sudut_merah){
            $this->active = "sudutmerah";
        }else  if($this->jadwal_regu->tahap == "keputusan"){
            $this->active = "keputusan";
        }
    }
     //operator start

     public function hapus(){
       foreach ($this->penilaian_regu_juri_merah as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->flow_skor = 0;
        $penilaian->salah = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       foreach ($this->penilaian_regu_juri_biru as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->flow_skor = 0;;
        $penilaian->salah = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       if($this->penalty_regu_biru){
           $this->penalty_regu_biru->performa_waktu = 0;
           $this->penalty_regu_biru->toleransi_waktu = 0;
           $this->penalty_regu_biru->keluar_arena = 0; 
           $this->penalty_regu_biru->menyentuh_lantai = 0; 
           $this->penalty_regu_biru->pakaian = 0; 
           $this->penalty_regu_biru->tidak_bergerak = 0;
           $this->penalty_regu_biru->save(); 
       }
       if($this->penalty_regu_merah){
           $this->penalty_regu_merah->performa_waktu = 0;
           $this->penalty_regu_merah->toleransi_waktu = 0;
           $this->penalty_regu_merah->keluar_arena = 0;
           $this->penalty_regu_merah->menyentuh_lantai = 0; 
           $this->penalty_regu_merah->pakaian = 0; 
           $this->penalty_regu_merah->tidak_bergerak = 0; 
            $this->penalty_regu_merah->save();
       }
        HapusPenalty::dispatch($this->jadwal_regu,[$this->sudut_merah,$this->sudut_biru],"delete",Auth::user());
     }
     public function nextPartai(){
        $jadwalsolo = JadwalTGR::find($this->next);
        if($jadwalsolo){
            $this->gelanggang->jadwal = $this->next;
            $jadwalsolo->tahap = 'persiapan';
            $jadwalsolo->save();
            $this->gelanggang->save();
            GantiGelanggang::dispatch($jadwalsolo->Gelanggang);
        }
        return redirect('op/kontrol-tgr/regu/'.$this->next);
    }
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
            $this->jadwal_regu->tahap = "tampil";
            $this->jadwal_regu->tampil = $this->pengundian_merah->id;
            $this->jadwal_regu->save();
        }else if($sudut == "biru"){
            $this->active = "sudutbiru";
            $this->tampil = $this->sudut_biru;
            $this->jadwal_regu->tahap = "tampil";
            $this->jadwal_regu->tampil = $this->pengundian_biru->id;
            $this->jadwal_regu->save();
        }
        GantiTampil::dispatch($this->tampil,$this->jadwal_regu);
    }
    public function gantiTahap($tahap,$tampil,$keputusan_pemenang){
        if($tahap == "keputusan"){
            $this->active = "keputusan";
            $this->mulai = false;
            if($tampil == "merah"){
                $this->jadwal_regu->pemenang = $this->pengundian_merah->id;
            }else if($tampil == "biru"){
                $this->jadwal_regu->pemenang = $this->pengundian_biru->id;
            }
            $this->jadwal_regu->jenis_kemenangan = $keputusan_pemenang;
            $this->jadwal_regu->save();
            $next_partai = JadwalTGR::where("partai",$this->jadwal_regu->next_partai)->first();
            if($this->jadwal_regu->next_sudut == 1){
                $next_partai->tampil = $this->jadwal_regu->pemenang;
                $next_partai->sudut_biru = $this->jadwal_regu->pemenang;
            }else{
                $next_partai->sudut_merah = $this->jadwal_regu->pemenang;
            }
            $next_partai->save();
        }else if($tahap == "tampil"){
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_regu->tahap = "tampil nilai";
            $this->jadwal_regu->save();
        }else if($tahap == "pause"){
            if($this->tampil->id == $this->sudut_biru->id){
                $this->penalty_regu_biru->performa_waktu = $this->waktu;
                $this->penalty_regu_biru->save();
            }else{
                $this->penalty_regu_merah->performa_waktu = $this->waktu;
                $this->penalty_regu_merah->save();
            }
            $this->mulai = false;
        }else if($tahap == "persiapan"){
            $this->active = "persiapan";
            $this->mulai = false;
            $this->jadwal_regu->tahap = "persiapan";
            $this->gelanggang->save();
            $this->jadwal_regu->save();
        }
        $this->jadwal_regu->tahap = $tahap;
        $this->jadwal_regu->save();
        $this->tampil = $this->jadwal_regu->TampilTGR->TGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_regu,$this->waktu);
    }
    //operator endpublic function render()

    #[On('echo:poin,.tambah-skor-regu')]
    public function tambahNilaiHandler($data){
        if($this->jadwal_regu->id == $data["jadwal_regu"]["id"]){
            $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.salah-gerakan-regu')]
    public function salahGerakanHandler($data){
        if($this->jadwal_regu->id == $data["jadwal_regu"]["id"]){
            $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.penalty-regu')]
    public function tambahPenaltyHandler($data){
        if($this->jadwal_regu->id == $data["jadwal_regu"]["id"]){          
            $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    #[On('echo:poin,.hapus-penalty-regu')]
    public function hapusPenaltyHandler($data){
        if($this->jadwal_regu->id == $data["jadwal_regu"]["id"]){            
            $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    public function render()
    {
        return view('livewire.operator.operator-regu-kontrol')->extends('layouts.operator.app');
    }
}
