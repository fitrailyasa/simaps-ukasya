<?php

namespace App\Events\Ganda;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\Gelanggang;
use App\Models\PenilaianGanda;

class TambahNilai implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal_ganda;
    public $penilaian_ganda;
    public $sudut;
    public $juri;
    public $gelanggang;

    public function __construct($jadwal,$sudut,$penilaian,$juri,$gelanggang)
    {
        $this->gelanggang = $gelanggang;
        $this->juri = $juri;
        $this->sudut = $sudut;
        $this->penilaian_ganda = $penilaian;
        $this->jadwal_ganda = $jadwal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('poin');
    }
    public function broadcastAs()
    {
        return 'tambah-skor-ganda';
    }
}
