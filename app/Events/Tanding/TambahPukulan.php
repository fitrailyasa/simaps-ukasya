<?php

namespace App\Events\Tanding;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\PenilaianTanding;

class TambahPukulan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $sudut_id;
    public $juri_id;
    public $status;
    public $eventSent;


    public function __construct($id,$juri_id,$eventSent,$status)
    {
        $this->sudut_id = $id;
        $this->juri_id = $juri_id;
        $this->eventSent = $eventSent->event_sent;
        $this->status = $status;
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
