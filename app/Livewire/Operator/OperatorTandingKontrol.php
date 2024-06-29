<?php

namespace App\Livewire\Operator;

use App\Events\GantiGelanggang;
use App\Events\Tanding\GantiBabak;
use App\Events\Tanding\Hapus;
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
    public $jadwal_tandings;
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
    public $next;
    public $user;
    public $total_poin_merah;
    public $total_poin_biru;



    public function mount($jadwal_tanding_id){
        $this->user = Auth::user();
        $this->jadwal_tandings = JadwalTanding::orderBy('partai')->get();
        $this->jadwal_tanding = JadwalTanding::find($jadwal_tanding_id);
        foreach ($this->jadwal_tandings as $key=>$jadwal) {     
            if ($this->jadwal_tanding->id == $jadwal->id) {
                if($key+1 == count($this->jadwal_tandings)){
                    $this->next = $this->jadwal_tandings[$key]->id;
            }else{
                $this->next = $this->jadwal_tandings[$key+1]->id;
            }
            }
        }
        $this->total_poin_biru = 0;
        $this->total_poin_merah = 0;
        $this->gelanggang = $this->jadwal_tanding->Gelanggang;
        $this->sudut_biru = $this->jadwal_tanding->PengundianTandingBiru->Tanding;
        $this->sudut_merah = $this->jadwal_tanding->PengundianTandingMerah->Tanding;
        $this->pengundian_merah = $this->jadwal_tanding->PengundianTandingMerah;
        $this->pengundian_biru = $this->jadwal_tanding->PengundianTandingBiru;
        $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
        $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();  
        $this->waktu = 0;
        if(Auth::user()->roles_id != 1 && Auth::user()->gelanggang != $this->jadwal_tanding->Gelanggang->id){
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

    public function getListeners()
    {
        return [
            "echo-private:poin-{$this->jadwal_tanding->id},.tambah-jatuhan" => 'jatuhanHandler',
            "echo-private:poin-{$this->jadwal_tanding->id},.tambah-teguran" => 'teguranHandler',
            "echo-private:poin-{$this->jadwal_tanding->id},.tambah-peringatan" => 'peringatanHandler',
            "echo-private:poin-{$this->jadwal_tanding->id},.tambah-binaan" => 'binaanHandler',
            "echo-private:poin-{$this->jadwal_tanding->id},.tambah-pukulan" => 'pukulanHandler',
            "echo-private:poin-{$this->jadwal_tanding->id},.tambah-tendangan" => 'tendanganHandler',
            "echo-private:poin-{$this->jadwal_tanding->id},.hapus" => 'hapusHandler',
        ];
    }

    //operator start

    public function nextPartai(){
        $jadwaltanding = JadwalTanding::find($this->next);
        if($jadwaltanding){
            $this->gelanggang->jadwal = $this->next;
            $jadwaltanding->tahap = 'persiapan';
            $jadwaltanding->save();
            $this->gelanggang->save();
            GantiGelanggang::dispatch($jadwaltanding->Gelanggang);
        }
        if($this->user->roles_id != 1){
            return redirect('op/kontrol-tanding/'.$this->next);
        }else{
            return redirect('admin/kontrol-tanding/'.$this->next);
        }
    }
    public function Hapus(){
        PenilaianTanding::where('sudut', $this->sudut_merah->id)
        ->where('jadwal_tanding', $this->jadwal_tanding->id)
        ->delete();

        PenilaianTanding::where('sudut', $this->sudut_biru->id)
        ->where('jadwal_tanding', $this->jadwal_tanding->id)
        ->delete();

        $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
        $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();  
        $this->jadwal_tanding->pemenang = null;
        $this->jadwal_tanding->skor_biru = 0;
        $this->jadwal_tanding->skor_merah = 0;
        $this->jadwal_tanding->save();
        Hapus::dispatch($this->jadwal_tanding,Auth::user());
    }
    public function kurangiWaktu(){
        if($this->waktu >= $this->gelanggang->waktu){
            $this->jadwal_tanding->tahap = 'pause';
            $this->mulai = false;
            $this->jadwal_tanding->save();
            MulaiPertandingan::dispatch('pause pertandingan',$this->jadwal_tanding,$this->waktu);
        }
        $this->waktu = ($this->waktu * 60 + 1) / 60;
    } 
    public function keputusanMenang($sudut,$keputusan){
        foreach ($this->poin_merah->where('status','sah') as $index => $poin) {
            switch ($poin->jenis) {
                case 'jatuhan':
                    $this->total_poin_merah += $poin->dewan;
                    break;
                case 'binaan':
                    $this->total_poin_merah += $poin->dewan;
                    break;
                case 'teguran':
                    $this->total_poin_merah += $poin->dewan;
                    break;
                case 'peringatan':
                    $this->total_poin_merah += $poin->dewan;
                    break;
                case 'pukulan':
                    $this->total_poin_merah += 1;
                    break;
                case 'tendangan':
                    $this->total_poin_merah += 2;
                    break;
            }
        }
        foreach ($this->poin_biru->where('status','sah') as $index => $poin) {
            switch ($poin->jenis) {
                case 'jatuhan':
                    $this->total_poin_biru += $poin->dewan;
                    break;
                case 'binaan':
                    $this->total_poin_biru += $poin->dewan;
                    break;
                case 'teguran':
                    $this->total_poin_biru += $poin->dewan;
                    break;
                case 'peringatan':
                    $this->total_poin_biru += $poin->dewan;
                    break;
                case 'pukulan':
                    $this->total_poin_biru += 1;
                    break;
                case 'tendangan':
                    $this->total_poin_biru += 2;
                    break;
            }
        }
        $this->jadwal_tanding->tahap = 'hasil';
        $this->active = "hasil";
        if($sudut == "Sudut Biru"){
            $this->jadwal_tanding->pemenang = $this->jadwal_tanding->PengundianTandingBiru->id;
            $this->jadwal_tanding->save();
        }else if($sudut == "Sudut Merah"){
            $this->jadwal_tanding->pemenang = $this->jadwal_tanding->PengundianTandingMerah->id;
            $this->jadwal_tanding->save();
        }
        $this->jadwal_tanding->skor_biru = $this->total_poin_biru;
        $this->jadwal_tanding->skor_merah = $this->total_poin_merah;
        $this->jadwal_tanding->jenis_kemenangan = $keputusan;
        $this->jadwal_tanding->save();
        $next_partai = JadwalTanding::where("partai",$this->jadwal_tanding->next_partai)->first();
        if($next_partai){
            if($this->jadwal_tanding->next_sudut == 1){
                $next_partai->sudut_biru = $this->jadwal_tanding->pemenang;
            }else{
                $next_partai->sudut_merah = $this->jadwal_tanding->pemenang;
            }
            $next_partai->save();
        }
        MulaiPertandingan::dispatch('keputusan pemenang',$this->jadwal_tanding,$this->waktu);
    }
    public function mulaiPertandingan($state){
        if($state == "persiapan"){
            $this->active = "persiapan";
            $this->jadwal_tanding->tahap = "persiapan";
            $this->mulai = false;
            $this->jadwal_tanding->save();
            MulaiPertandingan::dispatch($state,$this->jadwal_tanding,$this->waktu);
        }else{
            //ganti dari persiapan ke mulai pertandingan
            if($this->jadwal_tanding->tahap == "persiapan"){
                $this->error = "Pilih Babak Terlebih Dahulu";
                return;
            };
            $this->mulai = true;
            $this->jadwal_tanding->save();
            MulaiPertandingan::dispatch($state,$this->jadwal_tanding,$this->waktu);
        }
    }

    public function pausePertandingan(){
        //ganti dari persiapan ke mulai pertandingan
        $this->jadwal_tanding->tahap = 'pause';
        $this->mulai = false;
        $this->jadwal_tanding->save();
        MulaiPertandingan::dispatch('pause pertandingan',$this->jadwal_tanding,$this->waktu);
    }
    public function gantiBabak($babak){
        //ganti babak 
        $this->active = "babak_".$babak;
        $this->waktu = 0;
        if($this->jadwal_tanding->babak_tanding != $babak){
            $this->mulai = false;
            $this->gelanggang->save();
        }
        $this->jadwal_tanding->babak_tanding = $babak;
        $this->jadwal_tanding->tahap = "tanding";
        $this->jadwal_tanding->save();   
        GantiBabak::dispatch($babak,$this->jadwal_tanding);
    }
//operator end

    public function hapusHandler($data){
        $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
        $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
    }
    public function peringatanHandler($data){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
    }
    public function teguranHandler($data){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
    }
    public function binaanHandler($data){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
    }
    public function jatuhanHandler($data){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
             $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
    }
    public function pukulanHandler($data){
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
    }
    public function tendanganHandler($data){
             $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal_tanding->id)->get(); 
    }
    public function render()
    {
        return view('livewire.operator.operator-tanding-kontrol')->extends('layouts.operator.app');
    }
}
