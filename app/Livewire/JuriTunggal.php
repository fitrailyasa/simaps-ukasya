<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Tunggal\TambahNilai;
use App\Events\Tunggal\SalahGerakan;
use App\Models\PenilaianTunggal;


class JuriTunggal extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $tampil;
    public $mulai = false;
    public $penilaian_tunggal;
    
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Tunggal')->first();
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->tampil = $this->sudut_biru->id;
        if($this->tampil == $this->sudut_biru->id){
            $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if(!$this->penilaian_tunggal){
                $this->penilaian_tunggal = PenilaianTunggal::create([
                    'jadwal_tunggal'=>$this->jadwal->id,
                    'sudut' => $this->sudut_biru->id,
                    'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
            }
        }else{
            $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if(!$this->penilaian_tunggal){
                $this->penilaian_tunggal = PenilaianTunggal::create([
                    'jadwal_tunggal'=>$this->jadwal->id,
                    'sudut' => $this->sudut_merah->id,
                    'uuid'=>date('Ymd-His').'-'.$this->sudut_merah->id.Auth::user()->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
            }
        }
    }

    public function tambahNilaiTrigger($id,$value){
        $value/=100;
        $this->penilaian_tunggal->skor += $value;
        $this->penilaian_tunggal->flow_skor += $value;
        $this->penilaian_tunggal->save();
        TambahNilai::dispatch($this->jadwal,$id == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_tunggal,Auth::user());
    }

    public function salahGerakanTrigger($id){
        $this->penilaian_tunggal->increment('salah');
        $this->penilaian_tunggal->skor -= 0.01;
        $this->penilaian_tunggal->save();
        SalahGerakan::dispatch($this->jadwal,$this->tampil == $this->jadwal->sudut_biru ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_tunggal,Auth::user());
    }

    #[On('echo:poin,.tambah-skor-tunggal')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-tunggal')]
    public function salahGerakanHandler(){
    }

    public function render()
    {
        return view('livewire.juri-tunggal',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
