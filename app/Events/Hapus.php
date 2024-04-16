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

class Hapus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $tanding;

    public function __construct($id,$jenis)
    {
        $this->tanding = Tanding::where('id', $id)->first();
        $this->tanding->decrement($jenis);

    }

    public function broadcastOn(): Channel
    {
        return new Channel('poin');
    }
    public function broadcastAs()
    {
        return 'hapus';
    }
}
