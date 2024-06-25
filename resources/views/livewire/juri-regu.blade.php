<div class="pt-4">
@section('title')
Regu
@endsection 
@section('style')
    @vite('resources/js/layout.js')
@endsection
<div class="container-fluid pb-4 " style="width: 100%; border: solid 2px black;min-height: 80vh;">
    <div
        id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{$gelanggang->id}}
        class="header d-flex justify-content-between p-1 m-1"
        style="color: black"
    >
        <div class="nama-petarung" style="width: 40%">
            <span class="fw-bold" style="font-size: 1.3rem">{{$tampil->region}}</span>
            <h3 class="fw-bold" style="{{$tampil->id == $pengundian_biru->atlet_id ? "color: #0053a6 !important" : "color:  red!important"}}">
                {{$tampil->nama}} , {{$tampil->kontingen}}
            </h3>
            <h3 class="fw-bold">{{$juri->permissions}}</h3>
        </div>
        <div class="jenis-lomba text-right" style="width: 40%">
            <span class="fw-bold" style="font-size: 1.3rem"
                >{{$gelanggang->nama}}, Match {{$jadwal->partai}}, Juny 7</span
            >
            <h3 class="fw-bold">Regu Single</h3>
        </div>
    </div>
    <div class="content">
        <div
            class="header text-center border border-secondary p-1"
            style="width: 100%; font-weight: 600; font-size: 1.3rem"
        >
            Regu Jurus 1 Tangan Kosong Movement 1
        </div>
        <div class="content">
            <div
                class="tombol d-flex gap-1"
                style="width: 100%; min-height: 20vh"
            >
                <div
                    class="tombol-salah d-flex justify-content-center border border-secondary"
                    style="
                        width: 40%;
                        font-size: 100%;
                        background-color: #ececec;
                    "
                >
                    <button
                        wire:click='salahGerakanTrigger({{$tampil->id}})'
                        class="btn tombol-regu"
                        style="
                            width: 100%;
                            height: 100%;
                            border-radius: 20px;
                            font-family: sans-serif !important;
                            box-shadow: 0px 0px 5px 0px rgba(244, 12, 12, 0.75);
                            -webkit-box-shadow: 0px 0px 5px 0px
                                rgba(244, 12, 12, 0.75);
                            -moz-box-shadow: 0px 0px 5px 0px
                                rgba(244, 12, 12, 0.75);
                            background-color: #70ad47;
                        "
                    >
                        <h1 class="display-1 salah text-white">SALAH</h1>
                    </button>
                </div>
                <div
                    class="requirement text-center d-flex flex-column  justify-content-center fw-bold border border-secondary"
                    style="width: 20%"
                >
                    <div class="tombol d-flex  justify-content-center">
                        <button id="fullscreen-btn" class="btn btn-primary" style="width: 85px; height: 85px;display: flex;align-items: center;justify-content: center;">
                            <i style="font-size: 3rem" class="fa-solid fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div
                    class="tombol-salah d-flex justify-content-center border border-secondary"
                    style="width: 40% ;font-size: 100% background-color: #ECECEC"
                >
                    <button
                        wire:click='buatPenilaian()'
                        class="btn tombol-regu"
                        style="
                            width: 100%;
                            height: 100%;
                            border-radius: 20px;
                            font-family: sans-serif !important;
                            box-shadow: 0px 0px 5px 0px rgba(12, 40, 244, 0.75);
                            -webkit-box-shadow: 0px 0px 5px 0px
                                rgba(12, 40, 244, 0.75);
                            -moz-box-shadow: 0px 0px 5px 0px
                                rgba(12, 40, 244, 0.75);
                            background-color: #70ad47;
                        "
                    >
                        <h1 class="display-1 salah text-white">SIAP</h1>
                    </button>
                </div>
            </div>
        </div>
        <div
            class="footer mt-1 d-flex flex-column gap-1"
            style="height: 20vh; width: 100%"
        >
            <div class="accuracy-score d-flex gap-1">
                <div
                    class="main text-center fw-bold border border-dark"
                    style="width: 90%; background-color: #ececec"
                >
                    <span>ACCURACY TOTAL SCORE</span>
                </div>
                <div
                    class="aside fw-bold text-center border border-dark"
                    style="width: 10%; font-size: 1.25rem"
                >
                    <span style="color: #0053a6">{{$penilaian_regu ? number_format(9.90 - $penilaian_regu->salah*0.01,2) : "9.90"}}</span>
                </div>
            </div>
            <div class="range-score d-flex gap-1" style="min-height: 20vh">
                <div
                    class="main text-center fw-bold border border-dark d-flex flex-column justify-content-center"
                    style="width: 90%;"
                >
                        <p class="fw-bold">
                        FLOW OF MOVEMENT / STAMINA RANGE SCORE: 0.01 -
                        0.10</p>
                    <div
                        class="score-detail d-flex gap-1 justify-content-center pb-1"
                    >
                        @for ($i = 1; $i <= 10; $i++)
                            @if ($i == 10)
                                <button
                                wire:click='tambahNilaiTrigger({{$tampil->id}},{{$i}})'f
                                class="p-1 {{$active == $i/100 ? "btn-danger" : "btn-primary"}}"
                                style=" width:9%; height: 80px;border-radius: 20px;"
                                >
                                <h3 class="fw-bold">
                                    0.10
                                </h3>
                                </button>
                            @else
                                <button
                                wire:click='tambahNilaiTrigger({{$tampil->id}},{{$i}})'
                                class="p-1 {{$active == $i/100 ? "btn-danger" : "btn-primary"}}"
                                style=" width:9%; height: 80px;border-radius: 20px;"
                                >
                                <h3 class="fw-bold">
                                    0.0{{$i}}
                                </h3>
                                </button>
                            @endif
                        @endfor
                    </div>
                </div>
                <div
                    class="aside fw-bold text-center border border-dark d-flex flex-column justify-content-center"
                    style="width: 10%; font-size: 1.25rem"
                >
                    <h3 class="fw-bold" style="color: #0053a6">{{$penilaian_regu ? number_format($penilaian_regu->flow_skor,2) : "0"}} </h3>
                </div>
            </div>
            <div class="total-score d-flex gap-1">
                <div
                    class="main text-center fw-bold border border-dark"
                    style="width: 90%; background-color: #ececec"
                >
                    <span class="font" style="font-size: 1.25rem">TOTAL SCORE</span>
                </div>
                <div
                    class="aside fw-bold text-center border border-dark"
                    style="width: 10%; font-size: 1.25rem"
                >
                    <span style="color: #0053a6">
                        {{$penilaian_regu ? number_format($penilaian_regu->skor,2) : "9.90"}} 
                    </span>
                </div>
            </div>
        </div>
    </div>
</div> 
@section('script')
<script>
    $(document).ready(function () {
        // Optimalisation: Store the references outside the event handler:
        var $window = $(window);
        var $pane = $("#pane1");

        function checkWidth() {
            var windowsize = $window.width();
            if (windowsize < 988 && windowsize > 659) {
                $(".salah").addClass("display-3");
                $(".salah").removeClass("display-1");
            } else if (windowsize <= 659) {
                $(".salah").addClass("display-4");
                $(".salah").removeClass("display-3");
            } else {
                $(".salah").addClass("display-1");
                $(".salah").removeClass("display-3");
            }
        }
        // Execute on load
        checkWidth();
        // Bind event listener
        $(window).resize(checkWidth);
    });

    // Ambil tombol fullscreen
        const fullscreenButton = document.getElementById('fullscreen-btn');
        const fullscreenIcon = fullscreenButton.querySelector('i');

        // Tambahkan event listener untuk tombol
        fullscreenButton.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                // Masuk ke mode fullscreen
                document.documentElement.requestFullscreen().then(() => {
                    fullscreenIcon.classList.remove('fa-expand');
                    fullscreenIcon.classList.add('fa-compress');
                }).catch((err) => {
                    console.error(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
                });
            } else {
                // Keluar dari mode fullscreen
                if (document.exitFullscreen) {
                    document.exitFullscreen().then(() => {
                        fullscreenIcon.classList.remove('fa-compress');
                        fullscreenIcon.classList.add('fa-expand');
                    }).catch((err) => {
                        console.error(`Error attempting to exit fullscreen mode: ${err.message} (${err.name})`);
                    });
                }
            }
        });
</script>
@endsection
</div>
