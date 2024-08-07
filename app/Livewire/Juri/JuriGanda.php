<?php

namespace App\Livewire\Juri;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Events\Ganda\TambahNilai;
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
        if(!$this->jadwal){
            return redirect('/jadwal/juri/'.$this->gelanggang->id);
        }
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
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

    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal->id},.hapus-penalty-ganda" => 'hapusPenaltyHandler',
            "echo:arena-{$this->jadwal->id},.ganti-tampil-ganda" => 'gantiTampilHandler',
           "echo:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function tambahNilaiTrigger($value,$jenis_skor){
        if(!$this->penilaian_ganda){
            return;
        }
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
        $this->penilaian_ganda->skor = 9.1 + $this->penilaian_ganda->attack_skor + $this->penilaian_ganda->firmness_skor + $this->penilaian_ganda->soulfulness_skor;
        $this->penilaian_ganda->save();
        TambahNilai::dispatch($this->jadwal,$this->tampil,$this->penilaian_ganda,Auth::user(),$this->gelanggang);
    }

    public function gantiTahapHandler($data){
        
    }

    public function gantiTampilHandler($data){
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
            $this->penilaian_ganda = PenilaianGanda::where('sudut',$this->sudut_biru->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }else{
            $this->penilaian_ganda = PenilaianGanda::where('sudut',$this->sudut_merah->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if(!$this->penilaian_ganda){
            $this->penilaian_ganda = PenilaianGanda::create([
                'jadwal_ganda'=>$this->jadwal->id,
                'sudut' => $this->tampil->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                'juri' => Auth::user()->id
            ]);
        }
        $this->attack_active = $this->penilaian_ganda->attack_skor;
        $this->firmness_active = $this->penilaian_ganda->firmness_skor;
        $this->soulfulness_active = $this->penilaian_ganda->soulfulness_skor;
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_ganda,Auth::user(),$this->gelanggang);
    }

    public function GantiGelanggangHandler(){
        if(Auth::user()->Gelanggang->jenis != "Ganda" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
    }

    public function hapusPenaltyHandler($data){
        if($data["juri"]["permissions"] == "Operator"){
            $penilaian_ganda_biru = PenilaianGanda::where('sudut',$this->sudut_biru->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            $penilaian_ganda_merah = PenilaianGanda::where('sudut',$this->sudut_merah->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if($penilaian_ganda_biru){
                $penilaian_ganda_biru->delete();
            }
            if($penilaian_ganda_merah){
                $penilaian_ganda_merah->delete();
            }
            $this->penilaian_ganda = PenilaianGanda::where('sudut',$this->tampil->id)->where('jadwal_ganda',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if(!$this->penilaian_ganda){
                $this->penilaian_ganda = PenilaianGanda::create([
                    'jadwal_ganda'=>$this->jadwal->id,
                    'sudut' => $this->tampil->id,
                    'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
            }
            $this->attack_active = $this->penilaian_ganda->attack_skor;
            $this->firmness_active = $this->penilaian_ganda->firmness_skor;
            $this->soulfulness_active = $this->penilaian_ganda->soulfulness_skor;
            TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_ganda,Auth::user(),$this->gelanggang);
        }
    }

    public function render()
    {
        return view('livewire.juri-ganda',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
