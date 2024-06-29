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
    public $active;
    
    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Tunggal"){
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
            $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }else{
            $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }
        if($this->penilaian_tunggal){
            $this->active = $this->penilaian_tunggal->flow_skor;
        }
    }

    public function getListeners()
    {
        return [
            "echo-private:poin-{$this->jadwal->id},.hapus-penalty-tunggal" => 'hapusPenaltyHandler',
            "echo-private:arena-{$this->jadwal->id},.ganti-tampil-tunggal" => 'gantiTampilHandler',
           "echo-private:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }
    
    public function buatPenilaian(){
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
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
        $this->active = $this->penilaian_tunggal->flow_skor;
        TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_tunggal,Auth::user());
    }
    public function tambahNilaiTrigger($id,$value){
        $value/=100;
        $this->active = $value;
        $this->penilaian_tunggal->flow_skor = $value;
        $this->penilaian_tunggal->skor = (9.90 - $this->penilaian_tunggal->salah*0.01) + $this->penilaian_tunggal->flow_skor;
        $this->penilaian_tunggal->save();
        TambahNilai::dispatch($this->jadwal,$id == $this->sudut_biru->id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_tunggal,Auth::user());
    }

    public function salahGerakanTrigger($id){
        $this->penilaian_tunggal->increment('salah');
        $this->penilaian_tunggal->skor -= 0.01;
        $this->penilaian_tunggal->save();
        SalahGerakan::dispatch($this->jadwal,$this->tampil->id == $this->pengundian_biru->atlet_id ? $this->sudut_biru : $this->sudut_merah,$this->penilaian_tunggal,Auth::user());
    }


    public function gantiTampilHandler($data){
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
            $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }else{
            $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }
        TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_tunggal,Auth::user());
        if($this->penilaian_tunggal){
            $this->active = $this->penilaian_tunggal->flow_skor;
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
        if(Auth::user()->Gelanggang->jenis != "Tunggal" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
    }

    public function hapusPenaltyHandler($data){
        if($data["juri"]["permissions"] == "Operator"){
            $penilaian_tunggal_biru = PenilaianTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            $penilaian_tunggal_merah = PenilaianTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if($penilaian_tunggal_biru){
                $penilaian_tunggal_biru->delete();
            }
            if($penilaian_tunggal_merah){
                $penilaian_tunggal_merah->delete();
            }
            if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
                $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_biru->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            }else{
                $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$this->sudut_merah->id)->where('jadwal_tunggal',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            }
            $this->active = null;
            TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_tunggal,Auth::user());
        }
    }

    public function render()
    {
        return view('livewire.juri-tunggal',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
