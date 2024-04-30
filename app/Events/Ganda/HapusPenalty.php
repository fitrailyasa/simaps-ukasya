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
use App\Models\PenaltyGanda;

class HapusPenalty implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal_ganda;
    public $penalty_ganda;

    public function __construct($jadwal_id,$sudut_merah_id,$sudut_biru_id,$dewan_id,$jenis_penalty)
    {
        $this->jadwal_ganda = JadwalTGR::where('id',$jadwal_id)->first();
        $this->penalty_ganda = PenaltyGanda::where('sudut_biru',$sudut_biru_id)->where('sudut_merah',$sudut_merah_id)->where('jadwal_ganda',$jadwal_id)->where('dewan',$dewan_id)->first();
        switch ($jenis_penalty) {
            case 'toleransi_waktu':
                $this->penalty_ganda->decrement('toleransi_waktu');
                break;
            case 'keluar_arena':
                $this->penalty_ganda->decrement('keluar_arena');
                break;
            case 'menyentuh_lantai':
                $this->penalty_ganda->decrement('menyentuh_lantai');
                break;
            case 'pakaian':
                $this->penalty_ganda->decrement('pakaian');
                break;
            case 'tidak_bergerak':
                $this->penalty_ganda->decrement('tidak_bergerak');
                break;
            case 'senjata_jatuh':
                $this->penalty_ganda->decrement('senjata_jatuh');
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
        return 'hapus-penalty-ganda';
    }
}
