<?php

namespace App\Events\Tunggal;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\JadwalTGR;
use App\Models\TGR;
use App\Models\Gelanggang;
use App\Models\PenaltyTunggal;

class PenaltyDewan implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal_tunggal;
    public $penalty_tunggal;
    public $sudut;
    public $juri;

    public function __construct($jadwal,$sudut,$penalty,$juri)
    {
        $this->juri = $juri;
        $this->sudut = $sudut;
        $this->penalty_tunggal = $penalty;
        $this->jadwal_tunggal = $jadwal;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('poin-'.$this->jadwal_tunggal->id),
        ];
    }
    public function broadcastAs()
    {
        return 'penalty-tunggal';
    }
}
