<?php

namespace App\Livewire\Operator;

use App\Models\Gelanggang;
use App\Models\JadwalTanding;
use App\Models\PengundianTanding;
use Livewire\Attributes\On;
use Livewire\Component;

class OperatorJadwalTanding extends Component
{
    public $gelanggang_operator;
    public $pengundiantandings;
    public $jadwaltandings;

    public function mount(){
        $this->gelanggang_operator = Gelanggang::find(auth()->user()->gelanggang) ?? null;
        $this->pengundiantandings = PengundianTanding::latest('id')->get();
        $this->jadwaltandings = JadwalTanding::orderBy('partai')->get();
    }
    public function getListeners()
    {
        return [
           "echo-private:gelanggang-{$this->gelanggang_operator->id},.ganti-gelanggang" => 'gantiGelanggangHandler',
        ];
    }

    public function gantiGelanggangHandler($data){
        if($data['gelanggang']['jenis'] != 'Tanding'){
            return redirect('/op/kontrol-tgr');
        }
        $this->jadwaltandings = JadwalTanding::orderBy('partai')->get();
    }
    public function render()
    {
        return view('livewire.operator.operator-jadwal-tanding')->extends('layouts.admin.app')->section('content');
    }
}
