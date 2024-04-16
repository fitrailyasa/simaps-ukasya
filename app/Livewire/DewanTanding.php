<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\VerifikasiPelanggaran;
use App\Events\TambahPeringatan;
use App\Events\TambahTeguran;
use App\Events\TambahJatuhan;
use App\Events\TambahBinaan;
use App\Events\GantiBabak;
use App\Models\JadwalTanding;
use App\Models\Tanding;
use App\Models\Gelanggang;
use App\Models\Babak;

class DewanTanding extends Component
{
    public $jadwal;
    public $pesilat_merah;
    public $pesilat_biru;
    public $gelanggang;
    public $babak_merah;
    public $babak_biru;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->pesilat_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->pesilat_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->babak_merah= Babak::where('atlet',$this->pesilat_merah->id)->get();
        $this->babak_biru= Babak::where('atlet',$this->pesilat_biru->id)->get();    
    }
    public function gantiBabak(){
        
    }
    public function tambahPeringatanTrigger($id){
        TambahPeringatan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahTeguranTrigger($id){
        TambahTeguran::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahBinaanTrigger($id){
        TambahBinaan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahJatuhanTrigger($id){
        TambahJatuhan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function gantiBabakTrigger($id){
        GantiBabak::dispatch($id);
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
    #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
        
    }
    public function render()
    {
        return view('livewire.dewan-tanding',[
        'jadwal'=> $this->jadwal,
        'pesilat_merah'=>$this->pesilat_merah,
        'pesilat_biru'=>$this->pesilat_biru,
        'babak_biru'=>$this->babak_biru,
        'babak_merah'=>$this->babak_merah
        ])->extends('layouts.dewan.app')->section('content');
    }
}
