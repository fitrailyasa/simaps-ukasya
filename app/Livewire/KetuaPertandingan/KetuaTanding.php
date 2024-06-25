<?php

namespace App\Livewire\KetuaPertandingan;
use App\Models\User;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;
use App\Models\PenilaianJuri;
use Livewire\Attributes\On;

use Livewire\Component;

class KetuaTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $juris;
    public $gelanggang;
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $waktu;
    public $tahap = "";
    public $mulai = false;
    public $poin_merah;
    public $poin_biru;
    public $peringatan_biru;
    public $peringatan_merah;
    public $pengundian_merah;
    public $pengundian_biru;
    public $show;

    public $jadwal_id;

        
    public function mount($gelanggang_id){
        $this->gelanggang = Gelanggang::find($gelanggang_id);
        if($this->gelanggang->jenis != "Tanding"){
            return redirect('/ketuapertandingan/'.$this->gelanggang->id);
        }
        $this->juris = User::where('gelanggang', $this->gelanggang->id)->where('roles_id',4)->where('status',true)->whereIn('permissions',["Juri 1","Juri 2","Juri 3"])->get();
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/ketua/'.$this->gelanggang->id);
        }
        $this->jadwal_id = $this->jadwal->id;
        $this->tahap = $this->jadwal->tahap;
        $this->waktu = 0;
        $this->pengundian_merah = $this->jadwal->PengundianTandingMerah;
        $this->pengundian_biru = $this->jadwal->PengundianTandingBiru;
        $this->sudut_merah = $this->jadwal->PengundianTandingMerah->Tanding;
        $this->sudut_biru = $this->jadwal->PengundianTandingBiru->Tanding;
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
        $this->peringatan_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','peringatan')->get();
        $this->peringatan_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','peringatan')->get();  
        $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
        if($this->jadwal->tahap == "hasil"){
            $this->show = true;
        }
    }

    public function ubahShow(){
        $this->show = false;
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
             $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
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


    public function peringatanHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
            $this->peringatan_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','peringatan')->get();
        $this->peringatan_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','peringatan')->get();  
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
        }
    }
    public function teguranHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
        }
    }
    public function binaanHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
        }
    }
    public function jatuhanHandler($data){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
        $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
        $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
    }
    public function pukulanHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
        }
    }
    public function tendanganHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
        }
    }
    
    public function mulaiPertandinganHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
            if($data['event'] == 'mulai pertandingan'){
                $this->mulai = true;
            }else if($data['event'] == 'pause pertandingan'){
                $this->mulai = false;
                $this->waktu = $data['waktu'];
            }else if($data['event'] == 'keputusan pemenang'){
                $this->tahap = 'hasil';
                $this->show = true;
            }else{
                $this->mulai = false;
            }
        }
    }
    public function gantiBabakHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->waktu = 0;
            $this->mulai = false;
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->where('babak',$this->jadwal->babak_tanding)->get();  
            $this->poin_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->get();
            $this->poin_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->get();  
        }
    }

    public function GantiGelanggangHandler($data){
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
            return redirect('/ketuapertandingan/'.$this->gelanggang->id);
        }
    }
    public function render()
    {
        return view('livewire.Tanding.ketua-tanding')->extends('layouts.client.app')->section('content');
    }
}
