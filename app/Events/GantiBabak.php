<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\JadwalTanding;
use App\Models\Babak;

class GantiBabak implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $jadwal;
    public $babak_merah;
    public $babak_biru;

    public function __construct($jadwal_id)
    {
        $this->jadwal = JadwalTanding::where('id',$jadwal_id)->first();
        $this->babak_merah = Babak::where('atlet',$this->jadwal->sudut_merah)->get();
        $this->babak_biru = Babak::where('atlet',$this->jadwal->sudut_biru)->get();

        if($this->jadwal->babak_tanding!=3){
            $this->babak_merah[$this->jadwal->babak_tanding]->peringatan = $this->babak_merah[$this->jadwal->babak_tanding -1]->peringatan;
            $this->babak_merah[$this->jadwal->babak_tanding]->save();
            $this->babak_biru[$this->jadwal->babak_tanding]->peringatan = $this->babak_biru[$this->jadwal->babak_tanding -1]->peringatan;
            $this->babak_biru[$this->jadwal->babak_tanding]->save();
            $this->jadwal->babak_tanding += 1;
            $this->jadwal->save();
        }else{
            for ($i=0; $i <3 ; $i++) { 
                $this->babak_merah[$i]->peringatan = 0;
                $this->babak_merah[$i]->teguran = 0;
                $this->babak_merah[$i]->jatuhan = 0;
                $this->babak_merah[$i]->binaan = 0;
                $this->babak_biru[$i]->peringatan = 0;
                $this->babak_biru[$i]->teguran = 0;
                $this->babak_biru[$i]->jatuhan = 0;
                $this->babak_biru[$i]->binaan = 0;
                $this->babak_biru[$i]->save();
                $this->babak_merah[$i]->save();
            }
            $this->jadwal->babak_tanding = 1;
            $this->jadwal->save();
        }
        

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel('arena');
    }
    public function broadcastAs()
    {
        return 'ganti-babak';
    }
}
