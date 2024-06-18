<?php

namespace App\Livewire\Operator;
use Livewire\Component;
use App\Models\Gelanggang;
use App\Models\JadwalTGR;
use App\Models\PengundianTGR;
use Livewire\Attributes\On;




class OperatorJadwalTGR extends Component
{
    public $gelanggang_operator;
    public $pengundiantgrs;
    public $jadwaltgrs;

    public function mount()
    {
        $this->gelanggang_operator = Gelanggang::find(auth()->user()->gelanggang);
        $this->pengundiantgrs = PengundianTGR::latest('id')->get();
        $this->jadwaltgrs = JadwalTGR::latest('id')->where('jenis',$this->gelanggang_operator->jenis)->get();

    }

    #[On('echo:arena,.ganti-gelanggang')]
    public function gantiGelanggangHandler($data){
        if($data['gelanggang']['jenis'] == 'Tanding'){
            return redirect('/op/kontrol-tanding');
        }
        $this->jadwaltgrs = JadwalTGR::latest('id')->where('jenis',$this->gelanggang_operator->jenis)->get();
    }
    public function render()
    {
        return view('livewire.operator.operator-jadwal-tgr')->extends('layouts.admin.app')->section('content');
    }
}
