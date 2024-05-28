@php
    $total = $penalty_tunggal->toleransi_waktu+$penalty_tunggal->keluar_arena+$penalty_tunggal->menyentuh_lantai+$penalty_tunggal->pakaian+$penalty_tunggal->tidak_bergerak;
@endphp

<div class="dewan-tunggal-footer text-center d-flex" style="width: 100%; height: 8vh;" >
    <div class="total border border-dark d-flex flex-column justify-content-center" style="width: 90%">
        <h5 class="fw-bold">Total</h5>
    </div>
    <div class="total-value border border-dark d-flex flex-column justify-content-center" style="width: 10%">
        <h5 class="fw-bold">
            {{$total == 0 ? "0" : $total * -0.5}}
        </h5>
    </div>
</div>
<div class="row">OPERATOR KONTROL</div>
<div class="row">
    <div class="col-md-4">
        <button wire:click='gantiTahap("persiapan",null)'>persiapan</button>
    </div>
    <div class="col-md-4">
        <button wire:click='gantiTahap("tampil","biru")'>penampilan biru</button>
        <button wire:click='gantiTahap("tampil","merah")'>penampilan merah</button>
    </div>
    <div class="col-md-4">
        <button wire:click='gantiTahap("keputusan","merah")'>merah</button>
        <button wire:click='gantiTahap("keputusan","biru")'>biru</button>
        <button>keputusan</button>
    </div>
</div>