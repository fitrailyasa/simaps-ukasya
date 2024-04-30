<div>
    @php
    $length = count($penilaian_ganda_juri);
    $penalty = $penalty_ganda->toleransi_waktu+$penalty_ganda->keluar_arena+$penalty_ganda->menyentuh_lantai+$penalty_ganda->pakaian+$penalty_ganda->tidak_bergerak+$penalty_ganda->senjata_jatuh;
    $total = 0;
    foreach ($penilaian_ganda_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $total / count($penilaian_ganda_juri);
    $total = $mean - $penalty * 0.5;
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared = 0;
    foreach ($penilaian_ganda_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi
    $standard_deviation = sqrt($total_diff_squared / count($penilaian_ganda_juri));
    // Menyortir array penilaian_ganda_juri berdasarkan skor dari terkecil ke terbesar
    $sorted_nilai =  json_decode($penilaian_ganda_juri);
    usort($sorted_nilai, function($a, $b) {
        return $a->skor <=> $b->skor;
    });
@endphp
    @section('style')
    <link rel="stylesheet" href="{{ url('assets/css/ketua-pertandingan-tunggal.css') }}">
@endsection
    @include('client.ketua.ganda.navbar')
    <div class="content p-4" style="width:100%;height: auto">
        <div class="content-header d-flex">
            <div class="biru  d-flex justify-content-between p-2 " style="width: 50%">
                <div class="biru-nama">
                    <h5 class="ml-4 fw-bold">{{ $sudut_merah->region }}, {{ $sudut_biru->region }}</h5>
                    <h4 class="fw-bold mt-4" style="color:#252c94">{{ $sudut_merah->nama }}, {{ $sudut_biru->nama }}</h4>
                </div>
            </div>
            <div class="merah  d-flex justify-content-end p-2" style="width: 50%">
                <div class="merah-nama text-end">
                    <h5 class="fw-bold">{{ $gelanggang->nama }}, Match {{ $jadwal->partai }}</h5>
                    <h4 class="fw-bold mt-4" style="">GANDA</h4>
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
                        <h6 class="fw-bold">ATTACK DEFENSE TECHNIQUE ( 0.01 - 0.30 )</h6>
                    </div>
                    <div class="correctness border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">FIRMNESS AND HARMONY ( 0.01 - 0.30 )</h6>
                    </div>
                    <div class="flow border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec; height: 76px;">
                        <h6 class="fw-bold">SOULFULNESS ( 0.01 - 0.30 )</h6>
                    </div>
                    <div class="total border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Total Score</h6>
                    </div>
                </div>
            </div>
            <div class="nilai d-flex gap-1" style="width: 80%; height: 100% !important">
                @foreach ($penilaian_ganda_juri as $i => $penilaian_juri)
                    <div class="nilai-1" style="width: {{100/$length}}%; height: 100%">
                    <div class="nilai-1-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">{{$juris[$i]->name}}</h6>
                    </div>
                    <div class="nilai-1-body mt-1">
                        <div class="nilai-1-movement mt-1" style="">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">{{$penilaian_juri->attack_skor}}</h6>
                            </div>
                        </div>
                        <div class="nilai-1-correctness mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">{{$penilaian_juri->firmness_skor}}</h6>
                            </div>
                        </div>
                        <div class="nilai-1-flow mt-1 " style="height: 100% ;">
                            <div class="biru text-center border border-dark pt-2 d-flex flex-column justify-content-center"
                                style="width: 100%; height: 76px;">
                                <h6 class="fw-bold" style="color: #252c94">{{$penilaian_juri->soulfulness_skor}}</h6>
                            </div>
                        </div>
                        <div class="nilai-1-total mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold" style="color: #252c94">{{$penilaian_juri->skor}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="content-2 d-flex flex-column gap-1 pl-4 pr-4 " style="width:100%;height: 100%">
        <div class="content-left border border-dark d-flex " style="width: 100%;">
            <div class="indikator" style="width: 30%">
                <div class="time-performance border border-dark pt-2 pl-2 d-flex justify-content-center flex-column"
                    style="width: 100%; height: 38.5%;">
                    <h6 class="fw-bold">Time Performance</h6>
                </div>
                <div class="sorted-judge border border-dark pt-2 pl-2" style="width: 100%;height: 32.5%;">
                    <h6 class="fw-bold">Sorted Judge</h6>
                </div>
                <div class="median border border-dark pt-2 pl-2" style="width: 100%; height: 29.5%;">
                    <h6 class="fw-bold">Median</h6>
                </div>
            </div>
            <div class="value" style="width: 70%">
                <div class="time-performance d-flex justify-content-between  pb-3" style="width: 100%">
                    <div class="minutes text-center" style="width: 50%">
                        <div class="minutes-header border border-dark" style="width: 100% ;height: 65%">
                            <h6 class="fw-bold">Minutes</h6>
                        </div>
                        <div class="minutes-value border border-dark" style="width: 100%;height: 35%;">
                            <h6 class="fw-bold">{{ sprintf("%2d", floor($waktu / 60)) }}</h6>
                        </div>
                    </div>
                    <div class="second text-center" style="width: 50%">
                        <div class="second-header border border-dark" style="width: 100%;height: 65%">
                            <h6 class="fw-bold">Second</h6>
                        </div>
                        <div class="second-value border border-dark" style="width: 100%;height: 35%;">
                            <h6 class="fw-bold">{{ sprintf("%2d", $waktu % 60) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="sorted-judge d-flex" style="margin-top: -16px;margin-bottom: -16px !important">
                     @foreach ($sorted_nilai as $i => $nilai)
                        @php
                            $juri_id = $nilai->juri;
        
                            // Cari objek juri yang memiliki id yang sesuai dalam array $juri
                            $juri_name = '';
                            foreach ($juris as $j) {
                                if ($j->id == $juri_id) {
                                    $juri_name = $j->name;
                                }
                            }
                        @endphp
                        <div class="juri-1 text-center" style="width: {{100/$length}}%">
                        <div class="juri-1-header border border-dark"
                            style="width: 100%; background-color: #ececec; height: 50%;">
                            <h6 class="fw-bold">{{$juri_name}}</h6>
                        </div>
                        <div class="juri-1-value border border-dark" style="width: 100%; height: 50%;">
                            <h6 class="fw-bold">{{$nilai->skor}}</h6>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="median-value text-center mt-3" style="height: 50%%">
                    <div class="border border-dark ">
                        <h6 class="fw-bold pt-3" style="color: #252c94">
                            @if (count($penilaian_ganda_juri) % 2 == 0 )
                                    {{($penilaian_ganda_juri[$length-1]->skor + $penilaian_ganda_juri[$length]->skor)/2}}
                                @else
                                    {{$penilaian_ganda_juri[$length-1]->skor}}
                                @endif
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-3 d-flex  gap-1" style="width:100%;height: 100%">
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
                    <h6 class="fw-bold mt-1">{{$total}}</h6>
                </div>
                <div class="standart-dev border border-dark" style="width:100%;">
                    <h6 class="fw-bold mt-1">{{$standard_deviation}}</h6>
                </div>
            </div>
    </div>
</div>
