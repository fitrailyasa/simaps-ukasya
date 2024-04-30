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
        public $juris;
        public $penilaian_juri_merah;
        public $penilaian_juri_biru;
        public $sudut_biru;
        public $gelanggang;
        public $penilaian_tanding_merah;
        public $penilaian_tanding_biru;
        public $waktu;
        public $mulai = false;
        public $skor_merah; 
        public $skor_biru; 
        
        public function mount(){
            $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
            $this->juris = User::where('gelanggang', $this->gelanggang->id)->where('roles_id',4)->get();
            $this->penilaian_juri = PenilaianJuri::where('gelanggang', $this->gelanggang->id)->get();
            $this->jadwal = JadwalTanding::where('gelanggang',$this->gelanggang->id)->first();
            $this->waktu = $this->gelanggang->waktu * 60;
            $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
            $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
            $this->penilaian_tanding_merah= PenilaianTanding::where('atlet',$this->sudut_merah->id)->where('babak',$this->jadwal->babak_tanding)->first();
            $this->penilaian_tanding_biru= PenilaianTanding::where('atlet',$this->sudut_biru->id)->where('babak',$this->jadwal->babak_tanding)->first();  
            $this->skor_merah = json_decode($this->penilaian_tanding_merah->skor);
            $this->skor_biru = json_decode($this->penilaian_tanding_biru->skor);
            $this->penilaian_juri_merah = PenilaianJuri::where('sudut',$this->jadwal->sudut_merah)->where('partai',$this->jadwal->partai)->get();
            $this->penilaian_juri_biru = PenilaianJuri::where('sudut',$this->jadwal->sudut_biru)->where('partai',$this->jadwal->partai)->get();
    }

    public function resetWaktu(){
        $this->waktu = 3 * 60;
        $this->gelanggang->save();
    }

    public function decrementWaktu()
    {   
        $this->waktu -= 0.01;
        $this->gelanggang->waktu = $this->waktu/60;
        $this->gelanggang->save();
        
    }


     #[On('echo:poin,.tambah-peringatan')]
    public function peringatanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-teguran')]
    public function teguranHandler(){
        ;
    }
    #[On('echo:poin,.tambah-binaan')]
    public function binaanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-jatuhan')]
    public function jatuhanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-pukulan')]
    public function pukulanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-tendangan')]
    public function tendanganHandler($data){
        ;
    }
    
   #[On('echo:arena,.mulai-pertandingan')]
    public function mulaiPertandinganHandler(){
        $this->mulai = true;
    }
    #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
         $this->penilaian_tanding_merah= PenilaianTanding::where('atlet',$this->sudut_merah->id)->where('babak',$this->jadwal->babak_tanding)->first();
            $this->penilaian_tanding_biru= PenilaianTanding::where('atlet',$this->sudut_biru->id)->where('babak',$this->jadwal->babak_tanding)->first();  
            $this->skor_merah = json_decode($this->penilaian_tanding_merah->skor);
            $this->skor_biru = json_decode($this->penilaian_tanding_biru->skor);

        foreach ($this->penilaian_juri_biru as $key => $value) {
            $this->penilaian_juri_biru[$key]->data = null;
            $this->penilaian_juri_biru[$key]->save();
            $this->penilaian_juri_merah[$key]->data = null;
            $this->penilaian_juri_merah[$key]->save();
        }
        
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
