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
use App\Models\Gelanggang;
use App\Models\Tanding;
use App\Models\PenilaianTanding;

class MulaiPertandingan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $gelanggang;
    public $jadwal;
    public $waktu;
    public function __construct($jadwal_id)
    {
        $this->jadwal = JadwalTanding::where('id',$jadwal_id)->first();
        $this->jadwal->tahap = 'tanding';
        $this->jadwal->save(); 
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
        return 'mulai-pertandingan';
    }
}
