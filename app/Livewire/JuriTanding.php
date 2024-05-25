<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;
use App\Events\Tanding\TambahPukulan;
use App\Events\Tanding\TambahTendangan;
use App\Events\Tanding\VerifikasiJatuhanEvent;
use App\Events\Tanding\VerifikasiPelanggaranEvent;
use App\Events\Tanding\Hapus;




class JuriTanding extends Component
{
    public $jadwal;
    public $juri;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $error = "";
    public $verifikasi_jatuhan;
    public $verifikasi_pelanggaran;

    public function mount()
    {
        switch (Auth::user()->name) {
            case 'Juri A':
                $juri = 'juri_1';
                $this->juri = 'juri_1';
                break;
            case 'Juri B':
                $juri = 'juri_2';
                $this->juri = 'juri_2';
                break;
            case 'Juri C':
                $juri = 'juri_3';
                $this->juri = 'juri_3';
                break;
        }
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->jadwal->sudut_merah)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->jadwal->sudut_biru)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
    }

    public function hapusTrigger($id){
        $penilaian = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis', ['pukulan', 'tendangan'])->where('sudut',$id)->where('aktif',true)->orderBy('id', 'desc')->first();
        if(!$penilaian){
            $this->error ='tidak bisa menghapus nilai yang sudah masuk';
            Hapus::dispatch($penilaian,$this->juri);
        }else{
            $juri = $this->juri;
            $penilaian->$juri = null;
            $penilaian->save();
        };
        if($id == $this->jadwal->sudut_biru){
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->jadwal->sudut_biru)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        }else{
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->jadwal->sudut_merah)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        }
    }

    public function tambahPukulanTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            $penilaian_pukulan = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','pukulan')->where('sudut',$id)->where('aktif',true)->first();
            if($penilaian_pukulan == null){
                PenilaianTanding::create([
                'jenis'=>'pukulan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                'uuid'=>date('Ymd-His').'-'.$id.Auth::user()->id.'-'.$this->jadwal->id,
                $this->juri => 1,
                'babak'=>$this->jadwal->babak_tanding
            ]);
            }else{
                $juri =$this->juri;
                $penilaian_pukulan->$juri = 1;
                $penilaian_pukulan->save();
            };
            if($id == $this->jadwal->sudut_biru){
                $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->jadwal->sudut_biru)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
            }else{
                $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->jadwal->sudut_merah->where('jadwal_tanding',$this->jadwal->id))->whereIn($this->juri, [1, 2])->get();
            }
            TambahPukulan::dispatch($id);
        }
        
    }

    public function tambahTendanganTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            $penilaian_tendangan = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','tendangan')->where('sudut',$id)->where('aktif',true)->first();
            if($penilaian_tendangan==null){
                PenilaianTanding::create([
                'jenis'=>'tendangan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                'uuid'=>date('Ymd-His').'-'.$id.Auth::user()->id.'-'.$this->jadwal->id,
                $this->juri => 2,
                'babak'=>$this->jadwal->babak_tanding
            ]);
            }else{
                $juri =$this->juri;
                $penilaian_tendangan->$juri = 2;
                $penilaian_tendangan->save();
            };
            if($id == $this->jadwal->sudut_biru){
                $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->jadwal->sudut_biru)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
            }else{
                $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->jadwal->sudut_merah)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
            }
            TambahTendangan::dispatch($id);
        }
        
    }

    public function batasSkorMasukCek(){
        $penilaian_tendangan = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','tendangan')->where('aktif',true)->get();
        $penilaian_pukulan = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jadwal_tanding',$this->jadwal->id)->where('jenis','pukulan')->where('aktif',true)->get();

        foreach ($penilaian_pukulan as $penilaian) {
            if(strtotime(date('Y-m-d H:i:s')) - strtotime($penilaian->created_at)>=3){
            $penilaian->aktif = false;
            $penilaian->save();
            }else{
                if($penilaian->juri_1+$penilaian->juri_2+$penilaian->juri_3 >= 2){
                    $penilaian->status = 'sah';
                    $penilaian->save();
                };
            }
        }
        foreach ($penilaian_tendangan as $penilaian) {
            if(strtotime(date('Y-m-d H:i:s')) - strtotime($penilaian->created_at)>=3){
            $penilaian->aktif = false;
            $penilaian->save();
            }else{
                if($penilaian->juri_1+$penilaian->juri_2+$penilaian->juri_3 >= 4){
                    $penilaian->status = 'sah';
                    $penilaian->save();
                };
            }
        }
    }

    public function verifikasiJatuhanTrigger($verifikasi){
        VerifikasiJatuhanEvent::dispatch($this->gelanggang->id,$this->jadwal->id,Auth::user()->id,$verifikasi);
    }
    public function verifikasiPelanggaranTrigger($verifikasi){
        VerifikasiPelanggaranEvent::dispatch($this->gelanggang->id,$this->jadwal->id,Auth::user()->id,$verifikasi);
    }

    #[On('echo:verifikasi,.verifikasi-jatuhan')]
    public function verifikasiJatuhanHandler($data){
       $this->verifikasi_jatuhan = $data;
    }
    #[On('echo:verifikasi,.verifikasi-pelanggaran')]
    public function verifikasiPelanggaranHandler($data){
       $this->verifikasi_pelanggaran = $data;
    }
    #[On('echo:poin,.tambah-pukulan')]
    public function pukulanHandler(){
       
    }
    #[On('echo:poin,.tambah-tendangan')]
    public function tendanganHandler(){
       
    }
    #[On('echo:poin,.hapus')]
    public function hapusHandler(){
    }
     #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
        
    }
  
    public function render()
    {
        return view('livewire.juri-tanding',[
        'user'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
