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
use App\Models\PenaltyTunggal;

class HapusPenalty implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $sudut;
    public $jadwal_tunggal;
    public $penalty_tunggal;

    public function __construct($jadwal_id,$sudut_id,$dewan_id,$jenis_penalty)
    {
        $this->sudut = TGR::where('id',$sudut_id)->where('kategori','Tunggal')->first();
        $this->jadwal_tunggal = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penalty_tunggal = PenaltyTunggal::where('sudut',$sudut_id)->where('jadwal_tunggal',$jadwal_id)->where('dewan',$dewan_id)->first();
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_tunggal->decrement('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_tunggal->decrement('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_tunggal->decrement('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_tunggal->decrement('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_tunggal->decrement('tidak_bergerak');
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
        return 'hapus-penalty-tunggal';
    }
}