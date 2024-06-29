<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\VerifikasiJatuhan;
use App\Models\User;
use App\Models\PenilaianTanding;
use App\Models\JadwalTanding;


class VerifikasiJatuhanEvent implements ShouldBroadcastNow
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
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('verifikasi-'.$this->jadwal->id),
        ];
    }
    public function broadcastAs()
    {
        return 'verifikasi-jatuhan';
    }
}
