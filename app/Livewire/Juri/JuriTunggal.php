<?php

namespace App\Livewire\Juri;

use App\Models\PengundianTGR;
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
    public $pengundian_merah;
    public $pengundian_biru;
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
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->pengundian_merah = PengundianTGR::find($this->jadwal->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal->sudut_biru);
        $this->sudut_biru = TGR::find($this->pengundian_biru->atlet_id);
        $this->sudut_merah = TGR::find($this->pengundian_merah->atlet_id);
        $this->tampil = TGR::find($this->jadwal->tampil == $this->pengundian_merah->atlet_id ? $this->sudut_merah->id : $this->sudut_biru->id);
        $this->waktu = $this->gelanggang->waktu * 60;
        if($this->tampil->id == $this->sudut_biru->id){
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
                TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_tunggal,Auth::user());
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
        SalahGerakan::dispatch($this->jadwal,$this->tampil->id == $this->pengundian_biru->atlet_id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_tunggal,Auth::user());
    }

    #[On('echo:poin,.tambah-skor-tunggal')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-tunggal')]
    public function salahGerakanHandler(){
    }
    #[On('echo:arena,.ganti-tahap-tunggal')]
    public function gantiTahapHandler($data){
        
    }

    #[On('echo:arena,.ganti-tampil-tunggal')]
    public function gantiTampilHandler($data){
        if($this->jadwal->tampil == $this->pengundian_biru->id){
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
        $this->pengundian_merah = PengundianTGR::find($this->jadwal->sudut_merah);
        $this->pengundian_biru = PengundianTGR::find($this->jadwal->sudut_biru);
        $this->sudut_biru = TGR::find($this->pengundian_biru->atlet_id);
        $this->sudut_merah = TGR::find($this->pengundian_merah->atlet_id);
        $this->tampil = TGR::find($this->jadwal->tampil == $this->pengundian_merah->atlet_id ? $this->sudut_merah->id : $this->sudut_biru->id);
    }

    public function render()
    {
        return view('livewire.juri-tunggal',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
