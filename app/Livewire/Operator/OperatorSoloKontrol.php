<?php

namespace App\Livewire\Operator;

use App\Events\GantiGelanggang;
use App\Events\Solo\HapusPenalty;
use App\Models\PenaltySolo;
use App\Models\PenilaianSolo;
use Livewire\Component;
use App\Events\solo\GantiTahap;
use App\Events\solo\GantiTampil;
use App\Models\JadwalTGR;
use App\Models\PengundianTGR;
use App\Models\TGR;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;


class OperatorsoloKontrol extends Component
{
    public $jadwal_solo;
    public $jadwal_solos;
    public $next;
    public $gelanggang;
    public $sudut_biru;
    public $sudut_merah;
    public $pengundian_merah;
    public $pengundian_biru;
    public $tampil;
    public $penilaian_solo_juri_merah;
    public $penalty_solo_merah;
    public $penilaian_solo_juri_biru;
    public $penalty_solo_biru;
    public $waktu;
    public $pemenang;
    public $keputusan_pemenang;
    public $active;
    public $mulai = false;
    public $user;
    public function mount($jadwal_solo_id){
        $this->user = Auth::user();
        $this->jadwal_solos = JadwalTGR::orderBy('partai')->where('jenis',"Solo Kreatif")->get();
        if(Auth::user()->roles_id == 1){
            $this->jadwal_solos= JadwalTGR::orderBy('partai')->get();
        }else{
            $this->jadwal_solos= JadwalTGR::orderBy('partai')->where('jenis',"Solo Kreatif")->get();
        }
        $this->jadwal_solo = JadwalTGR::find($jadwal_solo_id);
        if($this->jadwal_solo->jenis != "Solo Kreatif" && Auth::user()->roles_id == 1) {
            switch ($this->jadwal_solo->jenis) {
                case 'solo':
                    return redirect('admin/kontrol-tgr/solo/'.$jadwal_solo_id);
                case "Tunggal":
                    return redirect('admin/kontrol-tgr/tunggal/'.$jadwal_solo_id);
                case "Ganda":
                    return redirect('admin/kontrol-tgr/ganda/'.$jadwal_solo_id);
            }
        }
        foreach ($this->jadwal_solos as $key => $jadwal) {     
            if ($this->jadwal_solo->id == $jadwal->id) {
                if($key+1 == count($this->jadwal_solos)){
                    $this->next = $this->jadwal_solos[$key]->id;
            }else{
                $this->next = $this->jadwal_solos[$key+1]->id;
            }
            }
        }
        $this->gelanggang = $this->jadwal_solo->Gelanggang;
        $this->sudut_biru = $this->jadwal_solo->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal_solo->PengundianTGRMerah->TGR;
        $this->pengundian_merah = $this->jadwal_solo->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal_solo->PengundianTGRBiru;
        if(!$this->jadwal_solo->tampil){
            $this->jadwal_solo->tampil = $this->jadwal_solo->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_solo->TampilTGR->TGR;
        $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = 0;
        if(Auth::user()->roles_id != 1 && Auth::user()->gelanggang != $this->jadwal_solo->Gelanggang->id){
            return redirect('/auth');
        }
        if($this->jadwal_solo->tahap == "persiapan"){
            $this->active = "persiapan";
        }else if(($this->jadwal_solo->tahap == "tampil"|| $this->jadwal_solo->tahap == "pause" || $this->jadwal_solo->tahap == "tampil nilai") && $this->jadwal_solo->tampil == $this->jadwal_solo->sudut_biru){
            $this->active = "sudutbiru";
        }else if(($this->jadwal_solo->tahap == "tampil"|| $this->jadwal_solo->tahap == "pause" || $this->jadwal_solo->tahap == "tampil nilai") && $this->jadwal_solo->tampil == $this->jadwal_solo->sudut_merah){
            $this->active = "sudutmerah";
        }else  if($this->jadwal_solo->tahap == "keputusan"){
            $this->active = "keputusan";
        }
    }

    //operator start
    
    public function nextPartai(){
        $jadwalsolo = JadwalTGR::find($this->next);
        if($jadwalsolo){
            $this->gelanggang->jadwal = $this->next;
            $jadwalsolo->tahap = 'persiapan';
            $jadwalsolo->save();
            $this->gelanggang->save();
            GantiGelanggang::dispatch($jadwalsolo->Gelanggang);
        }
        if(Auth::user()->roles_id != 1){
            return redirect('op/kontrol-tgr/solo/'.$this->next);
        }else{
            return redirect('admin/kontrol-tgr/solo/'.$this->next);
        }
    }
    public function hapus(){
       foreach ($this->penilaian_solo_juri_merah as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->attack_skor = 0;
        $penilaian->firmness_skor = 0;
        $penilaian->soulfulness_skor = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       foreach ($this->penilaian_solo_juri_biru as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->attack_skor = 0;
        $penilaian->firmness_skor = 0;
        $penilaian->soulfulness_skor = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       if($this->penalty_solo_biru){
           $this->penalty_solo_biru->performa_waktu = 0;
           $this->penalty_solo_biru->toleransi_waktu = 0;
           $this->penalty_solo_biru->keluar_arena = 0; 
           $this->penalty_solo_biru->menyentuh_lantai = 0; 
           $this->penalty_solo_biru->pakaian = 0; 
           $this->penalty_solo_biru->tidak_bergerak = 0;
           $this->penalty_solo_biru->senjata_jatuh = 0; 
           $this->penalty_solo_biru->save(); 
       }
       if($this->penalty_solo_merah){
           $this->penalty_solo_merah->performa_waktu = 0;
           $this->penalty_solo_merah->toleransi_waktu = 0;
           $this->penalty_solo_merah->keluar_arena = 0;
           $this->penalty_solo_merah->menyentuh_lantai = 0; 
           $this->penalty_solo_merah->pakaian = 0; 
           $this->penalty_solo_merah->tidak_bergerak = 0; 
           $this->penalty_solo_merah->senjata_jatuh = 0; 
        $this->penalty_solo_merah->save();
       }
       $this->jadwal_solo->pemenang = null;
       $this->jadwal_solo->skor_biru = 0;
       $this->jadwal_solo->skor_merah = 0;
       $this->jadwal_solo->save();
        HapusPenalty::dispatch($this->jadwal_solo,[$this->sudut_merah,$this->sudut_biru],"delete",Auth::user());
     }
     public function kurangiWaktu(){
        if($this->waktu == $this->gelanggang->waktu){
            return;
        }
        $this->waktu = ($this->waktu * 60 + 1) / 60;
    }
    public function gantiTampil($sudut){
        $this->waktu = 0;
        $this->mulai = false;
        if($sudut == "merah"){
            $this->active = "sudutmerah";
            $this->tampil = $this->sudut_merah;
            $this->jadwal_solo->tahap = "tampil";
            $this->jadwal_solo->tampil = $this->pengundian_merah->id;
            $this->jadwal_solo->save();
        }else if($sudut == "biru"){
            $this->active = "sudutbiru";
            $this->tampil = $this->sudut_biru;
            $this->jadwal_solo->tahap = "tampil";
            $this->jadwal_solo->tampil = $this->pengundian_biru->id;
            $this->jadwal_solo->save();
        }
        GantiTampil::dispatch($this->tampil,$this->jadwal_solo);
    }
    public function gantiTahap($tahap,$tampil,$keputusan_pemenang){
        if($tahap == "keputusan"){
            if(count($this->penilaian_solo_juri_merah)%2==0){
                $length = count($this->penilaian_solo_juri_merah)/2;
            }else{
                $length = (count($this->penilaian_solo_juri_merah)+1)/2;
            }

            if($this->penalty_solo_merah){
                $penalty_merah = $this->penalty_solo_merah->toleransi_waktu+$this->penalty_solo_merah->keluar_arena+$this->penalty_solo_merah->menyentuh_lantai+$this->penalty_solo_merah->pakaian+$this->penalty_solo_merah->tidak_bergerak+$this->penalty_solo_merah->senjata_jatuh;
            }else{
                $penalty_merah = 0;
            }
            $total_merah = 0;
            foreach ($this->penilaian_solo_juri_merah as $penilaian_juri) {
                $total_merah += $penilaian_juri->skor;
            }
            // Mengurutkan array berdasarkan skor
            $sorted_nilai_merah = json_decode($this->penilaian_solo_juri_merah);
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

            if(count($this->penilaian_solo_juri_biru)%2==0){
                $length = count($this->penilaian_solo_juri_biru)/2;
            }else{
                $length = (count($this->penilaian_solo_juri_biru)+1)/2;
            }
            if($this->penalty_solo_biru){
                $penalty_biru = $this->penalty_solo_biru->toleransi_waktu+$this->penalty_solo_biru->keluar_arena+$this->penalty_solo_biru->menyentuh_lantai+$this->penalty_solo_biru->pakaian+$this->penalty_solo_biru->tidak_bergerak;
            }else{
                $penalty_biru = 0;
            }
            $total_biru = 0;
            foreach ($this->penilaian_solo_juri_biru as $penilaian_juri) {
                $total_biru += $penilaian_juri->skor;
            }
            // Mengurutkan array berdasarkan skor
            $sorted_nilai_biru = json_decode($this->penilaian_solo_juri_biru);
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
            $this->jadwal_solo->skor_biru = $median_biru - $penalty_biru * 0.5;
            $this->jadwal_solo->skor_merah = $median_merah - $penalty_merah * 0.5;
            $this->active = "keputusan";
            $this->mulai = false;
            if($tampil == "merah"){
                $this->jadwal_solo->pemenang = $this->pengundian_merah->id;
            }else if($tampil == "biru"){
                $this->jadwal_solo->pemenang = $this->pengundian_biru->id;
            }
            $this->jadwal_solo->jenis_kemenangan = $keputusan_pemenang;
            $this->jadwal_solo->save();
            $next_partai = JadwalTGR::where("partai",$this->jadwal_solo->next_partai)->first();
            if($next_partai){
                if($this->jadwal_solo->next_sudut == 1){
                    $next_partai->tampil = $this->jadwal_solo->pemenang;
                    $next_partai->sudut_biru = $this->jadwal_solo->pemenang;
                }else{
                    $next_partai->sudut_merah = $this->jadwal_solo->pemenang;
                }
                $next_partai->save();
            }
        }else if($tahap == "tampil"){
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_solo->tahap = "tampil nilai";
            $this->jadwal_solo->save();
        }else if($tahap == "pause"){
            if($this->tampil->id == $this->sudut_biru->id){
                $this->penalty_solo_biru->performa_waktu = $this->waktu;
                $this->penalty_solo_biru->save();
            }else{
                $this->penalty_solo_merah->performa_waktu = $this->waktu;
                $this->penalty_solo_merah->save();
            }
            $this->mulai = false;
        }else if($tahap == "persiapan"){
            $this->active = "persiapan";
            $this->mulai = false;
            $this->jadwal_solo->tahap = "persiapan";
            $this->gelanggang->save();
            $this->jadwal_solo->save();
        }
        $this->jadwal_solo->tahap = $tahap;
        $this->jadwal_solo->save();
        $this->tampil = $this->jadwal_solo->TampilTGR->TGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_solo,$this->waktu);
    }
    //operator endpublic function render()

    #[On('echo:poin,.tambah-skor-solo')]
    public function tambahNilaiHandler($data){
        if($this->jadwal_solo->id == $data["jadwal_solo"]["id"]){
            $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.salah-gerakan-solo')]
    public function salahGerakanHandler($data){
        if($this->jadwal_solo->id == $data["jadwal_solo"]["id"]){
            $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.penalty-solo')]
    public function tambahPenaltyHandler($data){
        if($this->jadwal_solo->id == $data["jadwal_solo"]["id"]){          
            $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    #[On('echo:poin,.hapus-penalty-solo')]
    public function hapusPenaltyHandler($data){
        if($this->jadwal_solo->id == $data["jadwal_solo"]["id"]){            
            $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    public function render()
    {
        return view('livewire.operator.operator-solo-kontrol')->extends('layouts.operator.app');
    }
}
