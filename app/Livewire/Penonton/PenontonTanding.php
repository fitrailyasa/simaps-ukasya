<?php

namespace App\Livewire\Penonton;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;
use App\Events\Tanding\MulaiPertandingan;
use Livewire\Attributes\On;

use Livewire\Component;

class PenontonTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $pukulan_biru;
    public $pukulan_merah;
    public $tendangan_biru;
    public $tendangan_merah;
    public $waktu ;
    public $mulai = false;
    public $gel_id;
    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        if($this->gelanggang->jenis != "Tanding"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
        $this->gel_id = $this->gelanggang->id;
        $this->waktu = 0;
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/penonton/'.$this->gelanggang->id);
        }
        $this->sudut_merah = $this->jadwal->PengundianTandingMerah->Tanding;
        $this->sudut_biru = $this->jadwal->PengundianTandingBiru->Tanding;
        $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }

    public function getListeners()
    {
        return [
            "echo-private:poin-{$this->jadwal->id},.tambah-pukulan" => 'pukulanHandler',
            "echo-private:poin-{$this->jadwal->id},.tambah-tendangan" => 'tendanganHandler',
            "echo-private:poin-{$this->jadwal->id},.tambah-jatuhan" => 'jatuhanHandler',
            "echo-private:poin-{$this->jadwal->id},.tambah-teguran" => 'teguranHandler',
            "echo-private:poin-{$this->jadwal->id},.tambah-peringatan" => 'peringatanHandler',
            "echo-private:poin-{$this->jadwal->id},.tambah-binaan" => 'binaanHandler',
            "echo-private:arena-{$this->jadwal->id},.ganti-babak" => 'gantiBabakHandler',
            "echo-private:arena-{$this->jadwal->id},.mulai-pertandingan" => 'mulaiPertandinganHandler',
           "echo-private:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',            
        ];
    }
    public function resetIndikator(){
        $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->pukulan_merah = $this->penilaian_tanding_merah->where('jenis','pukulan')->where('aktif',true)->last();
        $this->tendangan_merah = $this->penilaian_tanding_merah->where('jenis','tendangan')->where('aktif',true)->last();
        $this->pukulan_biru = $this->penilaian_tanding_biru->where('jenis','pukulan')->where('aktif',true)->last();
        $this->tendangan_biru = $this->penilaian_tanding_biru->where('jenis','tendangan')->where('aktif',true)->last();
        if($this->mulai == true){
            $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }
    public function check_gelanggang()  {
        if($this->gelanggang->jenis !== "Tanding"){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
    }
    public function GantiBabakHandler($data){
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
    }

    public function peringatanHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    public function teguranHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    public function binaanHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    public function jatuhanHandler($data){
        if($data['sudut_id'] == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get(); 
        }else{
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get(); 
        };
    }
    public function pukulanHandler($data){
        if($data['sudut_id'] == $this->sudut_merah->id){
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get();
            $this->pukulan_merah = $this->penilaian_tanding_merah->where('jenis','pukulan')->where('aktif',true)->last();
        }else{
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get();        
            $this->pukulan_biru = $this->penilaian_tanding_biru->where('jenis','pukulan')->where('aktif',true)->last();
        };
    }
    public function tendanganHandler($data){
        if($data['sudut_id'] == $this->sudut_merah->id){
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->get();
            $this->tendangan_merah = $this->penilaian_tanding_merah->where('jenis','tendangan')->where('aktif',true)->last();
        }else{
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->get();        
            $this->tendangan_biru = $this->penilaian_tanding_biru->where('jenis','tendangan')->where('aktif',true)->last();
        };
    }
    public function mulaiPertandinganHandler($data){
        if($data["jadwal"]["id"] == $this->jadwal->id){
            if($data['event'] == 'mulai pertandingan'){
                $this->waktu = $data["waktu"];
                $this->mulai = true;
            }else if($data['event'] == 'pause pertandingan'){
                $this->mulai = false;
                $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
                $this->waktu = $data["waktu"];
            }else if($data['event'] == 'ganti jadwal gelanggang'){
                $this->mulai = false;
                return redirect('/penonton/'.$this->gelanggang->id);
            }
            $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
            $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
            $this->sudut_merah = $this->jadwal->PengundianTandingMerah->Tanding;
            $this->sudut_biru = $this->jadwal->PengundianTandingBiru->Tanding;
        }
    }

    public function GantiGelanggangHandler($data){
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
            return redirect('/penonton/'.$this->gelanggang->id);
        }
    }

    public function render()
    {
        return view('livewire.penonton-tanding')->extends('layouts.client.app')->section('content');
    }
}
