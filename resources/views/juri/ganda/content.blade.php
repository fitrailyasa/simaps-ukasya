<div class="content d-flex flex-column gap-1" style="width: 100%">
    <div class="header d-flex gap-1" style="width: 100%">
        <div class="aside bg-abu text-center border border-secondary" style="width: 17.7%">
            <h5 class="pt-2 fw-bold" style="height: 100%">
                SCORING ELEMENT
            </h5>
        </div>
        <div class="main bg-abu text-center border border-secondary" style="width: 85%;">
            <h5 class="pt-2 fw-bold" style="height: 100%">
                SCORE
            </h5>
        </div>
    </div>
    <div class="content d-flex gap-1" style="width: 100%; height: 100">
        <div class="aside text-center" style="width: 20%;height: 100">
            <div class="row-1 border border-secondary" style="width: 100%; height: 33.6% !important">
                <H6 class="fw-bold" style="height: 100%; margin-top: 25%;">
                    ATTACK DEFENSE TECHNIQUE ( 0.01 - 0.30 )
                </H6>
            </div>
            <div class="row-2 border border-secondary mt-1" style="height: 32.7% !important">
                <H6 class="fw-bold" style="height: 100%; margin-top: 25%;">
                    FIRMNESS AND HARMONY ( 0.01 - 0.30 )
                </H6>
            </div>
            <div class="row-3 border border-secondary mt-1" style="height: 32.3% !important">
                <H6 class="fw-bold" style="height: 100%; margin-top: 25%;">
                    SOULFULNESS ( 0.01 - 0.30 )
                </H6>
            </div>

        </div>
        <div class="main-content text-center  score-detail d-flex flex-column" style="width: 68%;height: 100%; ">
            <div class="row-1 border border-secondary pb-1" style="height: 100%;">
                <div class=" p-2 d-flex flex-row gap-2 mt-1 btn-row" style="width:100% !important ;">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark att-btn-10"
                                style="font-size: 1.2rem; width:10%">
                                0.10
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark att-btn-{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.0{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark att-btn-20"
                                style="font-size: 1.2rem; width:10%">
                                0.20
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark att-btn-1{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.1{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark att-btn-30"
                                style="font-size: 1.2rem; width:10%">
                                0.30
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark att-btn-2{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.2{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="row-2 border border-secondary " style="height: 100%;margin-top: 6px">
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important;">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark firm-btn-10"
                                style="font-size: 1.2rem; width:10%">
                                0.10
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark firm-btn-{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.0{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark firm-btn-20"
                                style="font-size: 1.2rem; width:10%">
                                0.20
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark firm-btn-1{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.1{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark firm-btn-30"
                                style="font-size: 1.2rem; width:10%">
                                0.30
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark firm-btn-2{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.2{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="row-3 border border-secondary" style="height: 100%;margin-top: 6px">
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark soul-btn-10"
                                style="font-size: 1.2rem; width:10%">
                                0.10
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark soul-btn-{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.0{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark soul-btn-20"
                                style="font-size: 1.2rem; width:10%">
                                0.20
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark soul-btn-1{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.1{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
                <div class=" p-2 d-flex flex-row gap-2 btn-row" style="width:100% !important">
                    @for ($i = 1; $i <= 10; $i++)
                        @if ($i == 10)
                            <button class="btn border bg-abu border-dark soul-btn-30"
                                style="font-size: 1.2rem; width:10%">
                                0.30
                            </button>
                        @else
                            <button class="btn border bg-abu border-dark soul-btn-2{{ $i }}"
                                style="font-size: 1.2rem; width:10%">
                                0.2{{ $i }}
                            </button>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <div class="score-sub-total text-center d-flex flex-column" style="width: 7%; gap:5px;">
            <div class="border border-secondary " style="height: 35.3% !important; padding-top: 50% ">
                <h4 class="fw-bold score">SCORE</h4>
                <h4 class="fw-bold" style="color: #0053a6 !important;">0</h4>
            </div>
            <div class="border border-secondary " style="height: 33.7%;padding-top: 50%">
                <h4 class="fw-bold score">SCORE</h4>
                <h4 class="fw-bold" style="color: #0053a6 !important;">0</h4>
            </div>
            <div class="border border-secondary " style="height: 33.5%;padding-top: 50%">
                <h4 class="fw-bold score">SCORE</h4>
                <h4 class="fw-bold" style="color: #0053a6 !important;">0</h4>
            </div>
        </div>
        <div class=" score-total d-flex flex-column justify-content-center text-center  border border-secondary"
            style="width: 20%">
            <h5 class="fw-bold">SCORE TOTAL</h5>
            <span class="fw-bold">-Technique</span>
            <span class="fw-bold">-Firmness</span>
            <span class="fw-bold">-Soulfullness</span>
            <h4 class="fw-bold" style="color: #0053a6 !important;">0</h4>
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
            <h5 class="fw-bold" style="margin-top: 0px !important">0</h5>
        </div>
    </div>
</div>
