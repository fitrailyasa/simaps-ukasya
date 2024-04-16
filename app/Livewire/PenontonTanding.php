<?php

namespace App\Livewire;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\Babak;
use Livewire\Attributes\On;

use Livewire\Component;

class PenontonTanding extends Component
{
    public $jadwal;
    public $pesilat_merah;
    public $pesilat_biru;
    public $gelanggang;
    public $babak_merah;
    public $babak_biru;
    public $waktu = 120;

    public function mount(){
        $this->gelanggang = Gelanggang::find(1)->first();
        $this->jadwal = JadwalTanding::where('gelanggang',$this->gelanggang->id)->first();
        $this->pesilat_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->pesilat_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->babak_merah= Babak::where('atlet',$this->pesilat_merah->id)->where('babak',$this->jadwal->babak_tanding)->first();
        $this->babak_biru= Babak::where('atlet',$this->pesilat_biru->id)->where('babak',$this->jadwal->babak_tanding)->first();   
    }

    public function decrementWaktu()
    {   
        if($this->waktu == 0) return;
        $this->waktu -= 0.01;
    }

     #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
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
   

    public function render()
    {
        return view('livewire.penonton-tanding',[
            'jadwal'=> $this->jadwal,
            'pesilat_merah'=>$this->pesilat_merah,
            'pesilat_biru'=>$this->pesilat_biru,
            'babak_biru'=>$this->babak_biru,
            'babak_merah'=>$this->babak_merah
            ])->extends('layouts.client.app')->section('content');
    }
}
