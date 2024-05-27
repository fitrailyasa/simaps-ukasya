@if ($penalty_tunggal??null)
    @php
    if(count($penilaian_tunggal_juri)%2==0){
        $length = count($penilaian_tunggal_juri)/2;
    }else{
        $length = (count($penilaian_tunggal_juri)+1)/2;
    }
    $penalty = $penalty_tunggal->toleransi_waktu+$penalty_tunggal->keluar_arena+$penalty_tunggal->menyentuh_lantai+$penalty_tunggal->pakaian+$penalty_tunggal->tidak_bergerak;
    $total = 0;
    foreach ($penilaian_tunggal_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $total / count($penilaian_tunggal_juri);
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared = 0;
    foreach ($penilaian_tunggal_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi
    $standard_deviation = sqrt($total_diff_squared / count($penilaian_tunggal_juri));
    
    $sorted_nilai =  json_decode($penilaian_tunggal_juri);
    usort($sorted_nilai, function($a, $b) {
        return $a->skor <=> $b->skor;
    });
@endphp

@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">
                    @if ($tampil == $sudut_biru->id)
                        {{$sudut_biru->nama}}
                    @else
                        {{$sudut_merah->nama}}
                    @endif
                </p>
                <p class="fw-bold" style="font-size: 2rem;{{$tampil == $sudut_biru->id?"color: #0053a6" : "color: #db3545"}}">
                    @if ($tampil == $sudut_biru->id)
                        {{$sudut_biru->region}}
                    @else
                        {{$sudut_merah->region}}
                    @endif    
                </p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($nilai_masuk == false)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil" style="font-size: 2rem;">Timer</p>
                </div>
                <div class="timer-clock">
                    <p class="text-hasil" style="font-size: 3rem;">00:00</p>
                </div>
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                @if (count($penilaian_tunggal_juri) % 2 == 0 )
                                    {{($penilaian_tunggal_juri[$length-1]->skor + $penilaian_tunggal_juri[$length]->skor)/2}}
                                @else
                                    {{$penilaian_tunggal_juri[$length-1]->skor}}
                                @endif
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                {{$penalty == 0 ? "0" : $penalty * -0.5}}
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                {{ sprintf("%02d:%02d", floor($waktu / 60), $waktu % 60) }}
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                {{$mean - $penalty *  0.5}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                {{$standard_deviation}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content mt-5 d-flex text-center" style="width: 100%;height: 40%;">
        @if ($length*2 %2 == 0)
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{($i == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{($i  == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                </div>
            </div>
            @endforeach
        @endif
        
        @for ($i = 1; $i <= 10; $i++)
        
        @endfor
    </div>
</div>

@section('script')
    <script>
        // let rand = Math.floor(Math.random() * 10) + 1;
        // if($(`.box-nilai`)){
        //     $(`.down-${rand}`).removeClass('bg-primary')
        //     $(`.up-${rand}`).removeClass('bg-primary')
        //     $(`.down-${rand}`).addClass('bg-success')
        //     $(`.up-${rand}`).addClass('bg-success')
        // }
    </script>
@endsection
@elseif($penalty_regu??null)
    @php
    if(count($penilaian_regu_juri)%2==0){
        $length = count($penilaian_regu_juri)/2;
    }else{
        $length = (count($penilaian_regu_juri)+1)/2;
    }
    $penalty = $penalty_regu->toleransi_waktu+$penalty_regu->keluar_arena+$penalty_regu->menyentuh_lantai+$penalty_regu->pakaian+$penalty_regu->tidak_bergerak;
    $total = 0;
    foreach ($penilaian_regu_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $total / count($penilaian_regu_juri);
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared = 0;
    foreach ($penilaian_regu_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi
    $standard_deviation = sqrt($total_diff_squared / count($penilaian_regu_juri));
    
    $sorted_nilai =  json_decode($penilaian_regu_juri);
    usort($sorted_nilai, function($a, $b) {
        return $a->skor <=> $b->skor;
    });
@endphp

@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$sudut_biru->nama}}, {{$sudut_merah->nama}}</p>
                <p class="fw-bold" style="font-size: 2rem;color: #0053a6">{{$sudut_biru->region}}</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($nilai_masuk == false)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil" style="font-size: 2rem;">Timer</p>
                </div>
                <div class="timer-clock">
                    <p class="text-hasil" style="font-size: 3rem;">00:00</p>
                </div>
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                @if (count($penilaian_regu_juri) % 2 == 0 )
                                    {{($penilaian_regu_juri[$length-1]->skor + $penilaian_regu_juri[$length]->skor)/2}}
                                @else
                                    {{$penilaian_regu_juri[$length-1]->skor}}
                                @endif
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                {{$penalty == 0 ? "0" : $penalty * -0.5}}
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                {{ sprintf("%02d:%02d", floor($waktu / 60), $waktu % 60) }}
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                {{$mean - $penalty *  0.5}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                {{$standard_deviation}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content mt-5 d-flex text-center" style="width: 100%;height: 40%;">
        @if ($length*2 %2 == 0)
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{($i == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{($i  == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                </div>
            </div>
            @endforeach
        @endif
        
        @for ($i = 1; $i <= 10; $i++)
        
        @endfor
    </div>
</div>

@section('script')
    <script>
        // let rand = Math.floor(Math.random() * 10) + 1;
        // if($(`.box-nilai`)){
        //     $(`.down-${rand}`).removeClass('bg-primary')
        //     $(`.up-${rand}`).removeClass('bg-primary')
        //     $(`.down-${rand}`).addClass('bg-success')
        //     $(`.up-${rand}`).addClass('bg-success')
        // }
    </script>
@endsection
@elseif($penalty_ganda??null)
@php
    if(count($penilaian_ganda_juri)%2==0){
        $length = count($penilaian_ganda_juri)/2;
    }else{
        $length = (count($penilaian_ganda_juri)+1)/2;
    }
    $penalty = $penalty_ganda->toleransi_waktu+$penalty_ganda->keluar_arena+$penalty_ganda->menyentuh_lantai+$penalty_ganda->pakaian+$penalty_ganda->tidak_bergerak;
    $total = 0;
    foreach ($penilaian_ganda_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $total / count($penilaian_ganda_juri);
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared = 0;
    foreach ($penilaian_ganda_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi
    $standard_deviation = sqrt($total_diff_squared / count($penilaian_ganda_juri));
    
    $sorted_nilai =  json_decode($penilaian_ganda_juri);
    usort($sorted_nilai, function($a, $b) {
        return $a->skor <=> $b->skor;
    });
@endphp

@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$sudut_biru->nama}}, {{$sudut_merah->nama}}</p>
                <p class="fw-bold" style="font-size: 2rem;color: #0053a6">{{$sudut_biru->region}}</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($nilai_masuk == false)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil" style="font-size: 2rem;">Timer</p>
                </div>
                <div class="timer-clock">
                    <p class="text-hasil" style="font-size: 3rem;">00:00</p>
                </div>
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                @if (count($penilaian_ganda_juri) % 2 == 0 )
                                    {{($penilaian_ganda_juri[$length-1]->skor + $penilaian_ganda_juri[$length]->skor)/2}}
                                @else
                                    {{$penilaian_ganda_juri[$length-1]->skor}}
                                @endif
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                {{$penalty == 0 ? "0" : $penalty * -0.5}}
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                {{ sprintf("%02d:%02d", floor($waktu / 60), $waktu % 60) }}
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                {{$mean - $penalty *  0.5}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                {{$standard_deviation}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content mt-5 d-flex text-center" style="width: 100%;height: 40%;">
        @if ($length*2 %2 == 0)
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{($i == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{($i  == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                </div>
            </div>
            @endforeach
        @endif
        
        @for ($i = 1; $i <= 10; $i++)
        
        @endfor
    </div>
</div>

@section('script')
    <script>
        // let rand = Math.floor(Math.random() * 10) + 1;
        // if($(`.box-nilai`)){
        //     $(`.down-${rand}`).removeClass('bg-primary')
        //     $(`.up-${rand}`).removeClass('bg-primary')
        //     $(`.down-${rand}`).addClass('bg-success')
        //     $(`.up-${rand}`).addClass('bg-success')
        // }
    </script>
@endsection

@elseif($penalty_solo??null)
@php
    if(count($penilaian_solo_juri)%2==0){
        $length = count($penilaian_solo_juri)/2;
    }else{
        $length = (count($penilaian_solo_juri)+1)/2;
    }
    $penalty = $penalty_solo->toleransi_waktu+$penalty_solo->keluar_arena+$penalty_solo->menyentuh_lantai+$penalty_solo->pakaian+$penalty_solo->tidak_bergerak;
    $total = 0;
    foreach ($penilaian_solo_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $total / count($penilaian_solo_juri);
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared = 0;
    foreach ($penilaian_solo_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi
    $standard_deviation = sqrt($total_diff_squared / count($penilaian_solo_juri));
    
    $sorted_nilai =  json_decode($penilaian_solo_juri);
    usort($sorted_nilai, function($a, $b) {
        return $a->skor <=> $b->skor;
    });
@endphp

@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$sudut->nama}}</p>
                <p class="fw-bold" style="font-size: 2rem;color: #0053a6">{{$sudut->region}}</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($nilai_masuk == false)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil" style="font-size: 2rem;">Timer</p>
                </div>
                <div class="timer-clock">
                    <p class="text-hasil" style="font-size: 3rem;">00:00</p>
                </div>
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                @if (count($penilaian_solo_juri) % 2 == 0 )
                                    {{($penilaian_solo_juri[$length-1]->skor + $penilaian_solo_juri[$length]->skor)/2}}
                                @else
                                    {{$penilaian_solo_juri[$length-1]->skor}}
                                @endif
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                {{$penalty == 0 ? "0" : $penalty * -0.5}}
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                {{ sprintf("%02d:%02d", floor($waktu / 60), $waktu % 60) }}
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                {{$mean - $penalty *  0.5}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                {{$standard_deviation}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content mt-5 d-flex text-center" style="width: 100%;height: 40%;">
        @if ($length*2 %2 == 0)
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{($i == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{($i  == $length-1 || $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
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
                <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                <div class="up-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                </div>
                <div class="down-{{$i}} {{( $i  == $length) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                    <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                </div>
            </div>
            @endforeach
        @endif
        
        @for ($i = 1; $i <= 10; $i++)
        
        @endfor
    </div>
</div>

@section('script')
    <script>
        // let rand = Math.floor(Math.random() * 10) + 1;
        // if($(`.box-nilai`)){
        //     $(`.down-${rand}`).removeClass('bg-primary')
        //     $(`.up-${rand}`).removeClass('bg-primary')
        //     $(`.down-${rand}`).addClass('bg-success')
        //     $(`.up-${rand}`).addClass('bg-success')
        // }
    </script>
@endsection
@endif

