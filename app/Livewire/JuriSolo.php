<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Solo\TambahNilai;
use App\Events\Solo\SalahGerakan;
use App\Models\PenilaianSolo;


class JuriSolo extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $tampil;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_solo;
    
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Solo_kreatif')->first();
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->tampil = $this->jadwal->sudut_merah;
        $this->penilaian_solo = PenilaianSolo::where('sudut',$this->tampil)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        if(!$this->penilaian_solo){
            $this->penilaian_solo = PenilaianSolo::create([
                'jadwal_solo'=>$this->jadwal->id,
                'sudut' => $this->tampil,
                'uuid'=>date('Ymd-His').'-'.$this->tampil.Auth::user()->id.'-'.$this->jadwal->id,
                'juri' => Auth::user()->id
            ]);
        }
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
    }

    public function tambahNilaiTrigger($value,$jenis_skor){
        TambahNilai::dispatch($this->jadwal->id,$this->sudut->id,$value/100,Auth::user()->id,$jenis_skor);
    }

    public function salahGerakanTrigger(){
        SalahGerakan::dispatch($this->jadwal->id,$this->sudut->id,Auth::user()->id);
    }

    #[On('echo:poin,.tambah-skor-solo')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-solo')]
    public function salahGerakanHandler(){
    }

    public function render()
    {
        return view('livewire.juri-solo',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
