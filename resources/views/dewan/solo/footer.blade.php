@php
    $total = $penalty_solo->toleransi_waktu+$penalty_solo->keluar_arena+$penalty_solo->menyentuh_lantai+$penalty_solo->pakaian+$penalty_solo->tidak_bergerak+$penalty_solo->senjata_jatuh;
@endphp
<div class="dewan-tunggal-footer text-center d-flex" style="width: 100%; height: 8vh;" >
    <div class="total border d-flex border-dark flex-column justify-content-center" style="width: 90%">
        <h5 class="fw-bold">Total</h5>
    </div>
    <div class="total-value border-dark border d-flex flex-column justify-content-center" style="width: 10%">
        <h5 class="fw-bold">{{$total == 0 ? "0" : $total * -0.5}}</h5>
    </div>
</div>