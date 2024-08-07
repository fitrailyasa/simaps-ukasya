<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\PenilaianTanding;

class TambahJatuhan implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $sudut_id;
    public $babak;
    public $jadwal;

    public function __construct($id,$babak_tanding,$jadwal)
    {
        $this->sudut_id = $id;
        $this->babak = $babak_tanding;
        $this->jadwal = $jadwal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('poin-'.$this->jadwal->id);
    }
    public function broadcastAs()
    {
        return 'tambah-jatuhan';
    }
}