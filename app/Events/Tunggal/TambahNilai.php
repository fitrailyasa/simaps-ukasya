<?php

namespace App\Events\Tunggal;

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
use App\Models\PenilaianTunggal;


class TambahNilai implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $sudut;
    public $jadwal_tunggal;
    public $penilaian_tunggal;

    public function __construct($jadwal_id,$sudut_id,$value,$juri_id)
    {
        $this->sudut = TGR::where('id',$sudut_id)->where('kategori','Tunggal')->first();
        $this->jadwal_tunggal = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penilaian_tunggal = PenilaianTunggal::where('sudut',$sudut_id)->where('jadwal_tunggal',$jadwal_id)->where('juri',$juri_id)->first();
        $this->penilaian_tunggal->skor += $value;
        $this->penilaian_tunggal->flow_skor += $value;
        $this->penilaian_tunggal->save();
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
        return 'tambah-skor-tunggal';
    }
}
