@php
    $total = $penalty_regu->toleransi_waktu+$penalty_regu->keluar_arena+$penalty_regu->menyentuh_lantai+$penalty_regu->pakaian+$penalty_regu->tidak_bergerak;
@endphp

<div class="dewan-regu-footer text-center d-flex" style="width: 100%; height: 8vh;" >
    <div class="total border border-dark d-flex flex-column justify-content-center" style="width: 90%">
        <h5 class="fw-bold">Total</h5>
    </div>
    <div class="total-value border border-dark d-flex flex-column justify-content-center" style="width: 10%">
        <h5 class="fw-bold">
            {{$total == 0 ? "0" : $total * -0.5}}
        </h5>
    </div>
</div>