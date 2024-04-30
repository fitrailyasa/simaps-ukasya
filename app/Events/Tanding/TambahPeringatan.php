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

class TambahPeringatan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    
    public $sudut_id;
    public $jumlah_peringatan;

    public function __construct($id,$babak_tanding)
    {
        $this->pesilat_id = $id;
        $this->jumlah_peringatan = PenilaianTanding::where('atlet',$id)->where('babak',$babak_tanding)->first();
        $this->jumlah_peringatan->increment('peringatan');
    }

    public function broadcastOn(): Channel
    {
        return new Channel('poin');
    }
    public function broadcastAs()
    {
        return 'tambah-peringatan';
    }
}