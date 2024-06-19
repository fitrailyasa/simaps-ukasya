<div class="dewan-tanding-header d-flex pt-5" style="width: 100%">
    <div class="" style="width: 50%">
        <h5 class="fw-bold ml-3" style="margin-bottom: -4px">
            {{$sudut_merah->kontingen}}, {{$sudut_biru->kontingen}}
        </h5>
        <h4 class="fw-bold" style="color: #db3545">
            {{$sudut_merah->nama}}, {{$sudut_biru->nama}}
        </h4>
    </div>
    <div class="timer-clock">
        <p class="text-hasil fw-bold" style="font-size: 3rem;">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</p>
    </div>
    <div class="kontingen-biru text-end d-flex flex-column justify-content-center" style="width: 50%">
        <h5 class="fw-bold" style="margin-bottom: -4px">
            {{$gelanggang->nama}}, Match {{$jadwal->partai}}
        </h5>
        <h4 class="fw-bold">
            Regu
        </h4>
    </div>
</div>