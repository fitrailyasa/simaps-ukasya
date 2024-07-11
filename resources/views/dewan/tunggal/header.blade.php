<div class="dewan-tanding-header d-flex" style="width: 100%">
    <div class="d-flex flex-column justify-content-center" style="width: 50%">
        <h5 class="fw-bold ml-3" style="margin-bottom: -4px">
            {{$tampil->kontingen}} 
        </h5>
        <h5 class="fw-bold" style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}; font-size:1.5rem;"> 
            {{$tampil->nama}}
        </h5>
    </div>
    <div wire:poll.1000ms='kurangiWaktu' class="timer-clock">
        <p class="text-hasil fw-bold" style="font-size: 3rem;">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</p>
    </div>
    <div class="kontingen-biru text-end d-flex flex-column justify-content-center" style="width: 50%">
        <h5 class="fw-bold" style="margin-bottom: -4px">
            {{$gelanggang->nama}}, Partai {{$jadwal->partai}} Tunggal
        </h5>
    </div>
</div>
<div class="tombol d-flex justify-content-center mb-3">
    <button id="fullscreen-btn" class="btn btn-primary" style="width: 40px; height: 40px;display: flex;align-items: center;justify-content: center;">
        <i style="font-size: 1rem" class="fa-solid fa-expand"></i>
    </button>
</div>