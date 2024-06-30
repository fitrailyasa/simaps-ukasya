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
    public $pilihan;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if($this->gelanggang->jenis != "Tanding"){
            return redirect('auth');
        }
        $this->juris= User::where('gelanggang',$this->gelanggang->id)->where('roles_id',4)->get();
        $validPermissions = ["Juri 1", "Juri 2", "Juri 3"];
        if (!in_array(Auth::user()->permissions, $validPermissions)) {
            return redirect('jadwal/juri/'.$this->gelanggang->id);
        }
        foreach ($this->juris as $index => $juri) {
            if($juri->permissions == Auth::user()->permissions){
                $this->juri = 'juri_'.$index + 1;
            };
        }
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        if(!$this->jadwal){
            return redirect('/jadwal/juri/'.$this->gelanggang->id);
        }
        $this->pengundian_biru = $this->jadwal->PengundianTandingBiru;
        $this->pengundian_merah = $this->jadwal->PengundianTandingMerah;
        $this->sudut_merah = $this->jadwal->PengundianTandingMerah->Tanding;
        $this->sudut_biru = $this->jadwal->PengundianTandingBiru->Tanding;
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
    }

    public function getListeners()
    {
        return [
            "echo:poin-{$this->jadwal->id},.tambah-pukulan" => 'pukulanHandler',
            "echo:poin-{$this->jadwal->id},.tambah-tendangan" => 'tendanganHandler',
            "echo:poin-{$this->jadwal->id},.hapus" => 'hapusHandler',
            "echo:arena-{$this->jadwal->id},.ganti-babak" => 'gantiBabakHandler',
           "echo:gelanggang-{$this->gelanggang->id},.ganti-gelanggang" => 'gantiGelanggangHandler',            
           "echo:verifikasi-{$this->jadwal->id},.verifikasi-jatuhan" => 'verifikasiJatuhanHandler',
            "echo:verifikasi-{$this->jadwal->id},.verifikasi-pelanggaran" => 'verifikasiPelanggaranHandler',
        ];
    }

    public function hapusTrigger($id){
        $penilaian = PenilaianTanding::where('jadwal_tanding',$this->jadwal->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis', ['pukulan', 'tendangan'])->where('sudut',$id)->where('aktif',true)->orderBy('id', 'desc')->first();
        if(!$penilaian){
            $this->error ='tidak bisa menghapus nilai yang sudah masuk';
        }else{
            $juri = $this->juri;
            $penilaian->$juri = 0;
            $penilaian->save();
        };
        if($id == $this->sudut_biru->id){
            $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        }else{
            $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        }
    }

    public function tambahPukulanTrigger($id){
            $juri = $this->juri;
            $babak = $this->jadwal->babak_tanding;

            // Check if the juri has already submitted a tendangan score for this sudut in the current babak
            $existing_penilaian = PenilaianTanding::where('jadwal_tanding', $this->jadwal->id)
                ->where('sudut', $id)
                ->where('jenis', 'pukulan')
                ->where('babak', $babak)
                ->where($juri, 0) // Changed to check for non-zero score
                ->where('aktif', true)
                ->first();
            if (!$existing_penilaian) {
                PenilaianTanding::create([
                'jenis'=>'pukulan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                $this->juri => 1,
                'babak'=>$this->jadwal->babak_tanding,
                'aktif' => true
            ]);
            }else{
                $juri = $this->juri;
                $existing_penilaian->$juri = 1;
                $existing_penilaian->save();
            };
            if($id == $this->sudut_biru->id){
                $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
                TambahPukulan::dispatch($this->sudut_biru->id,$this->jadwal);
            }else{
                $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
                TambahPukulan::dispatch($this->sudut_merah->id,$this->jadwal);
            }
    }

    public function tambahTendanganTrigger($id){
            $juri = $this->juri;
            $babak = $this->jadwal->babak_tanding;

            // Check if the juri has already submitted a tendangan score for this sudut in the current babak
            $existing_penilaian = PenilaianTanding::where('jadwal_tanding', $this->jadwal->id)
                ->where('sudut', $id)
                ->where('jenis', 'tendangan')
                ->where('babak', $babak)
                ->where($juri, 0) // Changed to check for non-zero score
                ->where('aktif', true)
                ->first();
            if (!$existing_penilaian) {
                PenilaianTanding::create([
                'jenis'=>'tendangan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                $this->juri => 2,
                'babak'=>$this->jadwal->babak_tanding,
                'aktif' => true
            ]);
            }else{
                $juri =$this->juri;
                $existing_penilaian->$juri = 2;
                $existing_penilaian->save();
            };
            
            if($id == $this->sudut_biru->id){
                $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
                TambahTendangan::dispatch($this->sudut_biru->id,$this->jadwal);
            }else{
                $this->penilaian_tanding_merah = PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
                TambahTendangan::dispatch($this->sudut_merah->id,$this->jadwal);
            }
    }


    public function verifikasiJatuhanTrigger($verifikasi){
        $this->pilihan = $verifikasi;
        $verifikasi_jatuhan = VerifikasiJatuhan::where('jadwal_tanding', $this->jadwal->id)
        ->where('status', 1)
        ->orderBy('created_at', 'desc') // Misalnya menggunakan 'created_at' atau kolom lain yang relevan
        ->first();
        $this->user = User::where('id',Auth::user()->id)->first();
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $juri_data = json_decode($verifikasi_jatuhan->data, true);
        $juri_data[$this->user->name] = $verifikasi;
        $verifikasi_jatuhan->data = json_encode($juri_data);
        $verifikasi_jatuhan->save();
        VerifikasiJatuhanEvent::dispatch($verifikasi_jatuhan,$this->jadwal);
    }
    public function verifikasiPelanggaranTrigger($verifikasi){
        $this->pilihan = $verifikasi;
        $verifikasi_pelanggaran = VerifikasiPelanggaran::where('jadwal_tanding', $this->jadwal->id)
        ->where('status', 1)
        ->latest('created_at')
        ->first();
        $this->user = User::where('id',Auth::user()->id)->first();
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $juri_data = json_decode($verifikasi_pelanggaran->data, true);
        $juri_data[$this->user->name] = $verifikasi;
        $verifikasi_pelanggaran->data = json_encode($juri_data);
        $verifikasi_pelanggaran->save();
        VerifikasiPelanggaranEvent::dispatch($verifikasi_pelanggaran,$this->jadwal);
    }

    public function verifikasiJatuhanHandler($data){
        if($this->pilihan == null || $data["verifikasi_jatuhan"]["status"] == false){
            $this->pilihan = "waiting";
        }
        $this->verifikasi_jatuhan = $data;
    }
    public function verifikasiPelanggaranHandler($data){
        if($this->pilihan == null || $data["verifikasi_pelanggaran"]["status"] == false){
            $this->pilihan = "waiting";
        }
        $this->verifikasi_pelanggaran = $data;
    }
    public function pukulanHandler(){
       
    }
    public function tendanganHandler(){
       
    }
    public function hapusHandler(){
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
    }
    public function gantiBabakHandler(){
        
    }

    public function gantiGelanggangHandler($data){
        if($data['gelanggang']['jenis'] != "Tanding" || Auth::user()->Gelanggang->jadwal != $this->jadwal->id){
            return redirect('auth');
        }
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
            if(Auth::user()->gelanggang !== $this->gelanggang->id){
                return redirect('dashboard');
            }
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $this->pengundian_biru = $this->jadwal->PengundianTandingBiru;
        $this->pengundian_merah = $this->jadwal->PengundianTandingMerah;
        $this->sudut_merah = $this->jadwal->PengundianTandingMerah->Tanding;
        $this->sudut_biru = $this->jadwal->PengundianTandingBiru->Tanding;
        $this->penilaian_tanding_merah = PenilaianTanding::where('sudut', $this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn($this->juri, [1, 2])->get();
        }
    }
  
    public function render()
    {
        return view('livewire.juri-tanding',[
        'user'=>Auth::user(),
        ])->extends('layouts.juri.app')->section('content');
    }
}
