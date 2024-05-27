<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Events\Ganda\TambahNilai;
use App\Events\Ganda\SalahGerakan;
use App\Models\PenilaianGanda;


class JuriGanda extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_ganda;
    
    public function mount(){
        $this->gelanggang = Gelanggang::where('jenis','Ganda')->first();
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTGR::where('gelanggang',$this->gelanggang->id)->first();
        $this->sudut_merah = TGR::find($this->jadwal->sudut_merah);
        $this->sudut_biru = TGR::find($this->jadwal->sudut_biru);
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->penilaian_ganda = PenilaianGanda::where('sudut_biru',$this->sudut_biru->id)->where('sudut_merah',$this->sudut_merah->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        if(!$this->penilaian_ganda){
                $this->penilaian_ganda = PenilaianGanda::create([
                    'jadwal_ganda'=>$this->jadwal->id,
                    'sudut_biru' => $this->sudut_biru->id,
                    'sudut_merah' => $this->sudut_merah->id,
                    'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->sudut_merah->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
            }
    }

    public function tambahNilaiTrigger($value,$jenis_skor){
        $value/=100;
        switch ($jenis_skor) {
            case 'attack_skor':
                $this->penilaian_ganda->attack_skor+=$value;
                $this->penilaian_ganda->save();
                break;
            case 'firmness_skor':
                $this->penilaian_ganda->firmness_skor+=$value;
                $this->penilaian_ganda->save();
                break;
            case 'soulfulness_skor':
                $this->penilaian_ganda->soulfulness_skor+=$value;
                $this->penilaian_ganda->save();
                break;
        }
        $this->penilaian_ganda->skor += $value;
        $this->penilaian_ganda->save();
        TambahNilai::dispatch($this->jadwal,[$this->sudut_biru , $this->sudut_merah],$this->penilaian_ganda,Auth::user());
    }

    #[On('echo:poin,.tambah-skor-ganda')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-ganda')]
    public function salahGerakanHandler(){
    }

    public function render()
    {
        return view('livewire.juri-ganda',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
