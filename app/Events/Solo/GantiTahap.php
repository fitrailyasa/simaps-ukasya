<?php

namespace App\Events\Solo;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GantiTahap implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $tahap;
    public $tampil;
    public $sudut_tampil;
    public $gelanggang;
    public $waktu;
    public function __construct($tahap,$tampil,$sudut_tampil,$gelanggang,$waktu)
    {
        $this->waktu =$waktu;
        $this->tahap = $tahap;
        $this->sudut_tampil = $sudut_tampil;
        $this->gelanggang = $gelanggang;
        if($tampil !== null){
            if($tahap == "tampil"){
                $this->tampil = $tampil;
            }
        }
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('arena');
    }
    public function broadcastAs()
    {
        return 'ganti-tahap-solo';
    }
}
