<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\VerifikasiPelanggaran;
use App\Models\User;
use App\Models\PenilaianTanding;
use App\Models\JadwalTanding;

class VerifikasiPelanggaranEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal_tanding;
    public $user;
    public $verifikasi_pelanggaran;
    public $juri;
    public $juri_verifikasi = [];
    
    public function __construct($gelanggang_id,$jadwal_tanding_id,$user_id,$data)
    {  
            if($data == null){       
                $this->juri = User::where('roles_id',4)->where('gelanggang',$gelanggang_id)->get();
                foreach ($this->juri as $key => $juri) {
                    $this->juri_verifikasi[$juri['name']] = null ;
                }
                $this->user = $user_id;
                $this->jadwal_tanding = JadwalTanding::where('gelanggang',$gelanggang_id)->first();
                $this->verifikasi_pelanggaran = VerifikasiPelanggaran::Create([
                    'uuid'=> date('YmdHis').$user_id.$jadwal_tanding_id,
                    'dewan' => $user_id,
                    'jadwal_tanding' => $jadwal_tanding_id,
                    'data'=>json_encode($this->juri_verifikasi)
                ]);
            }else{
                $this->verifikasi_pelanggaran = VerifikasiPelanggaran::where('jadwal_tanding',$jadwal_tanding_id)->where('status',1)->first();
                $this->user = User::where('id',$user_id)->first();
                $this->juri = User::where('roles_id',4)->where('gelanggang',$gelanggang_id)->get();
                $this->jadwal_tanding = JadwalTanding::where('gelanggang',$gelanggang_id)->first();
                $juri_data = json_decode($this->verifikasi_pelanggaran->data, true);
                $juri_data[$this->user->name] = $data;
                $this->verifikasi_pelanggaran->data = json_encode($juri_data);
                $this->verifikasi_pelanggaran->save();
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
                        PenilaianTanding::where('atlet',$this->jadwal_tanding->sudut_biru)->where('babak',$this->jadwal_tanding->babak_tanding)->increment('peringatan');       
                    }elseif($merah > $biru && $merah > $invalid){
                        PenilaianTanding::where('atlet',$this->jadwal_tanding->sudut_merah)->where('babak',$this->jadwal_tanding->babak_tanding)->increment('peringatan');
                    }
                    $this->verifikasi_pelanggaran->status = false;
                    $this->verifikasi_pelanggaran->save();
                }
            }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('verifikasi'),
        ];
    }

    public function broadcastAs()
    {
        return 'verifikasi-pelanggaran';
    }
}
