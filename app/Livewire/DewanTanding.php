<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\Tanding\VerifikasiPelanggaran;
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
    public $recent = [[],[]];
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $verifikasi_jatuhan;
    public $verifikasi_jatuhan_data;
    public $verifikasi_pelanggaran;
    public $verifikasi_pelanggaran_data;
    public $created_at;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal_tanding);
        $this->sudut_merah = Tanding::find($this->jadwal->sudut_merah);
        $this->sudut_biru = Tanding::find($this->jadwal->sudut_biru);
        $this->penilaian_tanding_merah= PenilaianTanding::where('atlet',$this->sudut_merah->id)->get();
        $this->penilaian_tanding_biru= PenilaianTanding::where('atlet',$this->sudut_biru->id)->get();    
    }
    public function hapusTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        Hapus::dispatch($id,end($this->recent[0]),$this->jadwal->babak_tanding);
        }else{
        Hapus::dispatch($id,end($this->recent[1]),$this->jadwal->babak_tanding);           
        }
        array_pop($this->recent);
    }
    public function tambahPeringatanTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'peringatan');
        }else{
        array_push($this->recent[1],'peringatan');           
        }
        
        TambahPeringatan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahTeguranTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'teguran');
        }else{
        array_push($this->recent[1],'teguran');           
        }        
        TambahTeguran::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahBinaanTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'binaan');
        }else{
        array_push($this->recent[1],'binaan');           
        }
        TambahBinaan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function tambahJatuhanTrigger($id){
        if($id == $this->jadwal->sudut_merah){
        array_push($this->recent[0],'jatuhan');
        }else{
        array_push($this->recent[1],'jatuhan');           
        }        
        TambahJatuhan::dispatch($id,$this->jadwal->babak_tanding);
    }
    public function GantiBabakTrigger($id){
        GantiBabak::dispatch($id);
    }

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
