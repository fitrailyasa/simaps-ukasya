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
use App\Models\PenilaianJuri;
use App\Events\Tanding\TambahPukulan;
use App\Events\Tanding\TambahTendangan;
use App\Events\Tanding\Hapus;
use App\Events\Tanding\VerifikasiJatuhanEvent;
use App\Events\Tanding\VerifikasiPelanggaranEvent;
use App\Events\Tanding\PenilaianJuriEvent;




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
    public $penilaian_juri_merah;
    public $penilaian_juri_biru;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah = PenilaianTanding::where('atlet',$this->jadwal->sudut_merah)->where('babak',$this->jadwal->babak_tanding)->first();
        $this->penilaian_tanding_biru= PenilaianTanding::where('atlet',$this->sudut_biru->id)->where('babak',$this->jadwal->babak_tanding)->first();
        $this->tendangan_sent_biru = TendanganEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_biru)->first();
        $this->tendangan_sent_merah = TendanganEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_merah)->first();
        $this->pukulan_sent_biru = PukulanEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_biru)->first();
        $this->pukulan_sent_merah = PukulanEventSent::where('jadwal_tanding',$this->jadwal->id)->where('sudut',$this->jadwal->sudut_merah)->first();
        $this->penilaian_juri_merah = PenilaianJuri::where('juri',Auth::user()->id)->where('sudut',$this->jadwal->sudut_merah)->first();
        $this->penilaian_juri_biru = PenilaianJuri::where('juri',Auth::user()->id)->where('sudut',$this->jadwal->sudut_biru)->first();
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
                TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                array_pop($this->last);
            }else{
                $this->pukulan_sent_merah->decrement('event_sent');
                array_pop($this->last);
                TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
            }
        }else{
            if(end($this->last) == 'tendangan'){
                $this->tendangan_sent_biru->decrement('event_sent');
                TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                array_pop($this->last);
            }else{
                $this->pukulan_sent_biru->decrement('event_sent');
                array_pop($this->last);
                TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
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
                    TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                }else{
                    if(time()-$this->pukulan_merah_time< 3){
                        $this->pukulan_sent_merah->increment('event_sent');
                        TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                    }else{
                        if($this->pukulan_sent_merah->event_sent >= 2 ){
                            if(json_decode($this->penilaian_tanding_merah->skor) == null){
                                $nilai_tanding = [];
                                array_push($nilai_tanding,'1');
                                $this->penilaian_tanding_merah->skor = json_encode($nilai_tanding);
                            }else{
                                $nilai_tanding = json_decode($this->penilaian_tanding_merah->skor);
                                array_push($nilai_tanding,'1');
                                $this->penilaian_tanding_merah->skor = json_encode($nilai_tanding);
                            }
                            $this->penilaian_tanding_merah->save();
                            $this->penilaian_tanding_merah->increment('pukulan');
                            $this->pukulan_handler_merah = !$this->pukulan_handler_merah;
                            TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                            $this->pukulan_sent_merah->event_sent = 0;
                            $this->pukulan_sent_merah->save();
                        }else{
                            $this->pukulan_handler_merah = !$this->pukulan_handler_merah;
                            TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_merah,$this->pukulan_handler_merah);
                            $this->pukulan_sent_merah->event_sent = 0;
                            $this->pukulan_sent_merah->save();
                        }
                    }
                }
            }elseif($id == $this->sudut_biru->id){
                if($this->pukulan_handler_biru == false){
                    $this->pukulan_biru_time = time();
                    $this->pukulan_handler_biru = !$this->pukulan_handler_biru;
                    $this->pukulan_sent_biru->increment('event_sent');
                    TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                }else{
                    if(time()-$this->pukulan_biru_time< 3){
                        $this->pukulan_sent_biru->increment('event_sent');
                        TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                    }else{
                        if($this->pukulan_sent_biru->event_sent >= 2 ){
                            if(json_decode($this->penilaian_tanding_biru->skor) == null){
                                $nilai_tanding = [];
                                array_push($nilai_tanding,'1');
                                $this->penilaian_tanding_biru->skor = json_encode($nilai_tanding);
                            }else{
                                $nilai_tanding = json_decode($this->penilaian_tanding_biru->skor);
                                array_push($nilai_tanding,'1');
                                $this->penilaian_tanding_biru->skor = json_encode($nilai_tanding);
                            }
                            $this->penilaian_tanding_biru->save();
                            $this->penilaian_tanding_biru->increment('pukulan');
                            $this->pukulan_handler_biru = !$this->pukulan_handler_biru;
                            TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                            $this->pukulan_sent_biru->event_sent = 0;
                            $this->pukulan_sent_biru->save();
                        }else{
                            $this->pukulan_handler_biru = !$this->pukulan_handler_biru;
                            TambahPukulan::dispatch($id,Auth::user()->id,$this->pukulan_sent_biru,$this->pukulan_handler_biru);
                            $this->pukulan_sent_biru->event_sent = 0;
                            $this->pukulan_sent_biru->save();
                        }
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
                    TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                }else{
                    if(time()-$this->tendangan_merah_time< 3){
                        $this->tendangan_sent_merah->increment('event_sent');
                        TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                    }else{
                        if($this->tendangan_sent_merah->event_sent >= 2 ){
                            if(json_decode($this->penilaian_tanding_merah->skor) == null){
                                $nilai_tanding = [];
                                array_push($nilai_tanding,'2');
                                $this->penilaian_tanding_merah->skor = json_encode($nilai_tanding);
                            }else{
                                $nilai_tanding = json_decode($this->penilaian_tanding_merah->skor);
                                array_push($nilai_tanding,'2');
                                $this->penilaian_tanding_merah->skor = json_encode($nilai_tanding);
                            }
                            $this->penilaian_tanding_merah->save();
                            $this->penilaian_tanding_merah->increment('tendangan');
                            $this->tendangan_handler_merah = !$this->tendangan_handler_merah;
                            TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                            $this->tendangan_sent_merah->event_sent = 0;
                            $this->tendangan_sent_merah->save();
                        }else{
                            $this->tendangan_handler_merah = !$this->tendangan_handler_merah;
                            TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_merah,$this->tendangan_handler_merah);
                            $this->tendangan_sent_merah->event_sent = 0;
                            $this->tendangan_sent_merah->save();
                        }
                    }
                }
            }elseif($id == $this->sudut_biru->id){
                if($this->tendangan_handler_biru == false){
                    $this->tendangan_biru_time = time();
                    $this->tendangan_handler_biru = !$this->tendangan_handler_biru;
                    $this->tendangan_sent_biru->increment('event_sent');
                    TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                }else{
                    if(time()-$this->tendangan_biru_time< 3){
                        $this->tendangan_sent_biru->increment('event_sent');
                        TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                    }else{
                        if($this->tendangan_sent_biru->event_sent >= 2 ){
                            if(json_decode($this->penilaian_tanding_biru->skor) == null){
                                $nilai_tanding = [];
                                array_push($nilai_tanding,'2');
                                $this->penilaian_tanding_biru->skor = json_encode($nilai_tanding);
                            }else{
                                $nilai_tanding = json_decode($this->penilaian_tanding_biru->skor);
                                array_push($nilai_tanding,'2');
                                $this->penilaian_tanding_biru->skor = json_encode($nilai_tanding);
                            }
                            $this->penilaian_tanding_biru->save();
                            $this->penilaian_tanding_biru->increment('tendangan');
                            $this->tendangan_handler_biru = !$this->tendangan_handler_biru;
                            TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                            $this->tendangan_sent_biru->event_sent = 0;
                            $this->tendangan_sent_biru->save();
                        }else{
                            $this->tendangan_handler_biru = !$this->tendangan_handler_biru;
                            TambahTendangan::dispatch($id,Auth::user()->id,$this->tendangan_sent_biru,$this->tendangan_handler_biru);
                            $this->tendangan_sent_biru->event_sent = 0;
                            $this->tendangan_sent_biru->save();
                        }
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
    public function pukulanHandler($data){
        if($data['status'] == false){
            if($data['eventSent'] >= 2){
                if($data['sudut_id']==$this->jadwal->sudut_merah){
                    if(json_decode($this->penilaian_juri_merah->data) == null){
                        $nilai_juri_merah = [];
                        array_push($nilai_juri_merah,'1_in');                   
                    }else{
                        $nilai_juri_merah = json_decode($this->penilaian_juri_merah->data);
                        array_push($nilai_juri_merah,'1_in');
                    }   
                    $this->penilaian_juri_merah->data = json_encode($nilai_juri_merah);
                    $this->penilaian_juri_merah->save();
                }elseif($data['sudut_id']==$this->jadwal->sudut_biru){
                    if(json_decode($this->penilaian_juri_biru->data) == null){
                        $nilai_juri_biru = [];
                        array_push($nilai_juri_biru,'1_in');                   
                    }else{
                        $nilai_juri_biru = json_decode($this->penilaian_juri_biru->data);
                        array_push($nilai_juri_biru,'1_in');
                    }
                    $this->penilaian_juri_biru->data = json_encode($nilai_juri_biru);
                    $this->penilaian_juri_biru->save();
                }
            }else{
                if($data['sudut_id']==$this->jadwal->sudut_merah && $data['juri_id']==Auth::user()->id){
                    if(json_decode($this->penilaian_juri_merah->data) == null){
                        $nilai_juri_merah = [];
                        array_push($nilai_juri_merah,'1_out');                   
                    }else{
                        $nilai_juri_merah = json_decode($this->penilaian_juri_merah->data);
                        array_push($nilai_juri_merah,'1_out');
                    }
                    $this->penilaian_juri_merah->data = json_encode($nilai_juri_merah);
                    $this->penilaian_juri_merah->save();
                }elseif($data['sudut_id']==$this->jadwal->sudut_biru && $data['juri_id']==Auth::user()->id){
                    if(json_decode($this->penilaian_juri_biru->data) == null){
                        $nilai_juri_biru = [];
                        array_push($nilai_juri_biru,'1_out');                   
                    }else{
                        $nilai_juri_biru = json_decode($this->penilaian_juri_biru->data);
                        array_push($nilai_juri_biru,'1_out');
                    }
                    $this->penilaian_juri_biru->data = json_encode($nilai_juri_biru);
                    $this->penilaian_juri_biru->save();
                }
            }
        }
        PenilaianJuriEvent::dispatch();

    }
    #[On('echo:poin,.tambah-tendangan')]
    public function tendanganHandler($data){
        if($data['status'] == false){
            if($data['eventSent'] >= 2){
                if($data['sudut_id']==$this->jadwal->sudut_merah){
                    if(json_decode($this->penilaian_juri_merah->data) == null){
                        $nilai_juri_merah = [];
                        array_push($nilai_juri_merah,'2_in');                   
                    }else{
                        $nilai_juri_merah = json_decode($this->penilaian_juri_merah->data);
                        array_push($nilai_juri_merah,'2_in');
                    }
                    $this->penilaian_juri_merah->data = json_encode($nilai_juri_merah);
                    $this->penilaian_juri_merah->save();
                }elseif($data['sudut_id']==$this->jadwal->sudut_biru){
                    if(json_decode($this->penilaian_juri_biru->data) == null){
                        $nilai_juri_biru = [];
                        array_push($nilai_juri_biru,'2_in');                   
                    }else{
                        $nilai_juri_biru = json_decode($this->penilaian_juri_biru->data);
                        array_push($nilai_juri_biru,'2_in');
                    }
                    $this->penilaian_juri_biru->data = json_encode($nilai_juri_biru);
                    $this->penilaian_juri_biru->save();
                }
            }else{
                if($data['sudut_id']==$this->jadwal->sudut_merah && $data['juri_id']==Auth::user()->id){
                    if(json_decode($this->penilaian_juri_merah->data) == null){
                        $nilai_juri_merah = [];
                        array_push($nilai_juri_merah,'2_out');                   
                    }else{
                        $nilai_juri_merah = json_decode($this->penilaian_juri_merah->data);
                        array_push($nilai_juri_merah,'2_out');
                    }
                    $this->penilaian_juri_merah->data = json_encode($nilai_juri_merah);
                    $this->penilaian_juri_merah->save();
                }elseif($data['sudut_id']==$this->jadwal->sudut_biru && $data['juri_id']==Auth::user()->id){
                    if(json_decode($this->penilaian_juri_biru->data) == null){
                        $nilai_juri_biru = [];
                        array_push($nilai_juri_biru,'2_out');                   
                    }else{
                        $nilai_juri_biru = json_decode($this->penilaian_juri_biru->data);
                        array_push($nilai_juri_biru,'2_out');
                    }
                    $this->penilaian_juri_biru->data = json_encode($nilai_juri_biru);
                    $this->penilaian_juri_biru->save();
                }
            }
        }
        PenilaianJuriEvent::dispatch();
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
        'juri'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
