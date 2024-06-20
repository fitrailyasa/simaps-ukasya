<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\VerifikasiJatuhan;
use App\Models\User;
use App\Models\PenilaianTanding;
use App\Models\JadwalTanding;


class VerifikasiJatuhanEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
 
    public $verifikasi_jatuhan;
    public $jadwal;
    
    public function __construct($verifikasi,$jadwal)
    {  

        $this->verifikasi_jatuhan = $verifikasi;
        $this->jadwal = $jadwal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel("verifikasi");
    }
    public function broadcastAs()
    {
        return 'verifikasi-jatuhan';
    }
}
