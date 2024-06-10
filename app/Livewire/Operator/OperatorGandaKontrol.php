<?php

namespace App\Livewire\Operator;

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
    public function mount($jadwal_ganda_id){
        $this->jadwal_ganda = JadwalTGR::find($jadwal_ganda_id);
        $this->gelanggang = $this->jadwal_ganda->Gelanggang;
        $this->sudut_biru = TGR::where('id',$this->jadwal_ganda->PengundianTGRBiru->atlet_id)->first();
        $this->sudut_merah = TGR::where('id',$this->jadwal_ganda->PengundianTGRMerah->atlet_id)->first();
        $this->pengundian_merah = PengundianTGR::find($this->jadwal_ganda->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal_ganda->sudut_biru);
        if(!$this->jadwal_ganda->tampil){
            $this->jadwal_ganda->tampil = $this->jadwal_ganda->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_ganda->TampilTGR->TGR;
        $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = $this->gelanggang->waktu;
        if(Auth::user()->gelanggang !== $this->jadwal_ganda->Gelanggang->id){
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

    //operator start
     public function kurangiWaktu(){
        $this->gelanggang->waktu = ($this->gelanggang->waktu * 60 - 1) / 60;
        $this->gelanggang->save();
    }
    public function gantiTampil($sudut){
        $this->gelanggang->waktu = 3;
        $this->gelanggang->save();
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
            $this->active = "keputusan";
            $this->mulai = false;
            if($tampil == "merah"){
                $this->jadwal_ganda->pemenang = $this->pengundian_merah->id;
            }else if($tampil == "biru"){
                $this->jadwal_ganda->pemenang = $this->pengundian_biru->id;
            }
            $this->jadwal_ganda->jenis_kemenangan = $keputusan_pemenang;
            $this->jadwal_ganda->save();
            $next_partai = JadwalTGR::find($this->jadwal_ganda->next_partai);
            if($next_partai && $this->jadwal_ganda->next_sudut == 1){
                $next_partai->sudut_biru = $this->jadwal_ganda->pemenang;
            }else if($next_partai && $this->jadwal_ganda->next_sudut == 2){
                $next_partai->sudut_merah = $this->jadwal_ganda->pemenang;
            }
        }else if($tahap == "tampil"){
            $this->waktu = $this->gelanggang->waktu;
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_ganda->tahap = "tampil nilai";
            $this->jadwal_ganda->save();
        }else if($tahap == "pause"){
            $this->mulai = false;
        }else if($tahap == "persiapan"){
            $this->active = "persiapan";
            $this->mulai = false;
            $this->gelanggang->waktu = 3;
            $this->waktu = $this->gelanggang->waktu;
            $this->jadwal_ganda->tahap = "persiapan";
            $this->gelanggang->save();
            $this->jadwal_ganda->save();
        }
        $this->jadwal_ganda->tahap = $tahap;
        $this->jadwal_ganda->save();
        $this->tampil = $this->jadwal_ganda->TampilTGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_ganda);
    }
    //operator endpublic function render()

    #[On('echo:poin,.tambah-skor-ganda')]
    public function tambahNilaiHandler($data){
        if($this->jadwal_ganda->id == $data["jadwal_ganda"]["id"]){
            $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.salah-gerakan-ganda')]
    public function salahGerakanHandler($data){
        if($this->jadwal_ganda->id == $data["jadwal_ganda"]["id"]){
            $this->penilaian_ganda_juri_merah = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->get();
            $this->penilaian_ganda_juri_biru = PenilaianGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->get();
        }
    }
    #[On('echo:poin,.penalty-ganda')]
    public function tambahPenaltyHandler($data){
        if($this->jadwal_ganda->id == $data["jadwal_ganda"]["id"]){          
            $this->penalty_ganda_merah = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_merah->id)->first();
            $this->penalty_ganda_biru = PenaltyGanda::where('jadwal_ganda',$this->jadwal_ganda->id)->where('sudut',$this->sudut_biru->id)->first();
        }
    }
    #[On('echo:poin,.hapus-penalty-ganda')]
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
