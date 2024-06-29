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
use App\Models\PenilaianTunggal;


class TambahNilai implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $jadwal_tunggal;
    public $penilaian_tunggal;
    public $sudut;
    public $juri;

    public function __construct($jadwal,$sudut,$penilaian,$juri)
    {
        $this->juri = $juri;
        $this->sudut = $sudut;
        $this->penilaian_tunggal = $penilaian;
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
        return 'tambah-skor-tunggal';
    }
}
