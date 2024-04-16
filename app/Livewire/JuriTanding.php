<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Events\TambahPukulan;
use App\Events\TambahTendangan;
use App\Events\Hapus;


class JuriTanding extends Component
{
    public $jadwal;
    public $pesilat_merah;
    public $pesilat_biru;
    public $gelanggang;
    public $last=[];
    public $babak_1_pesilat_merah = '';
    public $babak_2_pesilat_merah = '';
    public $babak_3_pesilat_merah = '';
    public $babak_1_pesilat_biru = '';
    public $babak_2_pesilat_biru = '';
    public $babak_3_pesilat_biru = '';

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->pesilat_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->pesilat_biru = Tanding::find($this->jadwal->sudut_biru);
    }

    public function hapusTrigger($id){
        switch ($this->jadwal->babak_tanding) {
            case 1:
                if($id == $this->pesilat_merah->id){
                    $this->babak_1_pesilat_merah = substr($this->babak_1_pesilat_merah, 0, -1);
                }else{
                    $this->babak_1_pesilat_biru = substr($this->babak_1_pesilat_biru, 0, -1);
                }
                break;
            
            case 2:
               if($id == $this->pesilat_merah->id){
                    $this->babak_2_pesilat_merah = substr($this->babak_2_pesilat_merah, 0, -1);
                }else{
                    $this->babak_2_pesilat_biru = substr($this->babak_2_pesilat_biru, 0, -1);
                }
                break;
            case 3:
                if($id == $this->pesilat_merah->id){
                    $this->babak_3_pesilat_merah = substr($this->babak_3_pesilat_merah, 0, -1);
                }else{
                    $this->babak_3_pesilat_biru = substr($this->babak_3_pesilat_biru, 0, -1);
                }
                break;
        }
        if(end($this->last) == 'tendangan'){
            Hapus::dispatch($id,'tendangan',$this->last);
            array_pop($this->last);
        }else{
            Hapus::dispatch($id,'pukulan',$this->last);
            array_pop($this->last);
        }
    }

    public function tambahPukulanTrigger($id){
        array_push($this->last,'pukulan');
        switch ($this->jadwal->babak_tanding) {
            case 1:
                if($id == $this->pesilat_merah->id){
                    $this->babak_1_pesilat_merah .= '1';
                }else{
                    $this->babak_1_pesilat_biru .= '1';
                }
                break;
            
            case 2:
               if($id == $this->pesilat_merah->id){
                    $this->babak_2_pesilat_merah .= '1';
                }else{
                    $this->babak_2_pesilat_biru .= '1';
                }
                break;
            case 3:
                if($id == $this->pesilat_merah->id){
                    $this->babak_3_pesilat_merah .= '1';
                }else{
                    $this->babak_3_pesilat_biru .= '1';
                }
                break;
        }
        TambahPukulan::dispatch($id,$this->last);
    }
    public function tambahTendanganTrigger($id){
        array_push($this->last,'tendangan');
        switch ($this->jadwal->babak_tanding) {
            case 1:
               if($id == $this->pesilat_merah->id){
                    $this->babak_1_pesilat_merah .= '2';
                }else{
                    $this->babak_1_pesilat_biru .= '2';
                }
                break;
            
            case 2:
               if($id == $this->pesilat_merah->id){
                    $this->babak_2_pesilat_merah .= '2';
                }else{
                    $this->babak_2_pesilat_biru .= '2';
                }
                break;
            case 3:
                if($id == $this->pesilat_merah->id){
                    $this->babak_3_pesilat_merah .= '2';
                }else{
                    $this->babak_3_pesilat_biru .= '2';
                }
                break;
        }
    TambahTendangan::dispatch($id);
    }

    #[On('echo:verifikasi,.verifikasi-pelanggaran')]
    public function evenHandler(){
       
    }
    #[On('echo:poin,.tambah-pukulan')]
    public function pukulanHandler(){
    }
    #[On('echo:poin,.tambah-tendangan')]
    public function tendanganHandler(){
    
    }
    #[On('echo:poin,.hapus')]
    public function hapusHandler(){
    }
     #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
        ;
    }
  
    public function render()
    {
        return view('livewire.juri-tanding',['jadwal'=> $this->jadwal,
        'pesilat_merah'=>$this->pesilat_merah,
        'pesilat_biru'=>$this->pesilat_biru,
        'babak_1_pesilat_merah'=>$this->babak_1_pesilat_merah,
        'babak_2_pesilat_merah'=>$this->babak_2_pesilat_merah,
        'babak_3_pesilat_merah'=>$this->babak_3_pesilat_merah,
        'babak_1_pesilat_biru'=>$this->babak_1_pesilat_biru,
        'babak_2_pesilat_biru'=>$this->babak_2_pesilat_biru,
        'babak_3_pesilat_biru'=>$this->babak_3_pesilat_biru,
        ])->extends('layouts.juri.app')->section('content');
    }
}
