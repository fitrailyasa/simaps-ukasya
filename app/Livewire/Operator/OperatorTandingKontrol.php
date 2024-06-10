<?php

namespace App\Livewire\Operator;

use App\Events\Tanding\GantiBabak;
use App\Events\Tanding\MulaiPertandingan;
use App\Models\JadwalTanding;
use App\Models\PengundianTanding;
use App\Models\PenilaianTanding;
use App\Models\Tanding;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class OperatorTandingKontrol extends Component
{

    public $gelanggang;
    public $jadwal_tanding;
    public $sudut_biru;
    public $sudut_merah;
    public $poin_merah;
    public $poin_biru;
    public $waktu;
    public $mulai = false;
    public $pemenang;
    public $keputusan_pemenang;
    public $error = "";
    public $active;


    public function mount($jadwal_tanding_id){
        $this->jadwal_tanding = JadwalTanding::find($jadwal_tanding_id);
        $this->gelanggang = $this->jadwal_tanding->Gelanggang;
        $this->sudut_biru = Tanding::where('id',$this->jadwal_tanding->PengundianTandingBiru->atlet_id)->first();
        $this->sudut_merah = Tanding::where('id',$this->jadwal_tanding->PengundianTandingMerah->atlet_id)->first();
        $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
        $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();  
        $this->waktu = $this->gelanggang->waktu;
        if(Auth::user()->gelanggang !== $this->jadwal_tanding->Gelanggang->id){
            return redirect('/auth');
        }
        if($this->jadwal_tanding->tahap == "persiapan"){
            $this->active = "persiapan";
        }else if($this->jadwal_tanding->tahap == "tanding" || $this->jadwal_tanding->tahap == "pause" && $this->jadwal_tanding->babak_tanding == 1){
            $this->active = "babak_1";
        }else if($this->jadwal_tanding->tahap == "tanding" || $this->jadwal_tanding->tahap == "pause" && $this->jadwal_tanding->babak_tanding == 2){
            $this->active = "babak_2";
        }else if($this->jadwal_tanding->tahap == "tanding" || $this->jadwal_tanding->tahap == "pause" && $this->jadwal_tanding->babak_tanding ==3){
            $this->active = "babak_3";
        }else if ($this->jadwal_tanding->tahap == "hasil"){
            $this->active = "hasil";
        }
    }

    //operator start

    public function Hapus(){
        $this->poin_merah->delete();
    }
    public function kurangiWaktu(){
        $this->gelanggang->waktu = ($this->gelanggang->waktu * 60 - 1) / 60;
        $this->gelanggang->save();
    } 
    public function keputusanMenang($sudut,$keputusan){
        $this->jadwal_tanding->tahap = 'hasil';
        $this->active = "hasil";
        if($sudut == "Sudut Biru"){
            $this->jadwal_tanding->pemenang = $this->jadwal_tanding->PengundianTandingBiru->id;
            $this->jadwal_tanding->save();
        }else if($sudut == "Sudut Merah"){
            $this->jadwal_tanding->pemenang = $this->jadwal_tanding->PengundianTandingMerah->id;
            $this->jadwal_tanding->save();
        }
        $this->jadwal_tanding->jenis_kemenangan = $keputusan;
        $this->jadwal_tanding->save();
        $next_partai = JadwalTanding::where("partai",$this->jadwal_tanding->next_partai);
        if($this->jadwal_tanding->next_sudut == 1){
            $next_partai->sudut_biru = $this->jadwal_tanding->pemenang;
        }else{
            $next_partai->sudut_merah = $this->jadwal_tanding->pemenang;
        }
        MulaiPertandingan::dispatch('keputusan pemenang',$this->jadwal_tanding);
    }
    public function mulaiPertandingan($state){
        if($state == "persiapan"){
            $this->active = "persiapan";
            $this->jadwal_tanding->tahap = "persiapan";
            $this->mulai = false;
            $this->jadwal_tanding->save();
            MulaiPertandingan::dispatch($state,$this->jadwal_tanding);
        }else{
            //ganti dari persiapan ke mulai pertandingan
            if($this->jadwal_tanding->tahap == "persiapan"){
                $this->error = "Pilih Babak Terlebih Dahulu";
                return;
            };
            $this->mulai = true;
            $this->jadwal_tanding->save();
            MulaiPertandingan::dispatch($state,$this->jadwal_tanding);
        }
    }

    public function hapusNilai(){
        foreach ($this->poin_merah as $item) {
            $item->delete();
        }
        foreach ($this->poin_biru as $item) {
            $item->delete();
        }
    }

    public function pausePertandingan(){
        //ganti dari persiapan ke mulai pertandingan
        $this->jadwal_tanding->tahap = 'pause';
        $this->mulai = false;
        $this->jadwal_tanding->save();
        MulaiPertandingan::dispatch('pause pertandingan',$this->jadwal_tanding);
    }
    public function gantiBabak($babak){
        //ganti babak 
        if($this->jadwal_tanding->babak_tanding != $babak){
            $this->mulai = false;
            $this->gelanggang->waktu = 3;
            $this->gelanggang->save();
        }
        $this->jadwal_tanding->babak_tanding = $babak;
        $this->active = "babak_".$babak;
        $this->jadwal_tanding->tahap = "tanding";
        $this->jadwal_tanding->save();   
        GantiBabak::dispatch($babak,$this->jadwal_tanding);
    }
//operator end

    #[On('echo:poin,.tambah-peringatan')]
    public function peringatanHandler($data){
        if($data['jadwal']["id"] == $this->jadwal_tanding->id){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
        }
    }
    #[On('echo:poin,.tambah-teguran')]
    public function teguranHandler($data){
        if($data['jadwal']["id"] == $this->jadwal_tanding->id){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
        }
    }
    #[On('echo:poin,.tambah-binaan')]
    public function binaanHandler($data){
        if($data['jadwal']["id"] == $this->jadwal_tanding->id){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
        }
    }
    #[On('echo:poin,.tambah-jatuhan')]
    public function jatuhanHandler($data){
        if($data['jadwal']["id"] == $this->jadwal_tanding->id){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
             $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
        }
    }
    #[On('echo:poin,.tambah-pukulan')]
    public function pukulanHandler($data){
        if($data['jadwal']["id"] == $this->jadwal_tanding->id){
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
        }
    }
    #[On('echo:poin,.tambah-tendangan')]
    public function tendanganHandler($data){
        if($data['jadwal']["id"] == $this->jadwal_tanding->id){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
        }
    }
    public function render()
    {
        return view('livewire.operator.operator-tanding-kontrol')->extends('layouts.operator.app');
    }
}
