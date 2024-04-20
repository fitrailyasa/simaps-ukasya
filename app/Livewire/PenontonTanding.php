<?php

namespace App\Livewire;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;
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

    public function mount(){
        $this->gelanggang = Gelanggang::find(1)->first();
        $this->jadwal = JadwalTanding::where('gelanggang',$this->gelanggang->id)->first();
        $this->waktu = $this->gelanggang->waktu * 3;
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah= PenilaianTanding::where('atlet',$this->sudut_merah->id)->where('babak',$this->jadwal->babak_tanding)->first();
        $this->penilaian_tanding_biru= PenilaianTanding::where('atlet',$this->sudut_biru->id)->where('babak',$this->jadwal->babak_tanding)->first();  
    }

    public function decrementWaktu()
    {   
        if($this->waktu == 0) return;
        $this->waktu -= 0.01;
    }

     #[On('echo:arena,.ganti-babak')]
    public function GantiBabakHandler(){
        ;
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
        if($data['sudut_id'] == $this->sudut_merah->id){
            $this->tendangan_merah = $data['eventSent'];
        }else{
            $this->tendangan_biru = $data['eventSent'];
        };
    }
   

    public function render()
    {
        return view('livewire.penonton-tanding',[
            'jadwal'=> $this->jadwal,
            'sudut_merah'=>$this->sudut_merah,
            'sudut_biru'=>$this->sudut_biru,
            'pukulan_biru' => $this->pukulan_biru,
            'pukulan_merah' => $this->pukulan_merah,
            'tendangan_biru' => $this->tendangan_biru,
            'tendangan_merah' => $this->tendangan_merah,
            'penilaian_tanding_biru'=>$this->penilaian_tanding_biru,
            'penilaian_tanding_merah'=>$this->penilaian_tanding_merah
            ])->extends('layouts.client.app')->section('content');
    }
}
