<div id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{$gelanggang->id}} class="content d-flex flex-column gap-1" style="width: 100%">
    <div class="header d-flex gap-1" style="width: 100%;">
        <div class="aside bg-abu text-center border border-secondary d-flex align-items-center justify-content-center" style="width: 9%;">
            <h6 style="font-size: 0.8rem; margin: 0;" class="fw-bold">
                SCORING ELEMENT
            </h6>
        </div>
        <div class="bg-abu border border-secondary text-center d-flex flex-column justify-content-center align-items-center" style="width: 87%;">
            <h6 style="font-size: 0.8rem; margin: 0;" class="fw-bold">
                SCORE
            </h6>
        </div>
        <div class="bg-abu border border-secondary text-center d-flex align-items-center justify-content-center" style="width: 4%;">
            <button id="fullscreen-btn" class="btn btn-primary d-flex justify-content-center align-items-center" style="width: 30px; height: 30px; padding: 0;">
                <i class="fa-solid fa-expand"></i>
            </button>
        </div>
    </div>
    <div class="content d-flex gap-1" style="width: 100%; height: 100">
        <div class="aside text-center" style="width: 10%;height: 100">
            <div class="row-1 border border-secondary" style="width: 100%; height: 33.6% !important">
                <h6 class="fw-bold" style="height: 100%; margin-top: 50%;font-size: 0.8rem">
                    ATTACK DEFENSE TECHNIQUE ( 0.01 - 0.30 )
                </h6>
            </div>
            <div class="row-2 border border-secondary mt-1" style="height: 32.7% !important">
                <h6 class="fw-bold" style="height: 100%; margin-top: 50%;font-size: 0.8rem">
                    FIRMNESS AND HARMONY ( 0.01 - 0.30 )
                </h6>
            </div>
            <div class="row-3 border border-secondary mt-1" style="height: 32.3% !important">
                <h6 class="fw-bold" style="height: 100%; margin-top: 50%;font-size: 0.8rem">
                    SOULFULNESS ( 0.01 - 0.30 )
                </h6>
            </div>

        </div>
        <div class="main-content text-center  score-detail d-flex flex-column" style="width: 90%;height: 100%; ">
            <div class="row-1 border border-secondary pb-1" style="height: 100%;">
                <div class="p-1 d-flex flex-row gap-1 mt-1 btn-row" style="width:100% !important ;">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button
                                wire:click='tambahNilaiTrigger({{$i}},"attack_skor")'
                                class="btn border btn-primary text-white border-dark att-btn-10 {{$attack_active == 0.1 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.10
                                </h3>
                            </button>
                        @else
                            <button 
                                wire:click='tambahNilaiTrigger({{$i}},"attack_skor")'
                                class="btn border btn-primary text-white border-dark att-btn-{{ $i }} {{$attack_active == ($i)/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.0{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button 
                                wire:click='tambahNilaiTrigger({{$i+10}},"attack_skor")'
                                class="btn border btn-primary text-white border-dark att-btn-20 {{$attack_active == 0.2 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.20
                                </h3>
                            </button>
                        @else
                            <button 
                                wire:click='tambahNilaiTrigger({{$i+10}},"attack_skor")' 
                                class="btn border btn-primary text-white border-dark att-btn-1{{ $i }} {{$attack_active == ($i+10)/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.1{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button 
                                wire:click='tambahNilaiTrigger({{$i+20}},"attack_skor")'
                                class="btn border btn-primary text-white border-dark att-btn-30 {{$attack_active == 0.3 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.30
                                </h3>
                            </button>
                        @else
                            <button 
                                wire:click='tambahNilaiTrigger({{$i+20}},"attack_skor")'
                                class="btn border btn-primary text-white border-dark att-btn-2{{ $i }} {{$attack_active == ($i+20)/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.2{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="row-2 border border-secondary " style="height: 100%;margin-top: 6px">
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important;">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button  wire:click='tambahNilaiTrigger({{$i}},"firmness_skor")' class="btn border btn-primary text-white border-dark firm-btn-10 {{$firmness_active == 0.1 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.10
                                </h3>
                            </button>
                        @else
                            <button 
                                wire:click='tambahNilaiTrigger({{$i}},"firmness_skor")'
                                class="btn border btn-primary text-white border-dark firm-btn-{{ $i }} {{$firmness_active == $i/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.0{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button wire:click='tambahNilaiTrigger({{$i+10}},"firmness_skor")' class="btn border btn-primary text-white border-dark firm-btn-20 {{$firmness_active == 0.2 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.20
                                </h3>
                            </button>
                        @else
                            <button wire:click='tambahNilaiTrigger({{$i+10}},"firmness_skor")' class="btn border btn-primary text-white border-dark firm-btn-1{{ $i }} {{$firmness_active == ($i+10)/100  ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.1{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button wire:click='tambahNilaiTrigger({{$i+20}},"firmness_skor")' class="btn border btn-primary text-white border-dark firm-btn-30 {{$firmness_active == 0.3 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.30
                                </h3>
                            </button>
                        @else
                            <button wire:click='tambahNilaiTrigger({{$i+20}},"firmness_skor")' class="btn border btn-primary text-white border-dark firm-btn-2{{ $i }} {{$firmness_active == ($i+20)/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.2{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="row-3 border border-secondary" style="height: 100%;margin-top: 6px">
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button wire:click='tambahNilaiTrigger({{$i}},"soulfulness_skor")' class="btn border btn-primary text-white border-dark soul-btn-10 {{$soulfulness_active == 0.1 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.10
                                </h3>
                            </button>
                        @else
                            <button wire:click='tambahNilaiTrigger({{$i}},"soulfulness_skor")' class="btn border btn-primary text-white border-dark soul-btn-{{ $i }} {{$soulfulness_active == ($i)/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.0{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button wire:click='tambahNilaiTrigger({{$i+10}},"soulfulness_skor")' class="btn border btn-primary text-white border-dark soul-btn-20 {{$soulfulness_active == 0.2 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.20
                                </h3>
                            </button>
                        @else
                            <button wire:click='tambahNilaiTrigger({{$i+10}},"soulfulness_skor")' class="btn border btn-primary text-white border-dark soul-btn-1{{ $i }} {{$soulfulness_active == ($i+10)/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.1{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
                <div class="p-1 d-flex flex-row gap-1 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button wire:click='tambahNilaiTrigger({{$i+20}},"soulfulness_skor")' class="btn border btn-primary text-white border-dark soul-btn-30 {{$soulfulness_active == 0.3 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.30
                                </h3>
                            </button>
                        @else
                            <button wire:click='tambahNilaiTrigger({{$i+20}},"soulfulness_skor")' class="btn border btn-primary text-white border-dark soul-btn-2{{ $i }} {{$soulfulness_active == ($i+20)/100 ? "bg-danger" : ""}}"
                                style="font-size: 2.5rem; width:10%">
                                <h3>
                                    0.2{{ $i }}
                                </h3>
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="score-sub-total text-center d-flex flex-column" style="width: 7%; gap:5px;">
            <div class="border border-secondary " style="height: 35.3% !important; padding-top: 50% ">
                <h4 class="fw-bold score">SCORE</h4>
                <h4 class="fw-bold" style="color: #0053a6 !important;font-size: 1.5rem !important">
                    {{number_format($penilaian_solo->attack_skor,2)}}
                </h4>
            </div>
            <div class="border border-secondary " style="height: 33.7%;padding-top: 50%">
                <h4 class="fw-bold score">SCORE</h4>
                <h4 class="fw-bold" style="color: #0053a6 !important;font-size: 1.5rem !important">
                    {{number_format($penilaian_solo->firmness_skor,2)}}
                </h4>
            </div>
            <div class="border border-secondary " style="height: 33.5%;padding-top: 50%">
                <h4 class="fw-bold score">SCORE</h4>
                <h4 class="fw-bold" style="color: #0053a6 !important;font-size: 1.5rem !important">
                    {{number_format($penilaian_solo->soulfulness_skor,2)}}
                </h4>
            </div>
        </div>
        <div class=" score-total d-flex flex-column justify-content-center text-center  border border-secondary"
            style="width: 5%">
            <h5 class="fw-bold">SCORE TOTAL</h5>
            <h4 class="fw-bold" style="color: #0053a6 !important;font-size: 1.5rem !important">
                {{number_format($penilaian_solo->skor,2)}}
            </h4>
        </div>
    </div>
    <div class="footer d-flex gap-1 justify-content-start" style="width: 100%; height: 7vh !important;">
        <div class="main-footer text-center  bg-abu border border-secondary pt-2"
            style="width: 76.3%; margin-left: 0;">
            <h5 class="fw-bold" style="margin-top: 0px !important">Total</h5>
        </div>
        <div class="score text-center  bg-abu border border-secondary d-flex justify-content-center pt-2"
            style="width: 6% !important;margin-top: 0 !important">
            <div class="kotak bg-white border border-secondary mt-1" style="height: 10px;width:10px; ;margin-top: 0px !important"></div>
        </div>
        <div class="total-footer text-center bg-abu border border-secondary pt-2" style="width :17.3% ">
            <h5 class="fw-bold" style="margin-top: 0px !important">{{ $penilaian_solo ? 9.1 + $penilaian_solo->attack_skor +  $penilaian_solo->firmness_skor +  $penilaian_solo->soulfulness_skor : "0"}}</h5>
        </div>
    </div>
</div>

@section('script')
    <script>
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