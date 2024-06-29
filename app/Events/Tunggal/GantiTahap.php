<?php

namespace App\Events\Tunggal;

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
    public $jadwal;
    public $waktu;
    public function __construct($tahap,$tampil,$sudut_tampil,$jadwal,$waktu)
    {
        $this->waktu =$waktu;
        $this->tahap = $tahap;
        $this->sudut_tampil = $sudut_tampil;
        $this->jadwal = $jadwal;
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
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('arena-'.$this->jadwal->id),
        ];
    }
    public function broadcastAs()
    {
        return 'ganti-tahap-tunggal';
    }
}
