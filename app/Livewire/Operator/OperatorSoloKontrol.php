<?php

namespace App\Livewire\Operator;

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
    public function mount($jadwal_solo_id){
        $this->jadwal_solo = JadwalTGR::find($jadwal_solo_id);
        $this->gelanggang = $this->jadwal_solo->Gelanggang;
        $this->sudut_biru = TGR::where('id',$this->jadwal_solo->PengundianTGRBiru->atlet_id)->first();
        $this->sudut_merah = TGR::where('id',$this->jadwal_solo->PengundianTGRMerah->atlet_id)->first();
        $this->pengundian_merah = PengundianTGR::find($this->jadwal_solo->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal_solo->sudut_biru);
        if(!$this->jadwal_solo->tampil){
            $this->jadwal_solo->tampil = $this->jadwal_solo->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_solo->TampilTGR->TGR;
        $this->penilaian_solo_juri_merah = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_solo_merah = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_solo_juri_biru = PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_solo_biru = PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = $this->gelanggang->waktu;
        if(Auth::user()->gelanggang !== $this->jadwal_solo->Gelanggang->id){
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
    public function Hapus(){
        PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->delete();
        PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_merah->id)->delete();
        PenilaianSolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->delete();
        PenaltySolo::where('jadwal_solo',$this->jadwal_solo->id)->where('sudut',$this->sudut_biru->id)->delete();
    }
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
            $this->active = "keputusan";
            $this->mulai = false;
            if($tampil == "merah"){
                $this->jadwal_solo->pemenang = $this->pengundian_merah->id;
            }else if($tampil == "biru"){
                $this->jadwal_solo->pemenang = $this->pengundian_biru->id;
            }
            $this->jadwal_solo->jenis_kemenangan = $keputusan_pemenang;
            $this->jadwal_solo->save();
            $next_partai = JadwalTGR::find($this->jadwal_solo->next_partai);
            if($next_partai && $this->jadwal_solo->next_sudut == 1){
                $next_partai->sudut_biru = $this->jadwal_solo->pemenang;
            }else if($next_partai && $this->jadwal_solo->next_sudut == 2){
                $next_partai->sudut_merah = $this->jadwal_solo->pemenang;
            }
        }else if($tahap == "tampil"){
            $this->waktu = $this->gelanggang->waktu;
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_solo->tahap = "tampil nilai";
            $this->jadwal_solo->save();
        }else if($tahap == "pause"){
            $this->mulai = false;
        }else if($tahap == "persiapan"){
            $this->active = "persiapan";
            $this->mulai = false;
            $this->gelanggang->waktu = 3;
            $this->waktu = $this->gelanggang->waktu;
            $this->jadwal_solo->tahap = "persiapan";
            $this->gelanggang->save();
            $this->jadwal_solo->save();
        }
        $this->jadwal_solo->tahap = $tahap;
        $this->jadwal_solo->save();
        $this->tampil = $this->jadwal_solo->TampilTGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_solo);
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
