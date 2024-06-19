<?php

namespace App\Livewire\Dewan;
use App\Models\PengundianTanding;
use App\Models\User;
use App\Models\VerifikasiJatuhan;
use App\Models\VerifikasiPelanggaran;
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
use App\Models\JadwalTanding;
use App\Models\Gelanggang;
use App\Models\PenilaianTanding;

class DewanTanding extends Component
{
    public $jadwal;
    public $sudut_merah;
    public $sudut_biru;
    public $pengundian_merah;
    public $pengundian_biru;
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
    public $juri_verifikasi_jatuhan = [];
    public $juri_verifikasi_pelanggaran = [];
    public $juri;
    public $waktu = 0;

    public function mount()
    {
        $this->gelanggang = Gelanggang::find(Auth::user()->gelanggang);
        if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
            return redirect('dashboard');
        }
        $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
        $this->pengundian_biru = PengundianTanding::find($this->jadwal->sudut_biru);
        $this->pengundian_merah = PengundianTanding::find($this->jadwal->sudut_merah);
        $this->sudut_merah = $this->jadwal->PengundianTandingMerah->Tanding;
        $this->sudut_biru = $this->jadwal->PengundianTandingBiru->Tanding;
        $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
        $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
    }

    public function kurangiWaktu(){
        if($this->mulai == true){
             $this->waktu = ($this->waktu * 60 + 1) / 60;
        }
    }
    public function hapusTrigger($id){
        if($this->jadwal->sudut_biru == $id){
            if(!$this->penilaian_tanding_biru->where('sudut',$id)->last()){
                $this->error = "Tidak bisa menghapus nilai kosong";
            }else{
                $this->penilaian_tanding_biru->where('sudut',$id)->last()->delete();
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            };
        }else{
            if(!$this->penilaian_tanding_merah->where('sudut',$id)->last()){
                $this->error = "Tidak bisa menghapus nilai kosong";
            }else{
                $this->penilaian_tanding_merah->where('sudut',$id)->last()->delete();
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            };
        }
    }
    public function tambahPeringatanTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            $nilai = -5;
            if($id == $this->sudut_biru->id){
                if(count($this->penilaian_tanding_biru->where('jenis', 'peringatan'))>=1){
                $nilai = -10;
                };
            }else{
                if(count($this->penilaian_tanding_merah->where('jenis', 'peringatan'))>=1){
                $nilai = -10;
                }
            }
            PenilaianTanding::create([
                'jenis'=>'peringatan',
                'sudut'=>$id,
                'jadwal_tanding'=>$this->jadwal->id,
                'uuid'=>date('Ymd-His').'-'.$id.Auth::user()->id.'-'.$this->jadwal->id,
                'dewan' => $nilai,
                'status'=> 'sah',
                'aktif'=> false,
                'babak'=>$this->jadwal->babak_tanding
            ]);
    
            if($id == $this->jadwal->PengundianTandingBiru->Tanding->id){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }
            
            TambahPeringatan::dispatch($id,$this->jadwal->babak_tanding,$this->jadwal);
        }else{
            $this->error = "pertandingan belum dimulai atau sedang di pause";
        }
    }
    public function tambahTeguranTrigger($id){
        if($this->jadwal->tahap == 'tanding'){
            $nilai = -1;
            if($id == $this->sudut_biru->id){
                if(count($this->penilaian_tanding_biru->where('babak',$this->jadwal->babak_tanding)->where('jenis', 'teguran')) >= 1){
                    $nilai = -2;
                };
            }else{
                if(count($this->penilaian_tanding_merah->where('babak',$this->jadwal->babak_tanding)->where('jenis', 'teguran')) >= 1){
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
    
             if($id == $this->jadwal->PengundianTandingBiru->Tanding->id){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }        
            TambahTeguran::dispatch($id,$this->jadwal->babak_tanding,$this->jadwal);
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
    
             if($id == $this->jadwal->PengundianTandingBiru->Tanding->id){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }
            
            TambahBinaan::dispatch($id,$this->jadwal->babak_tanding,$this->jadwal);
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

            if($id == $this->jadwal->PengundianTandingBiru->Tanding->id){
                $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }else{
                $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            }
                    
            TambahJatuhan::dispatch($id,$this->jadwal->babak_tanding,$this->jadwal);
        }else{
            $this->error = "pertandingan belum dimulai atau sedang di pause";
        }  
    }

    public function resetVerifikasiJatuhan(){
        $this->juri_verifikasi_jatuhan=[];
        $this->created_at = null;
        $this->verifikasi_jatuhan;
    }

    public function resetVerifikasiPelanggaran(){
        $this->juri_verifikasi_pelanggaran=[];
        $this->created_at = null;
        $this->verifikasi_pelanggaran = null;
    }

    public function VerifikasiJatuhanTrigger(){
            $this->juri = User::where('roles_id', 4)
                ->where('gelanggang', $this->gelanggang->id)
                ->whereIn('permissions', ['Juri 1', 'Juri 2', 'Juri 3'])
                ->get();
                foreach ($this->juri as $key => $juri) {
                    $this->juri_verifikasi_jatuhan[$juri['name']] = null ;
                }
                $this->verifikasi_jatuhan = VerifikasiJatuhan::Create([
                    'uuid'=> date('YmdHis').Auth::user()->id.$this->jadwal->id,
                    'dewan' => Auth::user()->id,
                    'jadwal_tanding' => $this->jadwal->id,
                    'data'=>json_encode($this->juri_verifikasi_jatuhan)
                ]);
        $this->verifikasi_jatuhan_data = $this->juri_verifikasi_jatuhan;
        $this->created_at = $this->verifikasi_jatuhan->created_at->setTimezone('Asia/Jakarta')->format('d F Y H:i');
        VerifikasiJatuhanEvent::dispatch($this->verifikasi_jatuhan,$this->jadwal);
    }
    public function VerifikasiPelanggaranTrigger(){
                $this->juri = User::where('roles_id', 4)
                ->where('gelanggang', $this->gelanggang->id)
                ->whereIn('permissions', ['Juri 1', 'Juri 2', 'Juri 3'])
                ->get();
                foreach ($this->juri as $key => $juri) {
                    $this->juri_verifikasi_pelanggaran[$juri['name']] = null ;
                }
                $this->verifikasi_pelanggaran = VerifikasiPelanggaran::Create([
                    'uuid'=> date('YmdHis').Auth::user()->id.$this->jadwal->id,
                    'dewan' => Auth::user()->id,
                    'jadwal_tanding' => $this->jadwal->id,
                    'data'=>json_encode($this->juri_verifikasi_pelanggaran)
                ]);
            $this->verifikasi_pelanggaran_data = $this->juri_verifikasi_pelanggaran;
            $this->created_at = $this->verifikasi_pelanggaran->created_at->setTimezone('Asia/Jakarta')->format('d F Y H:i');
            VerifikasiPelanggaranEvent::dispatch($this->verifikasi_pelanggaran,$this->jadwal);
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
        $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
        $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
    }
    #[On('echo:arena,.ganti-babak')]
    public function gantiBabakHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            
        }
    }
    #[On('echo:arena,.ganti-gelanggang')]
    public function gantiGelanggangHandler($data){
        if($this->gelanggang->id == $data["gelanggang"]["id"]){
            if(Auth::user()->status !== 1 || Auth::user()->gelanggang !== $this->gelanggang->id){
                return redirect('dashboard');
            }
            $this->jadwal = JadwalTanding::find($this->gelanggang->jadwal);
            $this->pengundian_biru = PengundianTanding::find($this->jadwal->sudut_biru);
            $this->pengundian_merah = PengundianTanding::find($this->jadwal->sudut_merah);
            $this->sudut_merah = $this->jadwal->PengundianTandingMerah->Tanding;
            $this->sudut_biru = $this->jadwal->PengundianTandingBiru->Tanding;
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
        }
    }
    #[On('echo:verifikasi,.verifikasi-jatuhan')]
    public function verifikasiJatuhanHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->verifikasi_jatuhan_data = json_decode($this->verifikasi_jatuhan['data'], true);
            $this->created_at = Carbon::parse($data['verifikasi_jatuhan']['created_at'])->setTimezone('Asia/Jakarta')->format('d F Y H:i');
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
        }
    }
    #[On('echo:verifikasi,.verifikasi-pelanggaran')]
    public function verifikasiPelanggaranHandler($data){
        if($this->jadwal->id == $data["jadwal"]["id"]){
            $this->verifikasi_pelanggaran_data = json_decode($this->verifikasi_pelanggaran['data'], true);
            $this->created_at = Carbon::parse($data['verifikasi_pelanggaran']['created_at'])->setTimezone('Asia/Jakarta')->format('d F Y H:i');
            $this->penilaian_tanding_merah= PenilaianTanding::where('sudut',$this->sudut_merah->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
            $this->penilaian_tanding_biru= PenilaianTanding::where('sudut',$this->sudut_biru->id)->where('jadwal_tanding',$this->jadwal->id)->whereIn('jenis',['teguran','binaan','peringatan','jatuhan'])->get();
        }
    }
    #[On('echo:arena,.mulai-pertandingan')]
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
            }else{
                $this->mulai = false;
            }
        }
    }
    public function render()
    {
        return view('livewire.dewan-tanding')->extends('layouts.dewan.app')->section('content');
    }
}
