<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\VerifikasiPelanggaran;
use App\Models\User;
use App\Models\PenilaianTanding;
use App\Models\JadwalTanding;

class VerifikasiPelanggaranEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
 
    public $verifikasi_pelanggaran;
    public $jadwal;
    
    public function __construct($verifikasi,$jadwal)
    {  
            $this->verifikasi_pelanggaran = $verifikasi;
            $this->jadwal = $jadwal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('verifikasi-'.$this->jadwal->id);
    }

    public function broadcastAs()
    {
        return 'verifikasi-pelanggaran';
    }
}
