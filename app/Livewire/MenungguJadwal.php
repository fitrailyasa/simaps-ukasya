<?php

namespace App\Livewire;

use App\Models\Gelanggang;
use App\Models\JadwalTanding;
use App\Models\JadwalTGR;
use Livewire\Component;
use Livewire\Attributes\On;

class MenungguJadwal extends Component
{
    public $user;
    public $gelanggang;


    public function mount($user,$gelanggang){
        $this->user = $user;
        $this->gelanggang = $gelanggang;
    }

    public function getListeners()
    {
        return [
           "echo:gelanggang-{$this->gelanggang},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function GantiGelanggangHandler($data){
        if($this->gelanggang == $data["gelanggang"]["id"]){
            switch ($this->user) {
                case 'penonton':
                    return redirect('/penonton/'.$this->gelanggang);        
                case 'ketua':
                    return redirect('/ketuapertandingan/'.$this->gelanggang);        
                default:
                    return redirect('auth');        
            }
        }
    }
    public function render()
    {
        return view('livewire.menunggu-jadwal')->extends('layouts.client.app')->section('content');
    }


}
