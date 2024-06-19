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
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $tampil;
    public $mulai = false;
    public $penilaian_regu;
    
    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        $this->waktu = $this->gelanggang->waktu * 60;
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }else{
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }
    }

    public function buatPenilaian(){
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if(!$this->penilaian_regu){
                $this->penilaian_regu = PenilaianRegu::create([
                    'jadwal_regu'=>$this->jadwal->id,
                    'sudut' => $this->sudut_biru->id,
                    'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
                TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_regu,Auth::user());
            }
        }else{
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if(!$this->penilaian_regu){
                $this->penilaian_regu = PenilaianRegu::create([
                    'jadwal_regu'=>$this->jadwal->id,
                    'sudut' => $this->sudut_merah->id,
                    'uuid'=>date('Ymd-His').'-'.$this->sudut_merah->id.Auth::user()->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
                TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_regu,Auth::user());
            }
        }
    }
    public function tambahNilaiTrigger($id,$value){
        $value/=100;
        $this->penilaian_regu->flow_skor = $value;
        $this->penilaian_regu->skor = (9.90 - $this->penilaian_regu->salah*0.01) + $this->penilaian_regu->flow_skor;
        $this->penilaian_regu->save();
        TambahNilai::dispatch($this->jadwal,$id == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_regu,Auth::user());
    }

    public function salahGerakanTrigger($id){
        $this->penilaian_regu->increment('salah');
        $this->penilaian_regu->skor -= 0.01;
        $this->penilaian_regu->save();
        SalahGerakan::dispatch($this->jadwal,$this->tampil->id == $this->pengundian_biru->atlet_id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_regu,Auth::user());
    }

    #[On('echo:poin,.tambah-skor-regu')]
    public function tambahNilaiHandler(){
    }
    #[On('echo:poin,.salah-gerakan-regu')]
    public function salahGerakanHandler(){
    }
    #[On('echo:arena,.ganti-tahap-regu')]
    public function gantiTahapHandler($data){
        
    }

    #[On('echo:arena,.ganti-tampil-regu')]
    public function gantiTampilHandler($data){
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }else{
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }
        TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_regu,Auth::user());
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
    }

    public function render()
    {
        return view('livewire.juri-regu',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
