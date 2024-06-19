<?php

namespace App\Livewire\Juri;

use App\Models\PengundianTGR;
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
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_ganda;
    public $tampil;
    public $attack_active;
    public $firmness_active;
    public $soulfulness_active;

    
    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Ganda"){
            return redirect('auth');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->pengundian_merah = PengundianTGR::find($this->jadwal->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal->sudut_biru);
        $this->sudut_biru = TGR::find($this->pengundian_biru->atlet_id);
        $this->sudut_merah = TGR::find($this->pengundian_merah->atlet_id);
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->waktu = $this->gelanggang->waktu * 60;
        $this->penilaian_ganda = PenilaianGanda::where('sudut',$this->tampil->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        if(!$this->penilaian_ganda){
            $this->penilaian_ganda = PenilaianGanda::create([
                'jadwal_ganda'=>$this->jadwal->id,
                'sudut' => $this->tampil->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                'juri' => Auth::user()->id
            ]);
            TambahNilai::dispatch($this->jadwal,$this->tampil,$this->penilaian_ganda,Auth::user(),$this->gelanggang);
        }
        $this->attack_active = $this->penilaian_ganda->attack_skor;
        $this->firmness_active = $this->penilaian_ganda->firmness_skor;
        $this->soulfulness_active = $this->penilaian_ganda->soulfulness_skor;
    }

    public function tambahNilaiTrigger($value,$jenis_skor){
        $value/=100;
        switch ($jenis_skor) {
            case 'attack_skor':
                $this->attack_active = $value;
                $this->penilaian_ganda->attack_skor = $value;
                $this->penilaian_ganda->save();
                break;
            case 'firmness_skor':
                $this->firmness_active = $value;
                $this->penilaian_ganda->firmness_skor = $value;
                $this->penilaian_ganda->save();
                break;
            case 'soulfulness_skor':
                $this->soulfulness_active = $value;
                $this->penilaian_ganda->soulfulness_skor = $value;
                $this->penilaian_ganda->save();
                break;
        }
        $this->penilaian_ganda->skor = 0.1 + $this->penilaian_ganda->attack_skor + $this->penilaian_ganda->firmness_skor + $this->penilaian_ganda->soulfulness_skor;
        $this->penilaian_ganda->save();
        TambahNilai::dispatch($this->jadwal,$this->tampil,$this->penilaian_ganda,Auth::user(),$this->gelanggang);
    }

    #[On('echo:poin,.tambah-skor-ganda')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-ganda')]
    public function salahGerakanHandler(){
    }

    #[On('echo:arena,.ganti-gelanggang')]
    public function GantiGelanggangHandler(){
        if(Auth::user()->Gelanggang->jenis != "Ganda"){
            return redirect('auth');
        }
    }

    public function render()
    {
        return view('livewire.juri-ganda',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
