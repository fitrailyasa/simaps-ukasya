<?php

namespace App\Livewire;

use App\Events\Tanding\MulaiPertandingan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\Tanding\VerifikasiJatuhanEvent;
use App\Events\Tanding\VerifikasiPelanggaranEvent;
use App\Events\Tanding\TambahPeringatan;
use App\Events\Tanding\TambahTeguran;
use App\Events\Tanding\TambahJatuhan;
use App\Events\Tanding\TambahBinaan;
use App\Events\Tanding\GantiBabak;
use App\Events\Tanding\Hapus;
use App\Models\JadwalTanding;
use App\Models\Tanding;
use App\Models\Gelanggang;
use App\Models\PenilaianTanding;

class DewanTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $gelanggang;
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $verifikasi_jatuhan;
    public $verifikasi_jatuhan_data;
    public $verifikasi_pelanggaran;
    public $verifikasi_pelanggaran_data;
    public $created_at;
    public $error = "";
    public $mulai = false;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
        $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
    }
    public function hapusTrigger($id){
        if($this->jadwal->sudut_biru == $id){
            if(!$this->penilaian_tanding_biru->where('sudut',$id)->last()){
                $this->error = "Tidak bisa menghapus nilai kosong";
            }else{
                $this->penilaian_tanding_biru->where('sudut',$id)->last()->delete();
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            };
        }else{
            if(!$this->penilaian_tanding_merah->where('sudut',$id)->last()){
                $this->error = "Tidak bisa menghapus nilai kosong";
            }else{
                $this->penilaian_tanding_merah->where('sudut',$id)->last()->delete();
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            };
        }
    }
    public function tambahPeringatanTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            PenilaianTanding::create([
                'jenis'=>'peringatan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                'uuid'=>date('Ymd-His').'-'.$id.Auth::user()->id.'-'.$this->jadwal->id,
                'dewan' => -5,
                'status'=> 'sah',
                'aktif'=> false,
                'babak'=>$this->jadwal->babak_tanding
            ]);
    
            if($id == $this->jadwal->sudut_biru){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }
            
            TambahPeringatan::dispatch($id,$this->jadwal->babak_tanding);
        }else{
            $this->error = "pertandingan belum dimulai atau sedang di pause";
        }
    }
    public function tambahTeguranTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            $nilai = -1;
            if($id == $this->jadwal->sudut_biru){
                if(count($this->penilaian_tanding_biru->where('babak',$this->jadwal->babak_tanding)->where('jenis', 'teguran'))>=1){
                $nilai = -2;
                };
            }else{
                if(count($this->penilaian_tanding_merah->where('babak',$this->jadwal->babak_tanding)->where('jenis', 'teguran'))>=1){
                $nilai = -2;
                }
            }
            PenilaianTanding::create([
                'jenis'=>'teguran',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                'uuid'=>date('Ymd-His').'-'.$id.Auth::user()->id.'-'.$this->jadwal->id,
                'dewan' => $nilai,
                'status'=> 'sah',
                'aktif'=> false,
                'babak'=>$this->jadwal->babak_tanding
            ]);
    
            if($id == $this->jadwal->sudut_biru){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }
                   
            TambahTeguran::dispatch($id,$this->jadwal->babak_tanding);
        }else{
            $this->error = "pertandingan belum dimulai atau sedang di pause";
        }
    }
    public function tambahBinaanTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            PenilaianTanding::create([
                'jenis'=>'binaan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                'uuid'=>date('Ymd-His').'-'.$id.Auth::user()->id.'-'.$this->jadwal->id,
                'dewan' => 0,
                'status'=> 'sah',
                'aktif'=> false,
                'babak'=>$this->jadwal->babak_tanding
            ]);
    
            if($id == $this->jadwal->sudut_biru){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }
            
            TambahBinaan::dispatch($id,$this->jadwal->babak_tanding);
        }else{
            $this->error = "pertandingan belum dimulai atau sedang di pause";
        }
    }
    public function tambahJatuhanTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            PenilaianTanding::create([
                'jenis'=>'jatuhan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                'uuid'=>date('Ymd-His').'-'.$id.Auth::user()->id.'-'.$this->jadwal->id,
                'dewan' => 3,
                'status'=> 'sah',
                'aktif'=> false,
                'babak'=>$this->jadwal->babak_tanding
            ]);

            if($id == $this->jadwal->sudut_biru){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }
                    
            TambahJatuhan::dispatch($id,$this->jadwal->babak_tanding);
        }else{
            $this->error = "pertandingan belum dimulai atau sedang di pause";
        }  
    }
//operator start
    public function kurangiWaktu(){
        $this->gelanggang->waktu = ($this->gelanggang->waktu * 60 - 1) / 60;
        $this->gelanggang->save();
    } 
    public function keputusanMenang($sudut){
        $this->jadwal->tahap = 'hasil';
        $this->jadwal->pemenang = $sudut;
        $this->jadwal->save();
        MulaiPertandingan::dispatch('keputusan pemenang');
    }
    public function mulaiPertandingan(){
        //ganti dari persiapan ke mulai pertandingan
        $this->jadwal->tahap = 'tanding';
        $this->mulai = true;
        $this->jadwal->save();
        MulaiPertandingan::dispatch('mulai pertandingan');
    }

    public function pausePertandingan(){
        //ganti dari persiapan ke mulai pertandingan
        $this->jadwal->tahap = 'pause';
        $this->mulai = false;
        $this->jadwal->save();
        MulaiPertandingan::dispatch('pause pertandingan');
    }
    public function GantiBabakTrigger($babak){
        //ganti babak 
        if($this->jadwal->babak_tanding != $babak){
            $this->mulai = false;
            $this->gelanggang->waktu = 3;
            $this->gelanggang->save();
        }
        $this->jadwal->babak_tanding = $babak;
        $this->jadwal->save();   
        GantiBabak::dispatch($babak);
    }
//operator end
    public function VerifikasiJatuhanTrigger(){
        VerifikasiJatuhanEvent::dispatch($this->gelanggang->id,$this->jadwal->id,Auth::user()->id,null);
    }
    public function VerifikasiPelanggaranTrigger(){
        VerifikasiPelanggaranEvent::dispatch($this->gelanggang->id,$this->jadwal->id,Auth::user()->id,null);
    }

    #[On('echo:poin,.tambah-peringatan')]
    public function peringatanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-teguran')]
    public function teguranHandler(){
        ;
    }
    #[On('echo:poin,.tambah-binaan')]
    public function binaanHandler(){
        ;
    }
    #[On('echo:poin,.tambah-jatuhan')]
    public function jatuhanHandler(){
        ;
    }
    #[On('echo:poin,.hapus')]
    public function hapusHandler(){
        
    }
    #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler(){
        $this->recent = [[],[]];
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
    }
    #[On('echo:verifikasi,.verifikasi-jatuhan')]
    public function verifikasiJatuhanHandler($data){
       $this->verifikasi_jatuhan = $data;
       $this->verifikasi_jatuhan_data = json_decode($this->verifikasi_jatuhan['verifikasi_jatuhan']['data'], true);
       $this->created_at = Carbon::parse($data['verifikasi_jatuhan']['created_at'])->setTimezone('Asia/Jakarta')->format('d F Y H:i');
    }
    #[On('echo:verifikasi,.verifikasi-pelanggaran')]
    public function verifikasiPelanggaranHandler($data){
       $this->verifikasi_pelanggaran = $data;
       $this->verifikasi_pelanggaran_data = json_decode($this->verifikasi_pelanggaran['verifikasi_pelanggaran']['data'], true);
       $this->created_at = Carbon::parse($data['verifikasi_pelanggaran']['created_at'])->setTimezone('Asia/Jakarta')->format('d F Y H:i');
    }
    
    public function render()
    {
        return view('livewire.dewan-tanding')->extends('layouts.dewan.app')->section('content');
    }
}
