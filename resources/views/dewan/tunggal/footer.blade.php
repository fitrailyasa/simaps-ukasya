@php
    $total = $penalty_tunggal->toleransi_waktu+$penalty_tunggal->keluar_arena+$penalty_tunggal->menyentuh_lantai+$penalty_tunggal->pakaian+$penalty_tunggal->tidak_bergerak;
@endphp

<div class="dewan-tunggal-footer text-center d-flex" style="width: 100%; height: 8vh;" >
    <div class="total border border-dark d-flex flex-column justify-content-center" style="width: 90%">
        <h5 class="fw-bold">Total</h5>
    </div>
    <div class="total-value border border-dark d-flex flex-column justify-content-center" style="width: 10%">
        <h5 class="fw-bold">
            {{$total}}
        </h5>
    </div>
</div>