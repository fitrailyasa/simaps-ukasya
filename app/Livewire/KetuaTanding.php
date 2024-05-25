<?php

namespace App\Livewire;
use App\Models\User;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;
use App\Models\PenilaianJuri;
use Livewire\Attributes\On;

use Livewire\Component;

class KetuaTanding extends Component
{
        public $jadwal;
        public $sudut_merah;
        public $sudut_biru;
        public $juris;
        public $gelanggang;
        public $penilaian_tanding_merah;
        public $penilaian_tanding_biru;
        public $waktu;
        public $mulai = false;

        
        public function mount(){
            $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
            $this->juris = User::where('gelanggang', $this->gelanggang->id)->where('roles_id',4)->where('status',true)->get();
            $this->jadwal = JadwalTanding::where('gelanggang',$this->gelanggang->id)->first();
            $this->waktu = $this->gelanggang->waktu;
            $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
            $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }

    public function resetIndikator(){
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 - 1) / 60;
        }
    }


     #[On('echo:poin,.tambah-peringatan')]
    public function peringatanHandler(){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }
    #[On('echo:poin,.tambah-teguran')]
    public function teguranHandler(){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }
    #[On('echo:poin,.tambah-binaan')]
    public function binaanHandler(){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }
    #[On('echo:poin,.tambah-jatuhan')]
    public function jatuhanHandler(){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }
    #[On('echo:poin,.tambah-pukulan')]
    public function pukulanHandler(){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }
    #[On('echo:poin,.tambah-tendangan')]
    public function tendanganHandler($data){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
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
    }
    #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
        
    }
     #[On('echo:poin,.poin-masuk-keluar')]
    public function poinHandler(){
        ;
    }
    public function render()
    {
        return view('livewire.Tanding.ketua-tanding')->extends('layouts.client.app')->section('content');
    }
}
