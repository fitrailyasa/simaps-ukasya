<?php

namespace App\Livewire\Operator;

use App\Events\GantiGelanggang;
use App\Events\Tunggal\GantiTahap;
use App\Events\Tunggal\GantiTampil;
use App\Events\Tunggal\HapusPenalty;
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
    public $jadwal_tunggals;
    public $next;
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
    public $user;

    public function mount($jadwal_tunggal_id){
        $this->user = Auth::user();
        if(Auth::user()->roles_id == 1){
            $this->jadwal_tunggals= JadwalTGR::orderBy('partai')->get();
        }else{
            $this->jadwal_tunggals= JadwalTGR::orderBy('partai')->where('jenis',"Tunggal")->get();
        }
        $this->jadwal_tunggal = JadwalTGR::find($jadwal_tunggal_id);
        if($this->jadwal_tunggal->jenis != "Tunggal" && Auth::user()->roles_id == 1) {
            switch ($this->jadwal_tunggal->jenis) {
                case 'Regu':
                    return redirect('admin/kontrol-tgr/regu/'.$jadwal_tunggal_id);
                case "Ganda":
                    return redirect('admin/kontrol-tgr/ganda/'.$jadwal_tunggal_id);
                case "Solo Kreatif":
                    return redirect('admin/kontrol-tgr/ganda/'.$jadwal_tunggal_id);
            }
        }
        foreach ($this->jadwal_tunggals as $key => $jadwal) {     
            if ($this->jadwal_tunggal->id == $jadwal->id) {
                if($key+1 == count($this->jadwal_tunggals)){
                    $this->next = $this->jadwal_tunggals[$key]->id;
            }else{
                $this->next = $this->jadwal_tunggals[$key+1]->id;
            }
            }
        }
        $this->gelanggang = $this->jadwal_tunggal->Gelanggang;
        $this->sudut_biru = $this->jadwal_tunggal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal_tunggal->PengundianTGRMerah->TGR;
        $this->pengundian_merah = $this->jadwal_tunggal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal_tunggal->PengundianTGRBiru;
        if(!$this->jadwal_tunggal->tampil){
            $this->jadwal_tunggal->tampil = $this->jadwal_tunggal->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_tunggal->TampilTGR->TGR;
        $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = 0;
        if(Auth::user()->roles_id != 1 && Auth::user()->gelanggang != $this->jadwal_tunggal->Gelanggang->id){
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

    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal_tunggal->id},.hapus-penalty-tunggal" => 'hapusPenaltyHandler',
            "echo:poin-{$this->jadwal_tunggal->id},.tambah-skor-tunggal" => 'tambahNilaiHandler',
            "echo:poin-{$this->jadwal_tunggal->id},.salah-gerakan-tunggal" => 'salahGerakanHandler',
            "echo:poin-{$this->jadwal_tunggal->id},.penalty-tunggal" => 'tambahPenaltyHandler',
        ];
    }
     //operator start
     public function hapus(){
         
       foreach ($this->penilaian_tunggal_juri_merah as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->flow_skor = 0;
        $penilaian->salah = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       foreach ($this->penilaian_tunggal_juri_biru as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->flow_skor = 0;;
        $penilaian->salah = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       if($this->penalty_tunggal_biru){
           $this->penalty_tunggal_biru->performa_waktu = 0;
           $this->penalty_tunggal_biru->toleransi_waktu = 0;
           $this->penalty_tunggal_biru->keluar_arena = 0; 
           $this->penalty_tunggal_biru->menyentuh_lantai = 0; 
           $this->penalty_tunggal_biru->pakaian = 0; 
           $this->penalty_tunggal_biru->tidak_bergerak = 0;
           $this->penalty_tunggal_biru->save(); 
       }
       if($this->penalty_tunggal_merah){
           $this->penalty_tunggal_merah->performa_waktu = 0;
           $this->penalty_tunggal_merah->toleransi_waktu = 0;
           $this->penalty_tunggal_merah->keluar_arena = 0;
           $this->penalty_tunggal_merah->menyentuh_lantai = 0; 
           $this->penalty_tunggal_merah->pakaian = 0; 
           $this->penalty_tunggal_merah->tidak_bergerak = 0; 
            $this->penalty_tunggal_merah->save();
       }
       $this->jadwal_tunggal->pemenang = null;
       $this->jadwal_tunggal->skor_biru = 0;
       $this->jadwal_tunggal->skor_merah = 0;
       $this->jadwal_tunggal->save();
        HapusPenalty::dispatch($this->jadwal_tunggal,[$this->sudut_merah,$this->sudut_biru],"delete",Auth::user());
     }
     public function nextPartai(){
        $jadwaltunggal = JadwalTGR::find($this->next);
        if($jadwaltunggal){
            $this->gelanggang->jadwal = $this->next;
            $jadwaltunggal->tahap = 'persiapan';
            $jadwaltunggal->save();
            $this->gelanggang->save();
            GantiGelanggang::dispatch($jadwaltunggal->Gelanggang);
        }
        if(Auth::user()->roles_id != 1){
            return redirect('op/kontrol-tgr/tunggal/'.$this->next);
        }else{
            return redirect('admin/kontrol-tgr/tunggal/'.$this->next);
        }
    }
     public function kurangiWaktu(){
        if($this->waktu == $this->gelanggang->waktu){
            return;
        }
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }
    public function gantiTampil($sudut){
        $this->waktu = 0;
        $this->mulai = false;
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
            if(count($this->penilaian_tunggal_juri_biru)%2==0){
                $length = count($this->penilaian_tunggal_juri_biru)/2;
            }else{
                $length = (count($this->penilaian_tunggal_juri_biru)+1)/2;
            }
            if($this->penalty_tunggal_biru){
                $penalty_biru = $this->penalty_tunggal_biru->toleransi_waktu+$this->penalty_tunggal_biru->keluar_arena+$this->penalty_tunggal_biru->menyentuh_lantai+$this->penalty_tunggal_biru->pakaian+$this->penalty_tunggal_biru->tidak_bergerak;
            }else{
                $penalty_biru = 0;
            }
            $total_biru = 0;
            foreach ($this->penilaian_tunggal_juri_biru as $penilaian_juri) {
                $total_biru += $penilaian_juri->skor;
            }
            // Mengurutkan array berdasarkan skor
            $sorted_nilai_biru = json_decode($this->penilaian_tunggal_juri_biru);
            usort($sorted_nilai_biru, function($a, $b) {
                return $a->skor <=> $b->skor;
            });

            // Menghitung median
            $count_biru = count($sorted_nilai_biru);
            if ($count_biru % 2 == 0 && $count_biru !==0) {
                // Jika jumlah data genap, median adalah rata-rata dari dua nilai tengah
                $median_biru = ($sorted_nilai_biru[$count_biru / 2 - 1]->skor + $sorted_nilai_biru[$count_biru / 2]->skor) / 2;
            } else if($count_biru % 2 == 1 && $count_biru !==0) {
                // Jika jumlah data ganjil, median adalah nilai tengah
                $median_biru = $sorted_nilai_biru[floor($count_biru / 2)]->skor;
            }else{
                $median_biru = 0;
            }
            if(count($this->penilaian_tunggal_juri_merah)%2==0){
                $length = count($this->penilaian_tunggal_juri_merah)/2;
            }else{
                $length = (count($this->penilaian_tunggal_juri_merah)+1)/2;
            }

            if($this->penalty_tunggal_merah){
                $penalty_merah = $this->penalty_tunggal_merah->toleransi_waktu+$this->penalty_tunggal_merah->keluar_arena+$this->penalty_tunggal_merah->menyentuh_lantai+$this->penalty_tunggal_merah->pakaian+$this->penalty_tunggal_merah->tidak_bergerak;
            }else{
                $penalty_merah = 0;
            }
            $total_merah = 0;
            foreach ($this->penilaian_tunggal_juri_merah as $penilaian_juri) {
                $total_merah += $penilaian_juri->skor;
            }
            // Mengurutkan array berdasarkan skor
            $sorted_nilai_merah = json_decode($this->penilaian_tunggal_juri_merah);
            usort($sorted_nilai_merah, function($a, $b) {
                return $a->skor <=> $b->skor;
            });

            // Menghitung median
            $count_merah = count($sorted_nilai_merah);
            if ($count_merah % 2 == 0 && $count_merah !==0) {
                // Jika jumlah data genap, median adalah rata-rata dari dua nilai tengah
                $median_merah = ($sorted_nilai_merah[$count_merah / 2 - 1]->skor + $sorted_nilai_merah[$count_merah / 2]->skor) / 2;
            } else if($count_merah % 2 == 1 && $count_merah !==0) {
                // Jika jumlah data ganjil, median adalah nilai tengah
                $median_merah = $sorted_nilai_merah[floor($count_merah / 2)]->skor;
            }else{
                $median_merah = 0;
            }
            $this->jadwal_tunggal->skor_biru = $median_biru - $penalty_biru * 0.5;
            $this->jadwal_tunggal->skor_merah = $median_merah - $penalty_merah * 0.5;
            $this->jadwal_tunggal->save();
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
            if($next_partai){
                if($this->jadwal_tunggal->next_sudut == 1){
                    $next_partai->tampil = $this->jadwal_tunggal->pemenang;
                    $next_partai->sudut_biru = $this->jadwal_tunggal->pemenang;
                }else{
                    $next_partai->sudut_merah = $this->jadwal_tunggal->pemenang;
                }
                $next_partai->save();
            }

        }else if($tahap == "tampil"){
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_tunggal->tahap = "tampil nilai";
            $this->jadwal_tunggal->save();
        }else if($tahap == "pause"){
            if($this->tampil->id == $this->sudut_biru->id){
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
        $this->tampil = $this->jadwal_tunggal->TampilTGR->TGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_tunggal,$this->waktu);
    }
    //operator endpublic function render()

    public function tambahNilaiHandler($data){
        if($this->jadwal_tunggal->id == $data["jadwal_tunggal"]["id"]){
            
            $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    public function salahGerakanHandler($data){
        if($this->jadwal_tunggal->id == $data["jadwal_tunggal"]["id"]){
            
            $this->penilaian_tunggal_juri_merah = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_tunggal_juri_biru = PenilaianTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    public function tambahPenaltyHandler($data){
        if($this->jadwal_tunggal->id == $data["jadwal_tunggal"]["id"]){
            
            $this->penalty_tunggal_merah = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_tunggal_biru = PenaltyTunggal::where('jadwal_tunggal',$this->jadwal_tunggal->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
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
