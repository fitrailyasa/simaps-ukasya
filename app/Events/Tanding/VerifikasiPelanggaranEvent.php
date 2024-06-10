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
 
    public $verifikasi_pelanggaran;
    
    public function __construct($verifikasi)
    {  
            $this->verifikasi_pelanggaran = $verifikasi;
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
