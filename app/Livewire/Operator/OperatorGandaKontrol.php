<?php

namespace App\Livewire\Operator;

use App\Events\Ganda\HapusPenalty;
use App\Events\GantiGelanggang;
use Livewire\Component;
use App\Events\Ganda\GantiTahap;
use App\Events\Ganda\GantiTampil;
use App\Models\JadwalTGR;
use App\Models\PenaltyGanda;
use App\Models\PengundianTGR;
use App\Models\PenilaianGanda;
use App\Models\TGR;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;


class OperatorGandaKontrol extends Component
{
    public $jadwal_ganda;
    public $jadwal_gandas;
    public $next;
    public $gelanggang;
    public $sudut_biru;
    public $sudut_merah;
    public $pengundian_merah;
    public $pengundian_biru;
    public $tampil;
    public $penilaian_ganda_juri_merah;
    public $penalty_ganda_merah;
    public $penilaian_ganda_juri_biru;
    public $penalty_ganda_biru;
    public $waktu;
    public $pemenang;
    public $keputusan_pemenang;

    public $active;
    public $mulai = false;
    public $user;
    public function mount($jadwal_ganda_id){
        $this->user = Auth::user();
        $this->jadwal_gandas = JadwalTGR::orderBy('partai')->where('jenis',"Ganda")->get();
        if(Auth::user()->roles_id == 1){
            $this->jadwal_gandas= JadwalTGR::orderBy('partai')->get();
        }else{
            $this->jadwal_gandas= JadwalTGR::orderBy('partai')->where('jenis',"Ganda")->get();
        }
        $this->jadwal_ganda = JadwalTGR::find($jadwal_ganda_id);
        if($this->jadwal_ganda->jenis != "Ganda" && Auth::user()->roles_id == 1) {
            switch ($this->jadwal_ganda->jenis) {
                case 'Regu':
                    return redirect('admin/kontrol-tgr/regu/'.$jadwal_ganda_id);
                case "Tunggal":
                    return redirect('admin/kontrol-tgr/tunggal/'.$jadwal_ganda_id);
                case "Solo Kreatif":
                    return redirect('admin/kontrol-tgr/solo/'.$jadwal_ganda_id);
            }
        }
        foreach ($this->jadwal_gandas as $key => $jadwal) {     
            if ($this->jadwal_ganda->id == $jadwal->id) {
                if($key+1 == count($this->jadwal_gandas)){
                    $this->next = $this->jadwal_gandas[$key]->id;
            }else{
                $this->next = $this->jadwal_gandas[$key+1]->id;
            }
            }
        }
        $this->gelanggang = $this->jadwal_ganda->Gelanggang;
        $this->sudut_biru = $this->jadwal_ganda->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal_ganda->PengundianTGRMerah->TGR;
        $this->pengundian_merah = $this->jadwal_ganda->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal_ganda->PengundianTGRBiru;
        if(!$this->jadwal_ganda->tampil){
            $this->jadwal_ganda->tampil = $this->jadwal_ganda->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_ganda->TampilTGR->TGR;
        $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = 0;
        if(Auth::user()->roles_id != 1 && Auth::user()->gelanggang != $this->jadwal_ganda->Gelanggang->id){
            return redirect('/auth');
        }
        if($this->jadwal_ganda->tahap == "persiapan"){
            $this->active = "persiapan";
        }else if(($this->jadwal_ganda->tahap == "tampil"|| $this->jadwal_ganda->tahap == "pause" || $this->jadwal_ganda->tahap == "tampil nilai") && $this->jadwal_ganda->tampil == $this->jadwal_ganda->sudut_biru){
            $this->active = "sudutbiru";
        }else if(($this->jadwal_ganda->tahap == "tampil"|| $this->jadwal_ganda->tahap == "pause" || $this->jadwal_ganda->tahap == "tampil nilai") && $this->jadwal_ganda->tampil == $this->jadwal_ganda->sudut_merah){
            $this->active = "sudutmerah";
        }else  if($this->jadwal_ganda->tahap == "keputusan"){
            $this->active = "keputusan";
        }
    }

    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal_ganda->id},.hapus-penalty-ganda" => 'hapusPenaltyHandler',
            "echo:poin-{$this->jadwal_ganda->id},.tambah-skor-ganda" => 'tambahNilaiHandler',
            "echo:poin-{$this->jadwal_ganda->id},.salah-gerakan-ganda" => 'salahGerakanHandler',
            "echo:poin-{$this->jadwal_ganda->id},.penalty-ganda" => 'tambahPenaltyHandler',
        ];
    }

    //operator start
    public function hapus(){
       foreach ($this->penilaian_ganda_juri_merah as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->attack_skor = 0;
        $penilaian->firmness_skor = 0;
        $penilaian->soulfulness_skor = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       foreach ($this->penilaian_ganda_juri_biru as $penilaian) {
        $penilaian->skor = 0;
        $penilaian->attack_skor = 0;
        $penilaian->firmness_skor = 0;
        $penilaian->soulfulness_skor = 0;
        $penilaian->penalty = 0;
        $penilaian->save();
       }
       if($this->penalty_ganda_biru){
           $this->penalty_ganda_biru->performa_waktu = 0;
           $this->penalty_ganda_biru->toleransi_waktu = 0;
           $this->penalty_ganda_biru->keluar_arena = 0; 
           $this->penalty_ganda_biru->menyentuh_lantai = 0; 
           $this->penalty_ganda_biru->pakaian = 0; 
           $this->penalty_ganda_biru->tidak_bergerak = 0;
           $this->penalty_ganda_biru->senjata_jatuh = 0; 
           $this->penalty_ganda_biru->save(); 
       }
       if($this->penalty_ganda_merah){
           $this->penalty_ganda_merah->performa_waktu = 0;
           $this->penalty_ganda_merah->toleransi_waktu = 0;
           $this->penalty_ganda_merah->keluar_arena = 0;
           $this->penalty_ganda_merah->menyentuh_lantai = 0; 
           $this->penalty_ganda_merah->pakaian = 0; 
           $this->penalty_ganda_merah->tidak_bergerak = 0; 
           $this->penalty_ganda_merah->senjata_jatuh = 0; 
        $this->penalty_ganda_merah->save();
       }
       $this->jadwal_ganda->pemenang = null;
       $this->jadwal_ganda->skor_biru = 0;
       $this->jadwal_ganda->skor_merah = 0;
       $this->jadwal_ganda->save();
        HapusPenalty::dispatch($this->jadwal_ganda,[$this->sudut_merah,$this->sudut_biru],"delete",Auth::user());
     }
    public function nextPartai(){
        $jadwalganda = JadwalTGR::find($this->next);
        if($jadwalganda){
            $this->gelanggang->jadwal = $this->next;
            $jadwalganda->tahap = 'persiapan';
            $jadwalganda->save();
            $this->gelanggang->save();
            GantiGelanggang::dispatch($jadwalganda->Gelanggang);
        }
        if(Auth::user()->roles_id != 1){
            return redirect('op/kontrol-tgr/ganda/'.$this->next);
        }else{
            return redirect('admin/kontrol-tgr/ganda/'.$this->next);
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
            $this->jadwal_ganda->tahap = "tampil";
            $this->jadwal_ganda->tampil = $this->pengundian_merah->id;
            $this->jadwal_ganda->save();
        }else if($sudut == "biru"){
            $this->active = "sudutbiru";
            $this->tampil = $this->sudut_biru;
            $this->jadwal_ganda->tahap = "tampil";
            $this->jadwal_ganda->tampil = $this->pengundian_biru->id;
            $this->jadwal_ganda->save();
        }
        GantiTampil::dispatch($this->tampil,$this->jadwal_ganda);
    }
    public function gantiTahap($tahap,$tampil,$keputusan_pemenang){
        if($tahap == "keputusan"){
            if(count($this->penilaian_ganda_juri_merah)%2==0){
                $length = count($this->penilaian_ganda_juri_merah)/2;
            }else{
                $length = (count($this->penilaian_ganda_juri_merah)+1)/2;
            }

            if($this->penalty_ganda_merah){
                $penalty_merah = $this->penalty_ganda_merah->toleransi_waktu+$this->penalty_ganda_merah->keluar_arena+$this->penalty_ganda_merah->menyentuh_lantai+$this->penalty_ganda_merah->pakaian+$this->penalty_ganda_merah->tidak_bergerak+$this->penalty_ganda_merah->senjata_jatuh;
            }else{
                $penalty_merah = 0;
            }
            $total_merah = 0;
            foreach ($this->penilaian_ganda_juri_merah as $penilaian_juri) {
                $total_merah += $penilaian_juri->skor;
            }
            // Mengurutkan array berdasarkan skor
            $sorted_nilai_merah = json_decode($this->penilaian_ganda_juri_merah);
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

            if(count($this->penilaian_ganda_juri_biru)%2==0){
                $length = count($this->penilaian_ganda_juri_biru)/2;
            }else{
                $length = (count($this->penilaian_ganda_juri_biru)+1)/2;
            }
            if($this->penalty_ganda_biru){
                $penalty_biru = $this->penalty_ganda_biru->toleransi_waktu+$this->penalty_ganda_biru->keluar_arena+$this->penalty_ganda_biru->menyentuh_lantai+$this->penalty_ganda_biru->pakaian+$this->penalty_ganda_biru->tidak_bergerak;
            }else{
                $penalty_biru = 0;
            }
            $total_biru = 0;
            foreach ($this->penilaian_ganda_juri_biru as $penilaian_juri) {
                $total_biru += $penilaian_juri->skor;
            }
            // Mengurutkan array berdasarkan skor
            $sorted_nilai_biru = json_decode($this->penilaian_ganda_juri_biru);
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
            $this->jadwal_ganda->skor_biru = $median_biru - $penalty_biru * 0.5;
            $this->jadwal_ganda->skor_merah = $median_merah - $penalty_merah * 0.5;
            $this->jadwal_ganda->save();
            $this->active = "keputusan";
            $this->mulai = false;
            if($tampil == "merah"){
                $this->jadwal_ganda->pemenang = $this->pengundian_merah->id;
            }else if($tampil == "biru"){
                $this->jadwal_ganda->pemenang = $this->pengundian_biru->id;
            }
            $this->jadwal_ganda->jenis_kemenangan = $keputusan_pemenang;
            $this->jadwal_ganda->save();
            $next_partai = JadwalTGR::where("partai",$this->jadwal_ganda->next_partai)->first();
            if($next_partai){
                if($this->jadwal_ganda->next_sudut == 1){
                    $next_partai->tampil = $this->jadwal_ganda->pemenang;
                    $next_partai->sudut_biru = $this->jadwal_ganda->pemenang;
                }else{
                    $next_partai->sudut_merah = $this->jadwal_ganda->pemenang;
                }
                $next_partai->save();
            }
        }else if($tahap == "tampil"){
            $this->waktu = 0;
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_ganda->tahap = "tampil nilai";
            $this->jadwal_ganda->save();
        }else if($tahap == "pause"){
            if($this->tampil->id == $this->sudut_biru->id){
                $this->penalty_ganda_biru->performa_waktu = $this->waktu;
                $this->penalty_ganda_biru->save();
            }else{
                $this->penalty_ganda_merah->performa_waktu = $this->waktu;
                $this->penalty_ganda_merah->save();
            }
            $this->mulai = false;
        }else if($tahap == "persiapan"){
            $this->active = "persiapan";
            $this->mulai = false;
            $this->waktu = 0;
            $this->jadwal_ganda->tahap = "persiapan";
            $this->gelanggang->save();
            $this->jadwal_ganda->save();
        }
        $this->jadwal_ganda->tahap = $tahap;
        $this->jadwal_ganda->save();
        $this->tampil = $this->jadwal_ganda->TampilTGR->TGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_ganda,$this->waktu);
    }
    //operator end

    public function tambahNilaiHandler($data){
        if($this->jadwal_ganda->id == $data["jadwal_ganda"]["id"]){
            $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    public function salahGerakanHandler($data){
        if($this->jadwal_ganda->id == $data["jadwal_ganda"]["id"]){
            $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    public function tambahPenaltyHandler($data){
        if($this->jadwal_ganda->id == $data["jadwal_ganda"]["id"]){          
            $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    public function hapusPenaltyHandler($data){
        if($this->jadwal_ganda->id == $data["jadwal_ganda"]["id"]){            
            $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    public function render()
    {
        return view('livewire.operator.operator-ganda-kontrol')->extends('layouts.operator.app');
    }
}
