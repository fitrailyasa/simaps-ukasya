<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Tanding;

class TambahPukulan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $pesilat_id;
    public $jumlah_pukulan;
    public $last;
    public function __construct($id,$last)
    {
        $this->last = $last;
        $this->pesilat_id = $id;
        $this->jumlah_pukulan = Tanding::where('id', $id)->increment('pukulan');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('poin');
    }
    public function broadcastAs()
    {
        return 'tambah-pukulan';
    }
}
