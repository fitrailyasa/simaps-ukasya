<div>
    @include('client.ketua.solo.navbar')
    @if ($tahap == "keputusan")
        <div class="hasil-container text-center p-3" style="height: 50vh">
@php
    if(count($penilaian_solo_juri_merah)%2==0){
        $length = count($penilaian_solo_juri_merah)/2;
    }else{
        $length = (count($penilaian_solo_juri_merah)+1)/2;
    }
    if($penalty_solo_merah){
        $penalty_merah = $penalty_solo_merah->toleransi_waktu+$penalty_solo_merah->keluar_arena+$penalty_solo_merah->menyentuh_lantai+$penalty_solo_merah->pakaian+$penalty_solo_merah->tidak_bergerak;
    }else{
        $penalty_merah = 0;
    }
    $total_merah = 0;
    foreach ($penilaian_solo_juri_merah as $penilaian_juri) {
        $total_merah += $penilaian_juri->skor;
    }
    if(!count($penilaian_solo_juri) == 0){
        $mean_merah = $total_merah / count($penilaian_solo_juri_merah);
    }else{
        $mean_merah = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_merah = 0;
    foreach ($penilaian_solo_juri_merah as $penilaian_juri) {
        $total_diff_squared_merah += pow($penilaian_juri->skor - $mean_merah, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_solo_juri_merah) == 0){
        $standard_deviation_merah = sqrt($total_diff_squared_merah / count($penilaian_solo_juri_merah));
    }else{
        $standard_deviation_merah = 0;
    }

    if(count($penilaian_solo_juri_biru)%2==0){
        $length = count($penilaian_solo_juri_biru)/2;
    }else{
        $length = (count($penilaian_solo_juri_biru)+1)/2;
    }
    if($penalty_solo_biru){
        $penalty_biru = $penalty_solo_biru->toleransi_waktu+$penalty_solo_biru->keluar_arena+$penalty_solo_biru->menyentuh_lantai+$penalty_solo_biru->pakaian+$penalty_solo_biru->tidak_bergerak;
    }else{
        $penalty_biru = 0;
    }    
    $total_biru = 0;
    foreach ($penilaian_solo_juri_biru as $penilaian_juri) {
        $total_biru += $penilaian_juri->skor;
    }
    if(!count($penilaian_solo_juri) == 0){
        $mean_biru = $total_biru / count($penilaian_solo_juri_biru);
    }else{
        $mean_biru = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_biru = 0;
    foreach ($penilaian_solo_juri_biru as $penilaian_juri) {
        $total_diff_squared_biru += pow($penilaian_juri->skor - $mean_biru, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_solo_juri_biru) == 0){
        $standard_deviation_biru = sqrt($total_diff_squared_biru / count($penilaian_solo_juri_biru));
    }else{
        $standard_deviation_biru = 0;
    }
@endphp
     <div class="hasil-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex justify-content-center d-flex" style="width: 50%">
            {{-- <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{ $sudut_biru->img == null ? url('/assets/profile/default.png') : url($sudut_biru->img) }}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div> --}}
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$sudut_biru->nama}}</p>
                <p class="fw-bold" style="font-size: 2rem;color: #0053a6">{{$sudut_biru->kontingen}}</p>
            </div>
        </div>
         <div class="pesilat-b d-flex justify-content-center d-flex" style="width: 50%">
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$sudut_merah->nama}}</p>
                <p class="fw-bold" style="font-size: 2rem;color: #db3545">{{$sudut_merah->kontingen}}</p>
            </div>
            {{-- <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #db3545">
                <img src="{{ $sudut_merah->img == null ? url('/assets/profile/default.png') : url($sudut_merah->img) }}" alt="" style="height: 90%; margin-top: 8px">
            </div> --}}
        </div>
    </div>
    <div class="hasil-body border border-dark mt-5 text-center" style="height: 120%; width: 100%">
        <p class="text-hasil fw-bold" style="font-size: 1.5rem;">Winner</p>
        @if ($jadwal->pemenang == $pengundian_biru->id)
            <p class="fw-bold" style="font-size: 1.2rem; color: #0053a6; margin-top: -24px;">Biru</p>
        @else
            <p class="fw-bold" style="font-size: 1.2rem; color: #db3545;">Merah</p>
        @endif 
        <div class="box d-flex justify-content-center text-center" style="width: 100%;height: 80%;">
            <div class="hasil-akhir border border-dark d-flex gap-1 flex-column" style="width: 80%;height: 100%;">
                <div class="detail-poin d-flex gap-1" style="width: 100%;height: 25%;">
                    <div class="left border border-dark d-flex justify-content-center flex-column" style="width: 50%;height: 100%;background-color: #ececec">
                        <p class="fw-bold" style="font-size: 1.2rem;">Detail Point</p>
                    </div>
                    <div class="right d-flex gap-1 flex-column" style="width: 50%;height: 100%;">
                        <div class="score-result border border-dark" style="width: 100%;height: 50%;background-color: #ececec">
                         <p class="fw-bold" style="font-size: 1.2rem;">Score Result</p>
                        </div>
                        <div class="result d-flex gap-1" style="width: 100%;height: 50%;">
                            <div class="merah border border-dark" style="width: 50%;height: 90%;background-color: #db3545;">
                                 <p class="fw-bold text-white" style="font-size: 1.2rem;">Merah</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 90%;background-color: #0053a6">
                                 <p class="fw-bold text-white" style="font-size: 1.2rem;">Biru</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="performance-time d-flex gap-1  " style="width: 100%;height: 14.3%;">
                    <div class="left border border-dark" style="width: 50%;height: 100%">
                        <p class="fw-bold" style="font-size: 1.2rem;">Performa Waktu</p>
                    </div>
                    <div class="right d-flex gap-1" style="width: 50%;height: 100%;">
                            <div class="merah border border-dark" style="width: 50%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_solo_merah ? sprintf("%02d:%02d", floor($penalty_solo_merah->performa_waktu), ($penalty_solo_merah->performa_waktu*60)%60) : "00:00" }}</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_solo_biru ? sprintf("%02d:%02d", floor($penalty_solo_biru->performa_waktu), ($penalty_solo_biru->performa_waktu*60)%60) : "00:00" }}</p>
                            </div>
                    </div>
                </div>
                <div class="penalty d-flex gap-1  " style="width: 100%;height: 14.3%;">
                    <div class="left border border-dark" style="width: 50%;height: 100%">
                        <p class="fw-bold" style="font-size: 1.2rem;">Penalty</p>
                    </div>
                    <div class="right d-flex gap-1" style="width: 50%;height: 100%;">
                            <div class="merah border border-dark" style="width: 50%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_merah == 0 ? 0 : $penalty_merah * -0.5}}</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_biru == 0 ? 0 : $penalty_biru * -0.5}}</p>
                            </div>
                    </div>
                </div>
                <div class="winning-point d-flex gap-1  " style="width: 100%;height: 28.6%;">
                    <div class="left border border-dark d-flex flex-column justify-content-center" style="width: 50%;height: 100%;background-color: #ececec">
                        <p class="fw-bold" style="font-size: 1.2rem;">Standard Deviation</p>
                    </div>
                    <div class="right d-flex gap-1" style="width: 50%;height: 100%;">
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 50%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_merah}}</p>
                            </div>
                            <div class="biru border border-dark d-flex flex-column justify-content-center" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_biru}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else

@php
    if(count($penilaian_solo_juri) % 2 == 0){
        $length = count($penilaian_solo_juri) / 2;
    } else if(count($penilaian_solo_juri)%2==1){
        $length = (count($penilaian_solo_juri)+1)/2;
    }else{
        $length = 1;
    }
    
    if($penalty_solo){
        $penalty = $penalty_solo->toleransi_waktu + $penalty_solo->keluar_arena + $penalty_solo->menyentuh_lantai + $penalty_solo->pakaian + $penalty_solo->tidak_bergerak;
    } else {
        $penalty = 0;
    }

    $total = 0;
    foreach ($penilaian_solo_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }

    // Mengurutkan array berdasarkan skor
    $sorted_nilai = json_decode($penilaian_solo_juri);
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

    // Menghitung selisih kuadrat dari setiap nilai dengan median
    $total_diff_squared = 0;
    foreach ($penilaian_solo_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $median, 2);
    }

    // Menghitung standar deviasi
    if (count($penilaian_solo_juri) !== 0) {
        $standard_deviation = sqrt($total_diff_squared / $count);
    } else {
        $standard_deviation = 0;
    }
@endphp
    @section('style')
    <link rel="stylesheet" href="{{ url('assets/css/ketua-pertandingan-tunggal.css') }}">
@endsection
    <div class="content p-4" style="width:100%;height: auto">
        <div class="content-header d-flex">
            <div class="biru  d-flex justify-content-between p-2 " style="width: 50%">
                <div class="biru-nama">
                    <h5 class="ml-4 fw-bold">{{$tampil['kontingen']}}</h5>
                    <h4 class="fw-bold mt-4" style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}">{{$tampil['nama']}}</h4>
                </div>
            </div>
            <div class="merah  d-flex justify-content-end p-2" style="width: 50%">
                <div class="merah-nama text-end">
                    <h5 class="fw-bold">{{ $gelanggang->nama }}, Match {{ $jadwal->partai }}</h5>
                    <h4 class="fw-bold mt-4" style="">solo</h4>
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
                @if (!$penilaian_solo_juri || count($penilaian_solo_juri) == 0)
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
                @foreach ($penilaian_solo_juri as $i => $penilaian_juri)
                    <div class="nilai-1" style="width: {{100/$length}}%; height: 100%">
                    <div class="nilai-1-header border border-dark text-center pt-2" style="background-color: #ececec">
                        <h6 class="fw-bold">{{$juris[$i]->name}}</h6>
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
                    @if (count($penilaian_solo_juri) == $length*2)
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
                                        $juri_name = $j->name;
                                    }
                                }
                            @endphp
                        <div class="juri-1 text-center" style="width: {{100/$length}}%">
                            <div class="juri-1-header border border-dark {{( $i  == $length) ? "bg-success" : "bg-primary"}}"
                                style="width: 100%; background-color: #ececec; height: 40%;">
                                <h6 class="fw-bold">
                                    {{$juri_name}}
                                </h6>
                            </div>
                            <div class="juri-1-value border border-dark {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="width: 100%; height: 32%;">
                                <h6 class="fw-bold">
                                    {{$nilai->skor}}
                                </h6>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="median-value text-center mt-3" style="height: 50%%">
                    <div class="border border-dark ">
                        <h6 class="fw-bold pt-3" style="{{$tampil['id'] == $sudut_biru['id'] ? "color:#252c94" : "color:#db3545"}}">
                           {{$median}}
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
                    <h6 class="fw-bold mt-1">{{$median - $penalty *  0.5}}</h6>
                </div>
                <div class="standart-dev border border-dark" style="width:100%;">
                    <h6 class="fw-bold mt-1">{{$standard_deviation}}</h6>
                </div>
            </div>
        </div>
    </div>
@endif
</div>
