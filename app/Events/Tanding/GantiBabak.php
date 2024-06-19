<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\JadwalTanding;
use App\Models\PenilaianTanding;
use App\Models\PenilaianJuri;
use App\Events\Tanding\PenilaianJuriEvent;

class GantiBabak implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $babak;
    public $jadwal;
    public function __construct($babak,$jadwal)
    {
        $this->babak = $babak;   
        $this->jadwal = $jadwal;   
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
