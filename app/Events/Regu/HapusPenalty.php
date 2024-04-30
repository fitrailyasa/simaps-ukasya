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
use App\Models\PenaltyRegu;

class HapusPenalty implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal_regu;
    public $penalty_regu;

    public function __construct($jadwal_id,$sudut_merah_id,$sudut_biru_id,$dewan_id,$jenis_penalty)
    {
        $this->jadwal_regu = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penalty_regu = PenaltyRegu::where('sudut_biru',$sudut_biru_id)->where('sudut_merah',$sudut_merah_id)->where('jadwal_regu',$jadwal_id)->where('dewan',$dewan_id)->first();
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_regu->decrement('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_regu->decrement('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_regu->decrement('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_regu->decrement('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_regu->decrement('tidak_bergerak');
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
        return 'hapus-penalty-regu';
    }
}
