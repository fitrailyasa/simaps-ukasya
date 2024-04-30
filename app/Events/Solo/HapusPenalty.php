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
use App\Models\PenaltySolo;

class HapusPenalty implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
   public $jadwal_solo;
    public $penalty_solo;

    public function __construct($jadwal_id,$sudut_id,$dewan_id,$jenis_penalty)
    {
        $this->jadwal_solo = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penalty_solo = PenaltySolo::where('sudut',$sudut_id)->where('jadwal_solo',$jadwal_id)->where('dewan',$dewan_id)->first();
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_solo->decrement('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_solo->decrement('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_solo->decrement('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_solo->decrement('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_solo->decrement('tidak_bergerak');
                break;
            case 'senjata_jatuh':
                $this->penalty_solo->decrement('senjata_jatuh');
                break;
        }
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
        return 'hapus-penalty-solo';
    }
}
