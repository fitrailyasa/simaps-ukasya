<?php

namespace App\Livewire\Operator;

use Livewire\Component;

class OperatorSoloKontrol extends Component
{
    public function mount($jadwal_tanding_id){
        dd('tes');
    }
    public function render()
    {
        return view('livewire.operator.operator-solo-kontrol');
    }
}
