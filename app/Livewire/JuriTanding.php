<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\TendanganEventSent;
use App\Models\PukulanEventSent;
use App\Models\PenilaianTanding;
use App\Events\Tanding\TambahPukulan;
use App\Events\Tanding\TambahTendangan;
use App\Events\Tanding\Hapus;
use App\Events\Tanding\VerifikasiJatuhanEvent;
use App\Events\Tanding\VerifikasiPelanggaranEvent;



class JuriTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $last=[];
    public $tendangan_sent_biru;
    public $tendangan_sent_merah;
    public $pukulan_sent_biru;
    public $pukulan_sent_merah;
    public $tendangan_handler;
    public $pukulan_handler;
    public $tendangan_handler_merah = false;
    public $tendangan_handler_biru = false;
    public $pukulan_handler_merah = false;
    public $pukulan_handler_biru = false;
    public $tendangan_merah_time;
    public $tendangan_biru_time;
    public $pukulan_merah_time;
    public $pukulan_biru_time;
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $babak_1_sudut_merah = [];
    public $babak_2_sudut_merah = [];
    public $babak_3_sudut_merah = [];
    public $babak_1_sudut_biru = [];
    public $babak_2_sudut_biru = [];
    public $babak_3_sudut_biru = [];
    public $verifikasi_jatuhan;
    public $verifikasi_pelanggaran;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah = PenilaianTanding::where('atlet',$this->jadwal->sudut_merah)->first();
        $this->penilaian_tanding_biru = PenilaianTanding::where('atlet',$this->jadwal->sudut_biru)->first();
        $this->tendangan_sent_biru = TendanganEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_biru)->first();
        $this->tendangan_sent_merah = TendanganEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_merah)->first();
        $this->pukulan_sent_biru = PukulanEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_biru)->first();
        $this->pukulan_sent_merah = PukulanEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_merah)->first();
    }

    public function hapusTrigger($id){
        switch ($this->jadwal->babak_tanding) {
            case 1:
                if($id == $this->sudut_merah->id){
                    array_pop($this->babak_1_sudut_merah);
                }else{
                    array_pop($this->babak_1_sudut_biru);
                }
                break;
            
            case 2:
               if($id == $this->sudut_merah->id){
                    array_pop($this->babak_2_sudut_merah);
                }else{
                    array_pop($this->babak_2_sudut_biru);
                }
                break;
            case 3:
                if($id == $this->sudut_merah->id){
                    array_pop($this->babak_3_sudut_merah);
                }else{
                    array_pop($this->babak_3_sudut_biru);
                }
                break;
        }
        if($id == $this->sudut_merah->id){
            if(end($this->last) == 'tendangan'){
                $this->tendangan_sent_merah->decrement('event_sent');
                TambahTendangan::dispatch($id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                array_pop($this->last);
            }else{
                $this->pukulan_sent_merah->decrement('event_sent');
                array_pop($this->last);
                TambahPukulan::dispatch($id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
            }
        }else{
            if(end($this->last) == 'tendangan'){
                $this->tendangan_sent_biru->decrement('event_sent');
                TambahTendangan::dispatch($id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                array_pop($this->last);
            }else{
                $this->pukulan_sent_biru->decrement('event_sent');
                array_pop($this->last);
                TambahPukulan::dispatch($id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
            }
        }
        
    }

    public function tambahPukulanTrigger($id){
       array_push($this->last,'pukulan');
        switch ($this->jadwal->babak_tanding) {
            case 1:
               if($id == $this->sudut_merah->id){
                    array_push($this->babak_1_sudut_merah , '1');
                }else{
                    array_push($this->babak_1_sudut_biru , '1');
                }
                break;
            
            case 2:
               if($id == $this->sudut_merah->id){
                    array_push($this->babak_2_sudut_merah , '1');
                }else{
                    array_push($this->babak_2_sudut_biru , '1');
                }
                break;
            case 3:
                if($id == $this->sudut_merah->id){
                    array_push($this->babak_3_sudut_merah , '1');
                }else{
                    array_push($this->babak_3_sudut_biru , '1');
                }
                break;
        }
        if($id == $this->sudut_merah->id){
                if($this->pukulan_handler_merah == false){
                    $this->pukulan_merah_time = time();
                    $this->pukulan_handler_merah = !$this->pukulan_handler_merah;
                    $this->pukulan_sent_merah->increment('event_sent');
                    TambahPukulan::dispatch($id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                }else{
                    if(time()-$this->pukulan_merah_time< 3){
                        $this->pukulan_sent_merah->increment('event_sent');
                        TambahPukulan::dispatch($id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                    }else{
                        if($this->pukulan_sent_merah->event_sent >= 2 ){
                            $this->penilaian_tanding_merah->increment('pukulan');
                            TambahPukulan::dispatch($id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                            $this->pukulan_sent_merah->event_sent = 0;
                            $this->pukulan_sent_merah->save();
                            $this->pukulan_handler_merah = !$this->pukulan_handler_merah;
                        }else{
                            TambahPukulan::dispatch($id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                            $this->pukulan_sent_merah->event_sent = 0;
                            $this->pukulan_sent_merah->save();
                            $this->pukulan_handler_merah = !$this->pukulan_handler_merah;
                        }
                    }
                }
            }else{
                if($this->pukulan_handler_biru == false){
                    $this->pukulan_biru_time = time();
                    $this->pukulan_handler_biru = !$this->pukulan_handler_biru;
                    $this->pukulan_sent_biru->increment('event_sent');
                    TambahPukulan::dispatch($id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                }else{
                    if(time()-$this->pukulan_biru_time< 3){
                        $this->pukulan_sent_biru->increment('event_sent');
                        TambahPukulan::dispatch($id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                    }else{
                        if($this->pukulan_sent_biru->event_sent >= 2 ){
                            $this->penilaian_tanding_biru->increment('pukulan');
                            TambahPukulan::dispatch($id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                            $this->pukulan_sent_biru->event_sent = 0;
                            $this->pukulan_sent_biru->save();
                            $this->pukulan_handler_biru = !$this->pukulan_handler_biru;
                        }else{
                            TambahPukulan::dispatch($id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                            $this->pukulan_sent_biru->event_sent = 0;
                            $this->pukulan_sent_biru->save();
                            $this->pukulan_handler_biru = !$this->pukulan_handler_biru;                        }
                    }
                }
            } 
    }

    public function tambahTendanganTrigger($id){
        array_push($this->last,'tendangan');
        switch ($this->jadwal->babak_tanding) {
            case 1:
               if($id == $this->sudut_merah->id){
                    array_push($this->babak_1_sudut_merah , '2');
                }else{
                    array_push($this->babak_1_sudut_biru , '2');
                }
                break;
            
            case 2:
               if($id == $this->sudut_merah->id){
                    array_push($this->babak_2_sudut_merah , '2');
                }else{
                    array_push($this->babak_2_sudut_biru , '2');
                }
                break;
            case 3:
                if($id == $this->sudut_merah->id){
                    array_push($this->babak_3_sudut_merah , '2');
                }else{
                    array_push($this->babak_3_sudut_biru , '2');
                }
                break;
        }
        if($id == $this->sudut_merah->id){
                if($this->tendangan_handler_merah == false){
                    $this->tendangan_merah_time = time();
                    $this->tendangan_handler_merah = !$this->tendangan_handler_merah;
                    $this->tendangan_sent_merah->increment('event_sent');
                    TambahTendangan::dispatch($id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                }else{
                    if(time()-$this->tendangan_merah_time< 3){
                        $this->tendangan_sent_merah->increment('event_sent');
                        TambahTendangan::dispatch($id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                    }else{
                        if($this->tendangan_sent_merah->event_sent >= 2 ){
                            $this->penilaian_tanding_merah->increment('tendangan');
                            TambahTendangan::dispatch($id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                            $this->tendangan_sent_merah->event_sent = 0;
                            $this->tendangan_sent_merah->save();
                            $this->tendangan_handler_merah = !$this->tendangan_handler_merah;
                        }else{
                            TambahTendangan::dispatch($id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                            $this->tendangan_sent_merah->event_sent = 0;
                            $this->tendangan_sent_merah->save();
                            $this->tendangan_handler_merah = !$this->tendangan_handler_merah;
                        }
                    }
                }
            }else{
                if($this->tendangan_handler_biru == false){
                    $this->tendangan_biru_time = time();
                    $this->tendangan_handler_biru = !$this->tendangan_handler_biru;
                    $this->tendangan_sent_biru->increment('event_sent');
                    TambahTendangan::dispatch($id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                }else{
                    if(time()-$this->tendangan_biru_time< 3){
                        $this->tendangan_sent_biru->increment('event_sent');
                        TambahTendangan::dispatch($id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                    }else{
                        if($this->tendangan_sent_biru->event_sent >= 2 ){
                            $this->penilaian_tanding_biru->increment('tendangan');
                            TambahTendangan::dispatch($id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                            $this->tendangan_sent_biru->event_sent = 0;
                            $this->tendangan_sent_biru->save();
                            $this->tendangan_handler_biru = !$this->tendangan_handler_biru;
                        }else{
                            TambahTendangan::dispatch($id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                            $this->tendangan_sent_biru->event_sent = 0;
                            $this->tendangan_sent_biru->save();
                            $this->tendangan_handler_biru = !$this->tendangan_handler_biru;                        }
                    }
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
        ;
    }
  
    public function render()
    {
        return view('livewire.juri-tanding',[
        'juri'=>Auth::user(),
        'gelanggang'=>$this->gelanggang,
        'jadwal'=> $this->jadwal,
        'sudut_merah'=>$this->sudut_merah,
        'sudut_biru'=>$this->sudut_biru,
        'penilaian_tanding_biru'=>$this->penilaian_tanding_biru,
        'penilaian_tanding_merah'=>$this->penilaian_tanding_merah,
        'babak_1_sudut_merah'=>$this->babak_1_sudut_merah,
        'babak_2_sudut_merah'=>$this->babak_2_sudut_merah,
        'babak_3_sudut_merah'=>$this->babak_3_sudut_merah,
        'babak_1_sudut_biru'=>$this->babak_1_sudut_biru,
        'babak_2_sudut_biru'=>$this->babak_2_sudut_biru,
        'babak_3_sudut_biru'=>$this->babak_3_sudut_biru,
        ])->extends('layouts.juri.app')->section('content');
    }
}
