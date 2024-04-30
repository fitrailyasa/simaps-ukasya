<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\JadwalTanding;
use App\Models\PenilaianTanding;
use App\Models\PenilaianJuri;
use App\Events\Tanding\PenilaianJuriEvent;

class GantiBabak implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal;
    public $penilaian_tanding_merah;
    public $penilaian_tanding_biru;
    public $penilaian_juri;

    public function __construct($jadwal_id)
    {
        $this->jadwal = JadwalTanding::where('id',$jadwal_id)->first();
        $this->penilaian_tanding_merah = PenilaianTanding::where('atlet',$this->jadwal->sudut_merah)->get();
        $this->penilaian_tanding_biru = PenilaianTanding::where('atlet',$this->jadwal->sudut_biru)->get();
        $this->penilaian_juri = PenilaianJuri::where('partai',$this->jadwal->partai)->get();

        if($this->jadwal->babak_tanding!=3){
            if($this->jadwal->babak_tanding == 1){
                $this->jadwal->skor_merah = 0;
                $this->jadwal->skor_biru = 0;
                $this->jadwal->save();
                MulaiPertandingan::dispatch($jadwal_id);
            }
                for ($i=1; $i <= $this->penilaian_tanding_merah[$this->jadwal->babak_tanding-1]->teguran ; $i++) { 
                    $this->jadwal->skor_merah -= $i * 1;
                    $this->jadwal->save();
                }
                for ($i=1; $i <= $this->penilaian_tanding_merah[$this->jadwal->babak_tanding-1]->jatuhan ; $i++) { 
                    $this->jadwal->skor_merah += 3;
                    $this->jadwal->save();
                }
                for ($i=1; $i <= $this->penilaian_tanding_merah[$this->jadwal->babak_tanding-1]->pukulan ; $i++) { 
                    $this->jadwal->skor_merah += 1;
                    $this->jadwal->save();
                }
                for ($i=1; $i <= $this->penilaian_tanding_merah[$this->jadwal->babak_tanding-1]->tendangan ; $i++) { 
                    $this->jadwal->skor_merah += 2;
                    $this->jadwal->save();
                }
                //
                for ($i=1; $i <= $this->penilaian_tanding_biru[$this->jadwal->babak_tanding-1]->teguran ; $i++) { 
                    $this->jadwal->skor_biru -= $i * 1;
                    $this->jadwal->save();
                }
                for ($i=1; $i <= $this->penilaian_tanding_biru[$this->jadwal->babak_tanding-1]->jatuhan ; $i++) { 
                    $this->jadwal->skor_biru += 3;
                    $this->jadwal->save();
                }
                for ($i=1; $i <= $this->penilaian_tanding_biru[$this->jadwal->babak_tanding-1]->pukulan ; $i++) { 
                    $this->jadwal->skor_biru += 1;
                    $this->jadwal->save();
                }
                for ($i=1; $i <= $this->penilaian_tanding_biru[$this->jadwal->babak_tanding-1]->tendangan ; $i++) { 
                    $this->jadwal->skor_biru += 2;
                    $this->jadwal->save();
                }
            $this->penilaian_tanding_merah[$this->jadwal->babak_tanding]->peringatan = $this->penilaian_tanding_merah[$this->jadwal->babak_tanding -1]->peringatan;
            $this->penilaian_tanding_merah[$this->jadwal->babak_tanding]->save();
            $this->penilaian_tanding_biru[$this->jadwal->babak_tanding]->peringatan = $this->penilaian_tanding_biru[$this->jadwal->babak_tanding -1]->peringatan;
            $this->penilaian_tanding_biru[$this->jadwal->babak_tanding]->save();
            $this->jadwal->babak_tanding += 1;
            $this->jadwal->save();
        }else{
            for ($i=1; $i < $this->penilaian_tanding_merah[2]->teguran ; $i++) { 
                    $this->jadwal->skor_merah -= $i * 1;
                }
                for ($i=1; $i < $this->penilaian_tanding_merah[2]->jatuhan ; $i++) { 
                    $this->jadwal->skor_merah += 3;
                }
                for ($i=1; $i < $this->penilaian_tanding_merah[2]->pukulan ; $i++) { 
                    $this->jadwal->skor_merah += 1;
                }
                for ($i=1; $i < $this->penilaian_tanding_merah[2]->tendangan ; $i++) { 
                    $this->jadwal->skor_merah += 2;
                }
                //
                for ($i=1; $i < $this->penilaian_tanding_biru[2]->teguran ; $i++) { 
                    $this->jadwal->skor_biru -= $i * 1;
                }
                for ($i=1; $i < $this->penilaian_tanding_biru[2]->jatuhan ; $i++) { 
                    $this->jadwal->skor_biru += 3;
                }
                for ($i=1; $i < $this->penilaian_tanding_biru[2]->pukulan ; $i++) { 
                    $this->jadwal->skor_biru += 1;
                }
                for ($i=1; $i < $this->penilaian_tanding_biru[2]->tendangan ; $i++) { 
                    $this->jadwal->skor_biru += 2;
                }

            for ($i=1; $i <= $this->penilaian_tanding_merah[2]->peringatan ; $i++) { 
                $this->jadwal->skor_merah -= $i * 5;
            }
            for ($i=1; $i <= $this->penilaian_tanding_biru[2]->peringatan ; $i++) { 
                $this->jadwal->skor_biru -= $i * 5;
            }
            foreach ($this->penilaian_juri as $key => $value) {
                $this->penilaian_juri[$key]->data = null;
                $this->penilaian_juri[$key]->save();
            }

            for ($i=0; $i <3 ; $i++) { 
                $this->penilaian_tanding_merah[$i]->peringatan = 0;
                $this->penilaian_tanding_merah[$i]->teguran = 0;
                $this->penilaian_tanding_merah[$i]->jatuhan = 0;
                $this->penilaian_tanding_merah[$i]->binaan = 0;
                $this->penilaian_tanding_biru[$i]->peringatan = 0;
                $this->penilaian_tanding_biru[$i]->teguran = 0;
                $this->penilaian_tanding_biru[$i]->jatuhan = 0;
                $this->penilaian_tanding_biru[$i]->binaan = 0;
                $this->penilaian_tanding_biru[$i]->skor = null;
                $this->penilaian_tanding_merah[$i]->skor = null;
                $this->penilaian_tanding_biru[$i]->save();
                $this->penilaian_tanding_merah[$i]->save();
            }
            $this->jadwal->babak_tanding = 1;
            $this->jadwal->tahap = 'hasil';
            $this->jadwal->save();
        }
        
        PenilaianJuriEvent::dispatch();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('arena');
    }
    public function broadcastAs()
    {
        return 'ganti-babak';
    }
}
