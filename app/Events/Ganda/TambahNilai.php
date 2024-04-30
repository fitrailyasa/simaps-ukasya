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

    public function __construct($jadwal_id,$sudut_biru_id,$sudut_merah_id,$value,$juri_id,$jenis_skor)
    {
        $this->jadwal_ganda = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penilaian_ganda = PenilaianGanda::where('sudut_biru',$sudut_biru_id)->where('sudut_merah',$sudut_merah_id)->where('jadwal_ganda',$jadwal_id)->where('juri',$juri_id)->first();
        switch ($jenis_skor) {
            case 'attack_skor':
                $this->penilaian_ganda->attack_skor+=$value;
                $this->penilaian_ganda->save();
                break;
            case 'firmness_skor':
                $this->penilaian_ganda->firmness_skor+=$value;
                $this->penilaian_ganda->save();
                break;
            case 'soulfulness_skor':
                $this->penilaian_ganda->soulfulness_skor+=$value;
                $this->penilaian_ganda->save();
                break;
        }
        $this->penilaian_ganda->skor+=$value;
        $this->penilaian_ganda->save();
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
