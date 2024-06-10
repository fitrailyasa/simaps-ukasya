<?php

namespace App\Livewire\Juri;

use App\Models\PengundianTanding;
use App\Models\User;
use App\Models\VerifikasiJatuhan;
use App\Models\VerifikasiPelanggaran;
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
    public $juris;
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
        $this->gelanggang = Gelanggang::where('jenis','Tanding')->first();
        if(Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->juris= User::where('gelanggang',$this->gelanggang->id)->where('roles_id',4)->get();
        foreach ($this->juris as $index => $juri) {
            if($juri->permissions == Auth::user()->permissions){
                $this->juri = 'juri_'.$index + 1;
            };
        }
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $this->pengundian_biru = PengundianTanding::find($this->jadwal->sudut_biru);
        $this->pengundian_merah = PengundianTanding::find($this->jadwal->sudut_merah);
        $this->sudut_merah = Tanding::find($this->pengundian_merah->atlet_id);
        $this->sudut_biru = Tanding::find($this->pengundian_biru->atlet_id);
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
                $juri = $this->juri;
                $penilaian_pukulan->$juri = 1;
                $penilaian_pukulan->save();
            };
            if($id == $this->jadwal->sudut_biru){
                $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->jadwal->sudut_biru)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
            }else{
                $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->jadwal->sudut_merah)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
            }
            TambahPukulan::dispatch($id);
        }else{
            $this->error = "pertandingan belum dimulai atau sedang pause";
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
        }else{
            $this->error = "pertandingan belum dimulai atau sedang pause";
        }
        
    }

    public function batasSkorMasukCek(){
        $penilaian_tendangan = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jenis','tendangan')->where('aktif',true)->get();
        $penilaian_pukulan = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jenis','pukulan')->where('aktif',true)->get();

        foreach ($penilaian_pukulan as $penilaian) {
            if(strtotime(date('Y-m-d H:i:s')) - strtotime($penilaian->created_at)>=2){
                if($penilaian->juri_1 + $penilaian->juri_2 + $penilaian->juri_3 >= 2){
                    $penilaian->status = 'sah';
                    $penilaian->save();
                };
            $penilaian->aktif = false;
            $penilaian->save();
            }else{
                if($penilaian->juri_1 + $penilaian->juri_2 + $penilaian->juri_3 >= 2){
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
                if($penilaian->juri_1 + $penilaian->juri_2 + $penilaian->juri_3 >= 4){
                    $penilaian->status = 'sah';
                    $penilaian->save();
                };
            }
        }
    }

    public function verifikasiJatuhanTrigger($verifikasi){
                $verifikasi_jatuhan = VerifikasiJatuhan::where('jadwal_tanding',$this->jadwal->id)->where('status',1)->first();
                $this->user = User::where('id',Auth::user()->id)->first();
                $this->juri = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
                $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
                $juri_data = json_decode($verifikasi_jatuhan->data, true);
                $juri_data[$this->user->name] = $verifikasi;
                $verifikasi_jatuhan->data = json_encode($juri_data);
                $verifikasi_jatuhan->save();
                $allNotNull = true;
                foreach ($juri_data as $key => $value) {
                    if ($value == null) {
                        $allNotNull = false;
                        break;
                    }
                }
                if($allNotNull){
                    $biru = 0;
                    $merah = 0;
                    $invalid = 0;
                    foreach ($juri_data as $key => $value) {
                        if ($value == 'merah') {
                            $merah+=1;
                        }elseif($value == 'biru'){
                            $biru=+1;
                        }else{
                            $invalid+=1;
                        }
                    }
                    if($biru > $merah && $biru > $invalid){
                        PenilaianTanding::create([
                            'jenis'=>'jatuhan',
                            'sudut'=>$this->sudut_biru->id,
                            'jadwal_tanding'=>$this->jadwal->id,
                            'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->jadwal->id,
                            'dewan' => 3,
                            'status'=> 'sah',
                            'aktif'=> false,
                            'babak'=>$this->jadwal->babak_tanding
                        ]);
                    }elseif($merah > $biru && $merah > $invalid){
                        PenilaianTanding::create([
                            'jenis'=>'jatuhan',
                            'sudut'=>$this->sudut_merah->id,
                            'jadwal_tanding'=>$this->jadwal->id,
                            'uuid'=>date('Ymd-His').'-'.$this->sudut_merah->id.Auth::user()->id.'-'.$this->jadwal->id,
                            'dewan' => 3,
                            'status'=> 'sah',
                            'aktif'=> false,
                            'babak'=>$this->jadwal->babak_tanding
                        ]);                    }
                    $verifikasi_jatuhan->status = false;
                    $verifikasi_jatuhan->save();
                }
        VerifikasiJatuhanEvent::dispatch($verifikasi_jatuhan);
    }
    public function verifikasiPelanggaranTrigger($verifikasi){
        $verifikasi_pelanggaran = VerifikasiPelanggaran::where('jadwal_tanding',$this->jadwal->id)->where('status',1)->first();
                $this->user = User::where('id',Auth::user()->id)->first();
                $this->juri = User::where('roles_id',4)->where('gelanggang',$this->gelanggang->id)->get();
                $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
                $juri_data = json_decode($verifikasi_pelanggaran->data, true);
                $juri_data[$this->user->name] = $verifikasi;
                $verifikasi_pelanggaran->data = json_encode($juri_data);
                $verifikasi_pelanggaran->save();
                $allNotNull = true;
                foreach ($juri_data as $key => $value) {
                    if ($value == null) {
                        $allNotNull = false;
                        break;
                    }
                }
                if($allNotNull){
                    $biru = 0;
                    $merah = 0;
                    $invalid = 0;
                    foreach ($juri_data as $key => $value) {
                        if ($value == 'merah') {
                            $merah+=1;
                        }elseif($value == 'biru'){
                            $biru=+1;
                        }else{
                            $invalid+=1;
                        }
                    }
                    $nilai = -5;
                    if($biru > $merah && $biru > $invalid){
                        if(count($this->penilaian_tanding_biru->where('babak',$this->jadwal->babak_tanding)->where('jenis', 'peringatan'))>=1){
                        $nilai = -10;
                        }
                        PenilaianTanding::create([
                            'jenis'=>'peringatan',
                            'sudut'=>$this->sudut_biru->id,
                            'jadwal_tanding'=>$this->jadwal->id,
                            'uuid'=>date('Ymd-His').'-'.$this->sudut_biru->id.Auth::user()->id.'-'.$this->jadwal->id,
                            'dewan' => $nilai,
                            'status'=> 'sah',
                            'aktif'=> false,
                            'babak'=>$this->jadwal->babak_tanding
                        ]);
                    }elseif($merah > $biru && $merah > $invalid){
                        if(count($this->penilaian_tanding_merah->where('babak',$this->jadwal->babak_tanding)->where('jenis', 'peringatan'))>=1){
                        $nilai = -10;
                        }
                        PenilaianTanding::create([
                            'jenis'=>'peringatan',
                            'sudut'=>$this->sudut_merah->id,
                            'jadwal_tanding'=>$this->jadwal->id,
                            'uuid'=>date('Ymd-His').'-'.$this->sudut_merah->id.Auth::user()->id.'-'.$this->jadwal->id,
                            'dewan' => $nilai,
                            'status'=> 'sah',
                            'aktif'=> false,
                            'babak'=>$this->jadwal->babak_tanding
                        ]);                    }
                    $verifikasi_pelanggaran->status = false;
                    $verifikasi_pelanggaran->save();
                }
        VerifikasiPelanggaranEvent::dispatch($verifikasi_pelanggaran);
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
