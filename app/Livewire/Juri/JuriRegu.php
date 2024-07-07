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
    public $active;
    
    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Regu"){
            return redirect('auth');
        }
        $this->jadwal = JadwalTGR::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/juri/'.$this->gelanggang->id);
        }
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
        if($this->penilaian_regu){
            $this->active = $this->penilaian_regu->flow_skor;
        }
    }

    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal->id},.hapus-penalty-regu" => 'hapusPenaltyHandler',
            "echo:arena-{$this->jadwal->id},.ganti-tampil-regu" => 'gantiTampilHandler',
           "echo:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
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
        $this->active = $this->penilaian_regu->flow_skor;
    }
    public function tambahNilaiTrigger($id,$value){
        if(!$this->penilaian_regu){
            return;
        }
        $value/=100;
        $this->active = $value;
        $this->penilaian_regu->flow_skor = $value;
        $this->penilaian_regu->skor = (9.90 - $this->penilaian_regu->salah*0.01) + $this->penilaian_regu->flow_skor;
        $this->penilaian_regu->save();
        TambahNilai::dispatch($this->jadwal,$id == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_regu,Auth::user());
    }

    public function salahGerakanTrigger($id){
        if (!$this->penilaian_regu) {
            return;
        }
        $this->penilaian_regu->increment('salah');
        $this->penilaian_regu->skor -= 0.01;
        $this->penilaian_regu->save();
        SalahGerakan::dispatch($this->jadwal,$this->tampil->id == $this->pengundian_biru->atlet_id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_regu,Auth::user());
    }

    public function gantiTampilHandler($data){
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }else{
            $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }
        TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_regu,Auth::user());
        if($this->penilaian_regu){
            $this->active = $this->penilaian_regu->flow_skor;
        }else{
            $this->active = 0;
        }
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        $this->tampil = $this->jadwal->TampilTGR->TGR;
    }

    public function GantiGelanggangHandler(){
        if(Auth::user()->Gelanggang->jenis != "Regu" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
    }

    public function hapusPenaltyHandler($data){
        if($data["juri"]["permissions"] == "Operator"){
            $penilaian_regu_biru = PenilaianRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            $penilaian_regu_merah = PenilaianRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if($penilaian_regu_biru){
                $penilaian_regu_biru->delete();
            }
            if($penilaian_regu_merah){
                $penilaian_regu_merah->delete();
            }
            if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
                $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_biru->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            }else{
                $this->penilaian_regu = PenilaianRegu::where('sudut',$this->sudut_merah->id)->where('jadwal_regu',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            }
            $this->active = null;
            TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_regu,Auth::user());
        }
    }

    public function render()
    {
        return view('livewire.juri-regu',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
