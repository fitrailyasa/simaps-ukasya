<div>
    @include('client.ketua.ganda.navbar')
    @section('style')
        @vite('resources/js/layout.js')
    @endsection
    @if ($tahap == "keputusan")
    @include('client.penonton.tgr.hasil')
    @else

@php
    if(count($penilaian_ganda_juri) % 2 == 0){
        $length = count($penilaian_ganda_juri) / 2;
    } else if(count($penilaian_ganda_juri)%2==1){
        $length = (count($penilaian_ganda_juri)+1)/2;
    }else{
        $length = 1;
    }
    
    if($penalty_ganda){
        $penalty = $penalty_ganda->toleransi_waktu + $penalty_ganda->keluar_arena + $penalty_ganda->menyentuh_lantai + $penalty_ganda->pakaian + $penalty_ganda->tidak_bergerak + $penalty_ganda->senjata_jatuh;
    } else {
        $penalty = 0;
    }

    $total = 0;
    foreach ($penilaian_ganda_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }

    // Mengurutkan array berdasarkan skor
    $sorted_nilai = json_decode($penilaian_ganda_juri);
    usort($sorted_nilai, function($a, $b) {
        return $a->skor <=> $b->skor;
    });

    // Menghitung median
    $count = count($sorted_nilai);
    if ($count % 2 == 0 && $count !==0) {
        // Jika jumlah data genap, median adalah rata-rata dari dua nilai tengah
        $median = ($sorted_nilai[$count / 2 - 1]->skor + $sorted_nilai[$count / 2]->skor) / 2;
    } else if($count % 2 == 1 && $count !==0) {
        // Jika jumlah data ganjil, median adalah nilai tengah
        $median = $sorted_nilai[floor($count / 2)]->skor;
    }else{
        $median = 0;
    }

    // Menghitung total skor dan rata-rata (mean)
    $total = 0;
    foreach ($penilaian_ganda_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $count ? $total / $count : 0;

    // Menghitung selisih kuadrat dari setiap nilai dengan mean
    $total_diff_squared = 0;
    foreach ($penilaian_ganda_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi populasi
    $standard_deviation = $count ? sqrt($total_diff_squared / $count) : 0;
@endphp
    @section('style')
    <link rel="stylesheet" href="{{ url('assets/css/ketua-pertandingan-tunggal.css') }}">
@endsection
    <div id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{$gelanggang->id}} class="content pl-4 pr-4" style="width:100%;height: auto">
        <div class="content-header d-flex">
            <div class="biru  d-flex justify-content-between p-2 " style="width: 50%">
                <div class="biru-nama">
                    <h5 class="ml-4 fw-bold">{{$tampil['kontingen']}}</h5>
                    <h4 class="fw-bold mt-4" style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}">{{$tampil['nama']}}</h4>
                </div>
            </div>
            <div class="merah  d-flex justify-content-end p-2" style="width: 50%">
                <div class="merah-nama text-right">
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
                    <div class="flow border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">SOULFULNESS ( 0.01 - 0.30 )</h6>
                    </div>
                    <div class="total border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Total Score</h6>
                    </div>
                </div>
            </div>
            <div class="nilai d-flex gap-1" style="width: 80%; height: 100% !important">
                @if (!$penilaian_ganda_juri || count($penilaian_ganda_juri) == 0)
                    <div class="nilai-1" style="width: {{100}}%; height: 100%">
                    <div class="nilai-1-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">
                            -
                        </h6>
                    </div>
                    <div class="nilai-1-body mt-1">
                        <div class="nilai-1-movement d-flex justify-content-between " style="gap: 4px !important">
                            <div class="merah text-center border border-dark pt-2" style="width: 50%;height: 57px;">
                                <h6 class="fw-bold" style="color:#db3545">-</h6>
                            </div>
                            <div class="biru text-center border border-dark pt-2" style="width: 50%">
                                <h6 class="fw-bold" style="color: #252c94">-</h6>
                            </div>
                        </div>
                        <div class="nilai-1-correctness mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold"style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}">
                                    -
                                </h6>
                            </div>
                        </div>
                        <div class="nilai-1-flow mt-1 " style="height: 100% ;">
                            <div class="biru text-center border border-dark pt-2 d-flex flex-column justify-content-center"
                                style="width: 100%;">
                                <h6 class="fw-bold"style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}">
                                    -
                                </h6>
                            </div>
                        </div>
                        <div class="nilai-1-total mt-1">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%">
                                <h6 class="fw-bold"style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}">
                                    -
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($penilaian_ganda_juri as $i => $penilaian_juri)
                @php
                    $juri_id = $penilaian_juri->juri;

                    // Cari objek juri yang memiliki id yang sesuai dalam array $juri
                    $juri_name = '';
                    foreach ($juris as $j) {
                        if ($j->id == $juri_id) {
                            $juri_name = $j->permissions;
                        }
                    }
                @endphp
                    <div class="nilai-1" style="width: {{100/$length}}%; height: 100%">
                    <div class="nilai-1-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">{{$juri_name}}</h6>
                    </div>
                    <div class="nilai-1-body mt-1">
                        <div class="nilai-1-movement mt-1" style="">
                            <div class="biru text-center border border-dark pt-2" style="width: 100%;height: 57px;">
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
                                style="width: 100%;">
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
                <div class="time-performance d-flex justify-content-between  pb-3" style="width: 100%; height: 46%;">
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
                <div class="sorted-judge d-flex" style="margin-top: -16px;margin-bottom: -16px !important;height: 46%;">
                    @if (!$sorted_nilai)
                        <div class="juri-1 text-center" style="width: {{100}}%">
                            <div class="juri-1-header border border-dark"
                                style="width: 100%; background-color: #ececec; height: 40%;">
                                <h6 class="fw-bold">
                                    -
                                </h6>
                            </div>
                            <div class="juri-1-value border border-dark" style="width: 100%; height: 60%;">
                                <h6 class="fw-bold">
                                    -
                                </h6>
                            </div>
                        </div>
                    @endif
                    @if (count($penilaian_ganda_juri) == $length*2)
                        @foreach ($sorted_nilai as $i => $nilai)
                            @php
                                $juri_id = $nilai->juri;
            
                                // Cari objek juri yang memiliki id yang sesuai dalam array $juri
                                $juri_name = '';
                                foreach ($juris as $j) {
                                    if ($j->id == $juri_id) {
                                        $juri_name = $j->permissions;
                                    }
                                }
                            @endphp
                        <div class="juri-1 text-center" style="width: {{100/$length}}%">
                            <div class="juri-1-header border border-dark {{($i == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}"
                                style="width: 100%; background-color: #ececec; height: 40%;">
                                <h6 class="fw-bold">
                                    {{$juri_name}}
                                </h6>
                            </div>
                            <div class="juri-1-value border border-dark {{($i == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="width: 100%; height: 32%;">
                                <h6 class="fw-bold">
                                    {{$nilai->skor}}
                                </h6>
                            </div>
                        </div>
                        @endforeach      
                    @else
                        @foreach ($sorted_nilai as $i => $nilai)
                            @php
                                $juri_id = $nilai->juri;
            
                                // Cari objek juri yang memiliki id yang sesuai dalam array $juri
                                $juri_name = '';
                                foreach ($juris as $j) {
                                    if ($j->id == $juri_id) {
                                        $juri_name = $j->permissions;
                                    }
                                }
                            @endphp
                        <div class="juri-1 text-center" style="width: {{100/$length}}%">
                            <div class="juri-1-header border border-dark {{( $i  == $length-1) ? "bg-success" : "bg-primary"}}"
                                style="width: 100%; background-color: #ececec; height: 40%;">
                                <h6 class="fw-bold">
                                    {{$juri_name}}
                                </h6>
                            </div>
                            <div class="juri-1-value border border-dark {{( $i  == $length-1) ? "bg-success" : "bg-primary"}}" style="width: 100%; height: 32%;">
                                <h6 class="fw-bold">
                                    {{$nilai->skor}}
                                </h6>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="median-value text-center border border-dark" style="height: 28% ; margin-top: -28px">
                    <div class="border  ">
                        <h6 class="fw-bold pt-3" style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}">
                           {{number_format($median,3)}}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="content-right border border-dark" style="width: 50%">
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">PENAMPILAN MELEWATI BATAS WAKTU</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">
                        {{!$penalty_ganda ||$penalty_ganda->toleransi_waktu == 0 ? "0" : $penalty_ganda->toleransi_waktu  * -0.5}}
                    </h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">PENAMPILAN MELEWATI AREA 10 M</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">
                        {{!$penalty_ganda || $penalty_ganda->keluar_arena == 0 ? "0" : $penalty_ganda->keluar_arena  * -0.5}}
                    </h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">MENJATUHKAN SENJATA, MENYENTUH LANTAI</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">
                        {{!$penalty_ganda ||$penalty_ganda->menyentuh_lantai == 0 ? "0" : $penalty_ganda->menyentuh_lantai  * -0.5}}
                    </h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Pakaian tidak sesuai Aturan (Tanjak atau Samping Fallout)</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">
                        {{!$penalty_ganda ||$penalty_ganda->pakaian == 0 ? "0" : $penalty_ganda->pakaian  * -0.5}}
                    </h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Atlet bertahan dalam satu gerakan selama lebih dari 5 detik</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">
                        {{!$penalty_ganda ||!$penalty_ganda ||$penalty_ganda->tidak_bergerak == 0 ? "0" : $penalty_ganda->tidak_bergerak  * -0.5}}
                    </h6>
                </div>
            </div>
            <div class="row-1 d-flex" style="width: 100%">
                <div class="indikator border border-dark pt-1" style="width: 92%">
                    <h6 class="fw-bold ml-1">Senjata Jatuh Tidak Sesuai Sinopsis</h6>
                </div>
                <div class="nilai border border-dark text-center" style="width: 8%">
                    <h6 class="fw-bold mt-1" style="color: #db3545">
                        {{!$penalty_ganda ||!$penalty_ganda ||$penalty_ganda->senjata_jatuh == 0 ? "0" : $penalty_ganda->senjata_jatuh  * -0.5}}
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
                    <h6 class="fw-bold mt-1">{{number_format($median - $penalty *  0.5,3)}}</h6>
                </div>
                <div class="standart-dev border border-dark" style="width:100%;">
                    <h6 class="fw-bold mt-1">{{number_format($standard_deviation,9)}}</h6>
                </div>
            </div>
        </div>
    </div>
@endif
</div>
