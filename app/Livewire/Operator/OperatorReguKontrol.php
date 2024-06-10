<?php

namespace App\Livewire\Operator;

use App\Events\Regu\GantiTahap;
use App\Events\Regu\GantiTampil;
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
        $this->jadwal_regu = JadwalTGR::find($jadwal_regu_id);
        $this->gelanggang = $this->jadwal_regu->Gelanggang;
        $this->sudut_biru = TGR::where('id',$this->jadwal_regu->PengundianTGRBiru->atlet_id)->first();
        $this->sudut_merah = TGR::where('id',$this->jadwal_regu->PengundianTGRMerah->atlet_id)->first();
        $this->pengundian_merah = PengundianTGR::find($this->jadwal_regu->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal_regu->sudut_biru);
        if(!$this->jadwal_regu->tampil){
            $this->jadwal_regu->tampil = $this->jadwal_regu->PengundianTGRBiru->id;
        }
        $this->tampil = $this->jadwal_regu->TampilTGR->TGR;
        $this->penilaian_regu_juri_merah = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->get();
        $this->penalty_regu_merah = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_merah->id)->first();
        $this->penilaian_regu_juri_biru = PenilaianRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->get();
        $this->penalty_regu_biru = PenaltyRegu::where('jadwal_regu',$this->jadwal_regu->id)->where('sudut',$this->sudut_biru->id)->first();
        $this->waktu = $this->gelanggang->waktu;
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
            $next_partai = JadwalTGR::find($this->jadwal_regu->next_partai);
            if($next_partai && $this->jadwal_regu->next_sudut == 1){
                $next_partai->sudut_biru = $this->jadwal_regu->pemenang;
            }else if($next_partai && $this->jadwal_regu->next_sudut == 2){
                $next_partai->sudut_merah = $this->jadwal_regu->pemenang;
            }
        }else if($tahap == "tampil"){
            $this->waktu = $this->gelanggang->waktu;
            $this->mulai = true;
        }else if($tahap == "tampil nilai"){
            $this->jadwal_regu->tahap = "tampil nilai";
            $this->jadwal_regu->save();
        }else if($tahap == "pause"){
            $this->mulai = false;
        }else if($tahap == "persiapan"){
            $this->active = "persiapan";
            $this->mulai = false;
            $this->gelanggang->waktu = 3;
            $this->waktu = $this->gelanggang->waktu;
            $this->jadwal_regu->tahap = "persiapan";
            $this->gelanggang->save();
            $this->jadwal_regu->save();
        }
        $this->jadwal_regu->tahap = $tahap;
        $this->jadwal_regu->save();
        $this->tampil = $this->jadwal_regu->TampilTGR;
        GantiTahap::dispatch($tahap,$tampil,$this->tampil->TGR,$this->jadwal_regu);
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
