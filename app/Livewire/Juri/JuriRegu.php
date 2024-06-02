<?php

namespace App\Livewire\Juri;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Regu\TambahNilai;
use App\Events\Regu\SalahGerakan;
use App\Models\PenilaianRegu;


class JuriRegu extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_regu;
    
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Regu')->first();
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->penilaian_regu = PenilaianRegu::where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        if(!$this->penilaian_regu){
                $this->penilaian_regu = PenilaianRegu::create([
                    'jadwal_regu'=>$this->jadwal->id,
                    'sudut_biru' => $this->sudut_biru->id,
                    'sudut_merah' => $this->sudut_merah->id,
                    'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->sudut_merah->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
            }
    }

    public function tambahNilaiTrigger($value){
        $value/=100;
        $this->penilaian_regu->skor += $value;
        $this->penilaian_regu->flow_skor += $value;
        $this->penilaian_regu->save();
        TambahNilai::dispatch($this->jadwal,[$this->sudut_biru , $this->sudut_merah],$this->penilaian_regu,Auth::user());
    }

    public function salahGerakanTrigger(){
        $this->penilaian_regu->increment('salah');
        $this->penilaian_regu->skor -= 0.01;
        $this->penilaian_regu->save();
        SalahGerakan::dispatch($this->jadwal,[$this->sudut_biru , $this->sudut_merah],$this->penilaian_regu,Auth::user());
    }

    #[On('echo:poin,.tambah-skor-regu')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-regu')]
    public function salahGerakanHandler(){
    }

    public function render()
    {
        return view('livewire.juri-regu',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
