<?php

namespace App\Livewire;
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
    public $script;


    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
        $this->jadwal = JadwalTanding::where('gelanggang',$this->gelanggang->id)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah= PenilaianTanding::where('atlet',$this->sudut_merah->id)->where('babak',$this->jadwal->babak_tanding)->first();
        $this->penilaian_tanding_biru= PenilaianTanding::where('atlet',$this->sudut_biru->id)->where('babak',$this->jadwal->babak_tanding)->first();  
    }
    public function tes(){
        MulaiPertandingan::dispatch();
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
   #[On('echo:arena,.mulai-pertandingan')]
    public function mulaiPertandinganHandler($data){
        $this->mulai = true;
    }

    public function render()
    {
        return view('livewire.penonton-tanding')->extends('layouts.client.app')->section('content');
    }
}
