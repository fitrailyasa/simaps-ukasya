@extends('layouts.client.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/ketua-pertandingan-tunggal.css') }}">
@endsection
@section('content')
    @include('client.ketua.regu.navbar', ['jenis' => 'REGU', 'class' => 'REGU'])
    <div class="content p-4" style="width:100%;height: auto">
        <div class="content-header d-flex">
            <div class="biru  d-flex justify-content-between p-2 " style="width: 50%">
                <div class="biru-nama">
                    <h5 class="ml-4 fw-bold">{{ $region }}</h5>
                    <h4 class="fw-bold mt-4" style="color:#252c94">{{ $nama[0] }}, {{ $nama[1] }}</h4>
                </div>
            </div>
            <div class="merah  d-flex justify-content-end p-2" style="width: 50%">
                <div class="merah-nama text-end">
                    <h5 class="fw-bold">Arena {{ $arena }}, Match {{ $match }}</h5>
                    <h4 class="fw-bold mt-4" style="">REGU</h4>
                </div>
            </div>
        </div>
        <div class="content-body d-flex " style="gap: 4px !important; width: 100%; height: auto;">
            <div class="indikator" style="width: 20%; height: 100%;">
                <div class="indikator-header border border-dark pt-2 pl-2" style="background-color: #ececec;">
                    <h6 class="fw-bold">Judge</h6>
                </div>
                <div class="indikator-body">
                    <div class="movement border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Movement</h6>
                    </div>
                    <div class="correctness border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">CORRECTNESS SCORE</h6>
                    </div>
                    <div class="flow border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec; height: 76px;">
                        <h6 class="fw-bold">FLOW OF MOVEMENT / STAMIONA (RANGE SCORES 0.01 - 0.10)</h6>
                    </div>
                    <div class="total border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Total Score</h6>
                    </div>
                </div>
            </div>
            <div class="nilai d-flex gap-1" style="width: 80%; height: 100% !important">
                <div class="nilai-1" style="width: 20%; height: 100%">
                    <div class="nilai-1-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">1</h6>
                    </div>
                    <div class="nilai-1-body mt-1">
                        <div class="nilai-1-movement d-flex justify-content-between " style="gap: 4px !important">
                            <div class="merah text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color:#db3545">0</h6>
                            </div>
                            <div class="biru text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-1-correctness mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-1-flow mt-1 " style="height: 100% ;">
                            <div class="biru text-center border border-dark pt-2 d-flex flex-column justify-content-center"
                                style="width: 100%; height: 76px;">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-1-total mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nilai-2" style="width: 20%; height: 100%">
                    <div class="nilai-2-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">2</h6>
                    </div>
                    <div class="nilai-2-body mt-1">
                        <div class="nlai-2-movement d-flex justify-content-between " style="gap: 4px !important">
                            <div class="merah text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color:#db3545">0</h6>
                            </div>
                            <div class="biru text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nlai-2-correctness mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nlai-2-flow mt-1 " style="height: 100% ;">
                            <div class="biru text-center border border-dark pt-2 d-flex flex-column justify-content-center"
                                style="width: 100%; height: 76px;">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nlai-2-total mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="nilai-3" style="width: 20%; height: 100%">
                    <div class="nilai-3-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">3</h6>
                    </div>
                    <div class="nilai-3-body mt-1">
                        <div class="nilai-3-movement d-flex justify-content-between " style="gap: 4px !important">
                            <div class="merah text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color:#db3545">0</h6>
                            </div>
                            <div class="biru text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-3-correctness mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-3-flow mt-1 " style="height: 100% ;">
                            <div class="biru text-center border border-dark pt-2 d-flex flex-column justify-content-center"
                                style="width: 100%; height: 76px;">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-3-total mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nilai-4" style="width: 20%; height: 100%">
                    <div class="nilai-4-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">4</h6>
                    </div>
                    <div class="nilai-4-body mt-1">
                        <div class="nilai-4-movement d-flex justify-content-between " style="gap: 4px !important">
                            <div class="merah text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color:#db3545">0</h6>
                            </div>
                            <div class="biru text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-4-correctness mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-4-flow mt-1 " style="height: 100% ;">
                            <div class="biru text-center border border-dark pt-2 d-flex flex-column justify-content-center"
                                style="width: 100%; height: 76px;">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-4-total mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nilai-5" style="width: 20%; height: 100%">
                    <div class="nilai-5-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">5</h6>
                    </div>
                    <div class="nilai-5-body mt-1">
                        <div class="nilai-5-movement d-flex justify-content-between " style="gap: 4px !important">
                            <div class="merah text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color:#db3545">75.00</h6>
                            </div>
                            <div class="biru text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-5-correctness mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-5-flow mt-1 " style="height: 100% ;">
                            <div class="biru text-center border border-dark pt-2 d-flex flex-column justify-content-center"
                                style="width: 100%; height: 76px;">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                        <div class="nilai-5-total mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">0</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-2 d-flex gap-1 pl-4 pr-4 " style="width:100%;height: 100%">
        <div class="content-left border border-dark d-flex pb-2" style="width: 50%;">
            <div class="indikator" style="width: 30%">
                <div class="time-performance border border-dark pt-2 pl-2 d-flex justify-content-center flex-column"
                    style="width: 100%; height: 31.5%;">
                    <h6 class="fw-bold">Time Performance</h6>
                </div>
                <div class="sorted-judge border border-dark pt-2 pl-2" style="width: 100%;height: 26.5%;">
                    <h6 class="fw-bold">Sorted Judge</h6>
                </div>
                <div class="median border border-dark pt-2 pl-2" style="width: 100%;">
                    <h6 class="fw-bold">Median</h6>
                </div>
            </div>
            <div class="value" style="width: 70%">
                <div class="time-performance d-flex justify-content-between" style="width: 100%">
                    <div class="minutes text-center" style="width: 50%">
                        <div class="minutes-header border border-dark" style="width: 100%">
                            <h6 class="fw-bold">Minutes</h6>
                        </div>
                        <div class="minutes-value border border-dark" style="width: 100%;height: 35%;">
                            <h6 class="fw-bold">0</h6>
                        </div>
                    </div>
                    <div class="second text-center" style="width: 50%">
                        <div class="second-header border border-dark" style="width: 100%">
                            <h6 class="fw-bold">Second</h6>
                        </div>
                        <div class="second-value border border-dark" style="width: 100%;height: 35%;">
                            <h6 class="fw-bold">0</h6>
                        </div>
                    </div>
                </div>
                <div class="sorted-judge d-flex" style="margin-top: -9px;margin-bottom: -24px !important">
                    <div class="juri-1 text-center" style="width: 20%">
                        <div class="juri-1-header border border-dark"
                            style="width: 100%; background-color: #ececec; height: 40%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                        <div class="juri-1-value border border-dark" style="width: 100%; height: 32%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                    </div>
                    <div class="juri-1 text-center" style="width: 20%">
                        <div class="juri-1-header border border-dark"
                            style="width: 100%; background-color: #ececec; height: 40%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                        <div class="juri-1-value border border-dark" style="width: 100%; height: 32%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                    </div>
                    <div class="juri-1 text-center" style="width: 20%">
                        <div class="juri-1-header border border-dark"
                            style="width: 100%; background-color: #ececec; height: 40%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                        <div class="juri-1-value border border-dark" style="width: 100%; height: 32%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                    </div>
                    <div class="juri-1 text-center" style="width: 20%">
                        <div class="juri-1-header border border-dark"
                            style="width: 100%; background-color: #ececec; height: 40%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                        <div class="juri-1-value border border-dark" style="width: 100%; height: 32%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                    </div>
                    <div class="juri-1 text-center" style="width: 20%">
                        <div class="juri-1-header border border-dark"
                            style="width: 100%; background-color: #ececec; height: 40%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                        <div class="juri-1-value border border-dark" style="width: 100%; height: 32%;">
                            <h6 class="fw-bold">-</h6>
                        </div>
                    </div>
                </div>
                <div class="median-value text-center">
                    <div class="border border-dark mt-2">
                        <h6 class="fw-bold pt-2" style="color: #252c94">0</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-right border border-dark" style="width: 50%">
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Performance Exceded tolerance time</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">0</h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Performance Exceded the 10m by 10m arena</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">0</h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Dropping of weapon, touching the floor</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">0</h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Attire is not according to prescription (Tanjak or Samping Fallout)</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">0</h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Athlete staying at one move for more than 5 second</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">0</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="content-3 d-flex pl-4 pr-4 gap-1" style="width: 100%">
        <div class="content-right  text-center" style="width:50%;">
            <div class="final-score border border-dark" style="width:100%;">
                <h6 class="fw-bold mt-1">Final Score</h6>
            </div>
            <div class="standart-dev border border-dark" style="width:100%;">
                <h6 class="fw-bold mt-1">Standart Deviation </h6>
            </div>
        </div>
        <div class="content-left text-center" style="width:50%;">
            <div class="final-score border border-dark" style="width:100%;">
                <h6 class="fw-bold mt-1">0</h6>
            </div>
            <div class="standart-dev border border-dark" style="width:100%;">
                <h6 class="fw-bold mt-1">0</h6>
            </div>
        </div>
    </div>
@endsection
