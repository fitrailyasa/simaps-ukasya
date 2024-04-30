<?php

namespace App\Events\Regu;

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
use App\Models\PenilaianRegu;


class TambahNilai implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $sudut;
    public $jadwal_regu;
    public $penilaian_regu;

    public function __construct($jadwal_id,$sudut_biru_id,$sudut_merah_id,$value,$juri_id)
    {
        $this->jadwal_regu = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penilaian_regu = PenilaianRegu::where('sudut_biru',$sudut_biru_id)->where('sudut_merah',$sudut_merah_id)->where('jadwal_regu',$jadwal_id)->where('juri',$juri_id)->first();
        $this->penilaian_regu->skor += $value;
        $this->penilaian_regu->flow_skor += $value;
        $this->penilaian_regu->save();
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
        return 'tambah-skor-regu';
    }
}
