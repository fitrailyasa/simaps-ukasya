<?php

namespace App\Livewire\Juri;

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
    public $pengundian_merah;
    public $pengundian_biru;
    public $gelanggang;
    public $waktu ;
    public $mulai = false;
    public $penilaian_solo;
    public $tampil;
    public $attack_active;
    public $firmness_active;
    public $soulfulness_active;

    
    public function mount(){
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->Gelanggang->jenis != "Solo Kreatif"){
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
        $this->penilaian_solo = PenilaianSolo::where('sudut',$this->tampil->id)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        if(!$this->penilaian_solo){
            $this->penilaian_solo = PenilaianSolo::create([
                'jadwal_solo'=>$this->jadwal->id,
                'sudut' => $this->tampil->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                'juri' => Auth::user()->id
            ]);
            TambahNilai::dispatch($this->jadwal,$this->tampil,$this->penilaian_solo,Auth::user(),$this->gelanggang);
        }
        $this->attack_active = $this->penilaian_solo->attack_skor;
        $this->firmness_active = $this->penilaian_solo->firmness_skor;
        $this->soulfulness_active = $this->penilaian_solo->soulfulness_skor;
    }

    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal->id},.hapus-penalty-solo" => 'hapusPenaltyHandler',
            "echo:arena-{$this->jadwal->id},.ganti-tampil-solo" => 'gantiTampilHandler',
           "echo:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function tambahNilaiTrigger($value,$jenis_skor){
        $value/=100;
        switch ($jenis_skor) {
            case 'attack_skor':
                $this->attack_active = $value;
                $this->penilaian_solo->attack_skor = $value;
                $this->penilaian_solo->save();
                break;
            case 'firmness_skor':
                $this->firmness_active = $value;
                $this->penilaian_solo->firmness_skor = $value;
                $this->penilaian_solo->save();
                break;
            case 'soulfulness_skor':
                $this->soulfulness_active = $value;
                $this->penilaian_solo->soulfulness_skor = $value;
                $this->penilaian_solo->save();
                break;
        }
        $this->penilaian_solo->skor = 9.1 + $this->penilaian_solo->attack_skor + $this->penilaian_solo->firmness_skor + $this->penilaian_solo->soulfulness_skor;
        $this->penilaian_solo->save();
        TambahNilai::dispatch($this->jadwal,$this->tampil,$this->penilaian_solo,Auth::user(),$this->gelanggang);
    }

    public function tambahNilaiHandler(){
    }
    public function salahGerakanHandler(){
    }

    public function gantiTahapHandler($data){
        
    }

    public function gantiTampilHandler($data){
        if($this->jadwal->tampil == $this->jadwal->PengundianTGRBiru->id){
            $this->penilaian_solo = PenilaianSolo::where('sudut',$this->sudut_biru->id)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }else{
            $this->penilaian_solo = PenilaianSolo::where('sudut',$this->sudut_merah->id)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
        }
        $this->tampil = $this->jadwal->TampilTGR->TGR;
        if(!$this->penilaian_solo){
            $this->penilaian_solo = PenilaianSolo::create([
                'jadwal_solo'=>$this->jadwal->id,
                'sudut' => $this->tampil->id,
                'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                'juri' => Auth::user()->id
            ]);
        }
        $this->attack_active = $this->penilaian_solo->attack_skor;
        $this->firmness_active = $this->penilaian_solo->firmness_skor;
        $this->soulfulness_active = $this->penilaian_solo->soulfulness_skor;
        $this->pengundian_merah = $this->jadwal->PengundianTGRMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTGRBiru;
        $this->sudut_biru = $this->jadwal->PengundianTGRBiru->TGR;
        $this->sudut_merah = $this->jadwal->PengundianTGRMerah->TGR;
        TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_solo,Auth::user(),$this->gelanggang);
    }

    public function GantiGelanggangHandler(){
        if(Auth::user()->Gelanggang->jenis != "Solo Kreatif" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
    }

    public function hapusPenaltyHandler($data){
        if($data["juri"]["permissions"] == "Operator"){
            $penilaian_solo_biru = PenilaianSolo::where('sudut',$this->sudut_biru->id)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            $penilaian_solo_merah = PenilaianSolo::where('sudut',$this->sudut_merah->id)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if($penilaian_solo_biru){
                $penilaian_solo_biru->delete();
            }
            if($penilaian_solo_merah){
                $penilaian_solo_merah->delete();
            }
            $this->penilaian_solo = PenilaianSolo::where('sudut',$this->tampil->id)->where('jadwal_solo',$this->jadwal->id)->where('juri',Auth::user()->id)->first();
            if(!$this->penilaian_solo){
                $this->penilaian_solo = PenilaianSolo::create([
                    'jadwal_solo'=>$this->jadwal->id,
                    'sudut' => $this->tampil->id,
                    'uuid'=>date('Ymd-His').'-'.$this->tampil->id.Auth::user()->id.'-'.$this->jadwal->id,
                    'juri' => Auth::user()->id
                ]);
            }
            $this->attack_active = $this->penilaian_solo->attack_skor;
            $this->firmness_active = $this->penilaian_solo->firmness_skor;
            $this->soulfulness_active = $this->penilaian_solo->soulfulness_skor;
            TambahNilai::dispatch($this->jadwal,$this->tampil->id ,$this->penilaian_solo,Auth::user(),$this->gelanggang);
        }
    }

    public function render()
    {
        return view('livewire.juri-solo',[
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
