<?php

namespace App\Livewire\Penonton;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;
use App\Events\Tanding\MulaiPertandingan;
use Livewire\Attributes\On;

use Livewire\Component;

class PenontonTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $pukulan_biru;
    public $pukulan_merah;
    public $tendangan_biru;
    public $tendangan_merah;
    public $waktu ;
    public $mulai = false;
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
        $this->waktu = $this->gelanggang->waktu;
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }
    public function resetIndikator(){
        $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->pukulan_merah = $this->penilaian_tanding_merah->where('jenis','pukulan')->where('aktif',true)->last();
        $this->tendangan_merah = $this->penilaian_tanding_merah->where('jenis','tendangan')->where('aktif',true)->last();
        $this->pukulan_biru = $this->penilaian_tanding_biru->where('jenis','pukulan')->where('aktif',true)->last();
        $this->tendangan_biru = $this->penilaian_tanding_biru->where('jenis','tendangan')->where('aktif',true)->last();
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 - 0.1) / 60;
        }
    }

     #[On('echo:arena,.ganti-babak')]
    public function GantiBabakHandler($data){
        $this->waktu = $this->gelanggang->waktu;
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
    }

     #[On('echo:poin,.tambah-peringatan')]
    public function peringatanHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    #[On('echo:poin,.tambah-teguran')]
    public function teguranHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    #[On('echo:poin,.tambah-binaan')]
    public function binaanHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    #[On('echo:poin,.tambah-jatuhan')]
    public function jatuhanHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    #[On('echo:poin,.tambah-pukulan')]
    public function pukulanHandler($data){
        if($data['sudut_id'] == $this->sudut_merah->id){
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get();
            $this->pukulan_merah = $this->penilaian_tanding_merah->where('jenis','pukulan')->where('aktif',true)->last();
        }else{
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get();        
            $this->pukulan_biru = $this->penilaian_tanding_biru->where('jenis','pukulan')->where('aktif',true)->last();
        };
    }
    #[On('echo:poin,.tambah-tendangan')]
    public function tendanganHandler($data){
        if($data['sudut_id'] == $this->sudut_merah->id){
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get();
            $this->tendangan_merah = $this->penilaian_tanding_merah->where('jenis','tendangan')->where('aktif',true)->last();
        }else{
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get();        
            $this->tendangan_biru = $this->penilaian_tanding_biru->where('jenis','tendangan')->where('aktif',true)->last();
        };
    }
   #[On('echo:arena,.mulai-pertandingan')]
    public function mulaiPertandinganHandler($data){
        if($data['event'] == 'mulai pertandingan'){
            $this->mulai = true;
        }else if($data['event'] == 'pause pertandingan'){
            $this->mulai = false;
            $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
            $this->waktu = $this->gelanggang->waktu;
        }else{
            $this->mulai = false;
        }
        $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
    }

    public function render()
    {
        return view('livewire.penonton-tanding')->extends('layouts.client.app')->section('content');
    }
}
