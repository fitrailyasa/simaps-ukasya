<?php

namespace App\Events\Solo;

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
use App\Models\PenilaianSolo;

class TambahNilai implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal_solo;
    public $penilaian_solo;

    public function __construct($jadwal_id,$sudut_id,$value,$juri_id,$jenis_skor)
    {
        $this->jadwal_solo = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penilaian_solo = PenilaianSolo::where('sudut',$sudut_id)->where('jadwal_solo',$jadwal_id)->where('juri',$juri_id)->first();
        switch ($jenis_skor) {
            case 'attack_skor':
                $this->penilaian_solo->attack_skor+=$value;
                $this->penilaian_solo->save();
                break;
            case 'firmness_skor':
                $this->penilaian_solo->firmness_skor+=$value;
                $this->penilaian_solo->save();
                break;
            case 'soulfulness_skor':
                $this->penilaian_solo->soulfulness_skor+=$value;
                $this->penilaian_solo->save();
                break;
        }
        $this->penilaian_solo->skor+=$value;
        $this->penilaian_solo->save();
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
        return 'tambah-skor-solo';
    }
}
