<div class="pt-4">
@section('title')
Tunggal 
@endsection 
<div class="container-fluid pb-4 " style="width: 100%; border: solid 2px black;">
    <div
        class="header d-flex justify-content-between p-1 m-1"
        style="color: black"
    >
        <div class="nama-petarung" style="width: 40%">
            <span class="fw-bold" style="font-size: 1.3rem">{{$tampil->region}}</span>
            <h3 class="fw-bold" style="{{$tampil->id == $pengundian_biru->atlet_id ? "color: #0053a6 !important" : "color:  red!important"}}">
                {{$tampil->nama}}
            </h3>
        </div>
        <div class="jenis-lomba text-end" style="width: 40%">
            <span class="fw-bold" style="font-size: 1.3rem"
                >{{$gelanggang->nama}}, Match {{$jadwal->partai}}, Juny 7</span
            >
            <h3 class="fw-bold">Tunggal Single</h3>
        </div>
    </div>
    <div class="row d-flex flex-row justify-content-center">
        <button id="fullscreen-btn" class="btn btn-primary" style="width: 30px; height: 30px;display: flex;align-items: center;justify-content: center;">
            <i class="fa-solid fa-expand"></i>
        </button>
    </div>
    <div class="content">
        <div
            class="header text-center mt-3 border border-secondary p-1"
            style="width: 100%; font-weight: 600; font-size: 1.3rem"
        >
            Tunggal Jurus 1 Tangan Kosong Movement 1
        </div>
        <div class="content mt-1">
            <div
                class="skor d-flex justify-content-between"
                style="width: 100%"
            >
                <div
                    class="skor-salah text-center border border-dark"
                    style="width: 50%"
                >
                    <h4
                        class="fw-bold"
                        style="color: #db3545 !important; margin-top: 8px"
                    >
                        {{$penilaian_tunggal->salah}}
                    </h4>
                </div>
                <div
                    class="skor-siap text-center border border-dark"
                    style="width: 50%"
                >
                    <h4 class="fw-bold" style="color: #0053a6; margin-top: 8px">
                        0
                    </h4>
                </div>
            </div>
            <div
                class="tombol d-flex gap-1"
                style="width: 100%; min-height: 40vh"
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
                        class="btn tombol-tunggal"
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
                    class="requirement text-center d-flex flex-column justify-content-center fw-bold border border-secondary"
                    style="width: 20%"
                >
                    <span> Movement Details </span>
                    <span> Movement </span>
                    <span> Sequences </span>
                    <span> Movement has Not Shown </span>
                    <span> Style Sequences </span>
                </div>
                <div
                    class="tombol-salah d-flex justify-content-center border border-secondary"
                    style="width: 40% ;font-size: 100% background-color: #ECECEC"
                >
                    <button
                        class="btn tombol-tunggal"
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
                    <span style="color: #0053a6">{{number_format(9.90 - $penilaian_tunggal->salah*0.01,2)}}</span>
                </div>
            </div>
            <div class="range-score d-flex gap-1">
                <div
                    class="main text-center fw-bold border border-dark"
                    style="width: 90%"
                >
                    <span
                        >FLOW OF MOVEMENT / STAMINA RANGE SCORE: 0.01 -
                        0.10</span
                    >
                    <div
                        class="score-detail d-flex gap-1 justify-content-center pb-1"
                    >
                        @for ($i = 1; $i <= 10; $i++)
                            @if ($i == 10)
                                <button
                                wire:click='tambahNilaiTrigger({{$tampil->id}},{{$i}})'f
                                class="p-1"
                                style="background-color: #ececec; width:5%"
                                >
                                0.10
                                </button>
                            @else
                                <button
                                wire:click='tambahNilaiTrigger({{$tampil->id}},{{$i}})'
                                class="p-1"
                                style="background-color: #ececec;width:5%"
                                >
                                0.0{{$i}}
                                </button>
                            @endif
                        @endfor
                    </div>
                </div>
                <div
                    class="aside fw-bold text-center border border-dark"
                    style="width: 10%; font-size: 1.25rem"
                >
                    <span style="color: #0053a6">{{number_format($penilaian_tunggal->flow_skor,2)}}</span>
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
                        {{number_format($penilaian_tunggal->skor,2)}} 
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
