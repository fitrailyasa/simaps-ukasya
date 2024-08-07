@if ($jenis == "tunggal")
    @php
    if(count($penilaian_tunggal_juri) % 2 == 0){
        $length = count($penilaian_tunggal_juri) / 2;
    } else if(count($penilaian_tunggal_juri)%2==1){
        $length = (count($penilaian_tunggal_juri)+1)/2;
    }else{
        $length = 1;
    }
    
    if($penalty_tunggal){
        $penalty = $penalty_tunggal->toleransi_waktu + $penalty_tunggal->keluar_arena + $penalty_tunggal->menyentuh_lantai + $penalty_tunggal->pakaian + $penalty_tunggal->tidak_bergerak;
    } else {
        $penalty = 0;
    }

    $total = 0;
    foreach ($penilaian_tunggal_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }

    // Mengurutkan array berdasarkan skor
    $sorted_nilai = json_decode($penilaian_tunggal_juri);
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
    foreach ($penilaian_tunggal_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $count ? $total / $count : 0;

    // Menghitung selisih kuadrat dari setiap nilai dengan mean
    $total_diff_squared = 0;
    foreach ($penilaian_tunggal_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi populasi
    $standard_deviation = $count ? sqrt($total_diff_squared / $count) : 0;
@endphp


@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{$gelanggang->id}} class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%; ">
                <img src="{{ $tampil["img"] == null ? url('/assets/profile/default.webp') : url("/assets/img/".$tampil["img"]) }}" alt="" style="border-radius: 50%; margin-top: 8px;{{$tampil['id'] == $sudut_biru['id'] ? "background-color: #0053a6" : "background-color: #db3545"}}" height="200" width="200">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$tampil['nama']}}</p>
                <p class="fw-bold" style="font-size: 2rem;{{$tampil['id'] == $sudut_biru['id'] ? "color: #0053a6" : "color: #db3545"}}">{{$tampil['kontingen']}}</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($mulai == true || $jadwal->tahap == "tampil")
            {{-- @if ($gelanggang->waktu != 0)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil fw-bold" style="font-size: 2rem;">Waktu</p>
                </div>
                    <div class="timer-clock">
                        <p class="text-hasil fw-bold" style="font-size: 3rem;">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</p>
                    </div>
                @endif --}}
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">{{number_format($median,3)}}</h3>
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty == 0 ? "0" : $penalty * -0.5}}
                                </h3>
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty_tunggal ? sprintf("%02d:%02d", floor($penalty_tunggal->performa_waktu), ($penalty_tunggal->performa_waktu*60)%60) : "00:00"}}
                                </h3>
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{number_format($median - $penalty * 0.5,3)}}
                                </h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                <h3 class="fw-bold mt-1" style="">
                                    {{number_format($standard_deviation,9)}}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content d-flex text-center" style="width: 100%;height: 40%;margin-top: 80px !important">
        @if ($tampil_nilai == true) 
            @if (count($penilaian_tunggal_juri) == $length*2)
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
                                $juri_name = $j->permissions;
                            }
                        }
                    @endphp
                    <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                    <div class="up-{{$i}} {{( $i  == $length-1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                        <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                    </div>
                    <div class="down-{{$i}} {{( $i  == $length-1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                        <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                    </div>
                </div>
                @endforeach
            @endif
        @endif
    </div>
</div>

@section('script')
    <script>
        setInterval(() => {
            @this.call('kurangiWaktu')
        }, 1600);
    </script>
@endsection
@elseif($jenis == "regu")
    @php
    if(count($penilaian_regu_juri) % 2 == 0){
        $length = count($penilaian_regu_juri) / 2;
    } else if(count($penilaian_regu_juri)%2==1){
        $length = (count($penilaian_regu_juri)+1)/2;
    }else{
        $length = 1;
    }
    
    if($penalty_regu){
        $penalty = $penalty_regu->toleransi_waktu + $penalty_regu->keluar_arena + $penalty_regu->menyentuh_lantai + $penalty_regu->pakaian + $penalty_regu->tidak_bergerak;
    } else {
        $penalty = 0;
    }

    $total = 0;
    foreach ($penilaian_regu_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }

    // Mengurutkan array berdasarkan skor
    $sorted_nilai = json_decode($penilaian_regu_juri);
    usort($sorted_nilai, function($a, $b) {
        return $a->skor <=> $b->skor;
    });

    // Menghitung median
    $count = count($sorted_nilai);
    if ($count % 2 == 0 && $count !=0) {
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
    foreach ($penilaian_regu_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $count ? $total / $count : 0;

    // Menghitung selisih kuadrat dari setiap nilai dengan mean
    $total_diff_squared = 0;
    foreach ($penilaian_regu_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi populasi
    $standard_deviation = $count ? sqrt($total_diff_squared / $count) : 0;
@endphp

@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{$gelanggang->id}} class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%; ">
                <img src="{{ $tampil["img"] == null ? url('/assets/profile/default.webp') : url("/assets/img/".$tampil["img"]) }}" alt="" style="border-radius: 50%; margin-top: 8px;{{$tampil['id'] == $sudut_biru['id'] ? "background-color: #0053a6" : "background-color: #db3545"}}" height="200" width="200">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$tampil['nama']}}</p>
                <p class="fw-bold" style="font-size: 2rem;{{$tampil['id'] == $sudut_biru['id'] ? "color: #0053a6" : "color: #db3545"}}">{{$tampil['kontingen']}}</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($mulai == true || $jadwal->tahap == "tampil")
            {{-- @if ($gelanggang->waktu != 0)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil fw-bold" style="font-size: 2rem;">Waktu</p>
                </div>
                    <div class="timer-clock">
                        <p class="text-hasil fw-bold" style="font-size: 3rem;">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</p>
                    </div>
                @endif --}}
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">{{number_format($median,3)}}</h3>
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty == 0 ? "0" : $penalty * -0.5}}
                                </h3>
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty_regu ? sprintf("%02d:%02d", floor($penalty_regu->performa_waktu), ($penalty_regu->performa_waktu*60)%60) : "00:00"}}
                                </h3>
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{number_format($median - $penalty * 0.5,3)}}
                                </h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                <h3 class="fw-bold mt-1" style="">
                                    {{number_format($standard_deviation,9)}}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content d-flex text-center" style="width: 100%;height: 40%;margin-top: 80px !important">
        @if ($tampil_nilai == true) 
            @if (count($penilaian_regu_juri) == $length*2)
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
                                $juri_name = $j->permissions;
                            }
                        }
                    @endphp
                    <div class="box gap-1 p-1 d-flex flex-column jsutfy-content-center" style="width: {{100/$length*2}}%">
                    <div class="up-{{$i}} {{( $i  == $length-1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                        <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                    </div>
                    <div class="down-{{$i}} {{( $i  == $length-1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                        <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                    </div>
                </div>
                @endforeach
            @endif
        @endif
    </div>
</div>

@section('script')
    <script>
        setInterval(() => {
            @this.call('kurangiWaktu')
        }, 1600);
    </script>
@endsection
@elseif($jenis == "ganda")
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
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{$gelanggang->id}} class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; {{$tampil['id'] == $sudut_biru['id'] ? "background-color: #0053a6" : "background-color: #db3545"}}">
                <img src="{{ $tampil["img"] == null ? url('/assets/profile/default.webp') : url("/assets/img/".$tampil["img"]) }}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$tampil['nama']}}</p>
                <p class="fw-bold" style="font-size: 2rem;{{$tampil['id'] == $sudut_biru['id'] ? "color: #0053a6" : "color: #db3545"}}">{{$tampil['kontingen']}}</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($mulai == true  || $jadwal->tahap == "tampil")
            {{-- @if ($gelanggang->waktu != 0)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil fw-bold" style="font-size: 2rem;">Waktu</p>
                </div>
                    <div class="timer-clock">
                        <p class="text-hasil fw-bold" style="font-size: 3rem;">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</p>
                    </div>
                @endif --}}
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">{{number_format($median,3)}}</h3>
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty == 0 ? "0" : $penalty * -0.5}}
                                </h3>
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty_ganda ? sprintf("%02d:%02d", floor($penalty_ganda->performa_waktu), ($penalty_ganda->performa_waktu*60)%60) : "00:00"}}
                                </h3>
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{number_format($median - $penalty * 0.5,3)}}
                                </h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                <h3 class="fw-bold mt-1" style="">
                                    {{number_format($standard_deviation,9)}}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content mt-5 d-flex text-center" style="width: 100%;height: 40%;">
        @if ($tampil_nilai == true)
            
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
                    <div class="box gap-1 p-1 d-flex flex-column justify-content-center" style="width: {{100/$length*2}}%">
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
                                $juri_name = $j->permissions;
                            }
                        }
                    @endphp
                    <div class="box gap-1 p-1 d-flex flex-column justify-content-center" style="width: {{100/$length*2}}%">
                        <div class="up-{{$i}} {{( $i  == $length -1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                            <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                        </div>
                        <div class="down-{{$i}} {{( $i  == $length -1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                            <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>

@section('script')
    <script>
        setInterval(() => {
            @this.call('kurangiWaktu')
        }, 1600);
    </script>
@endsection

@elseif($jenis == "solo")
@php
    if(count($penilaian_solo_juri) % 2 == 0){
        $length = count($penilaian_solo_juri) / 2;
    } else if(count($penilaian_solo_juri)%2==1){
        $length = (count($penilaian_solo_juri)+1)/2;
    }else{
        $length = 1;
    }
    
    if($penalty_solo){
        $penalty = $penalty_solo->toleransi_waktu + $penalty_solo->keluar_arena + $penalty_solo->menyentuh_lantai + $penalty_solo->pakaian + $penalty_solo->tidak_bergerak + $penalty_solo->senjata_jatuh;
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

    

    // Menghitung total skor dan rata-rata (mean)
    $total = 0;
    foreach ($penilaian_solo_juri as $penilaian_juri) {
        $total += $penilaian_juri->skor;
    }
    $mean = $count ? $total / $count : 0;

    // Menghitung selisih kuadrat dari setiap nilai dengan mean
    $total_diff_squared = 0;
    foreach ($penilaian_solo_juri as $penilaian_juri) {
        $total_diff_squared += pow($penilaian_juri->skor - $mean, 2);
    }

    // Menghitung standar deviasi populasi
    $standard_deviation = $count ? sqrt($total_diff_squared / $count) : 0;
@endphp

@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

<div id="jadwal" data-id="{{ $jadwal->id }}" gelanggang-id={{$gelanggang->id}} class="tanding-container p-3 " style="height: 50vh;">
    <div class="tanding-header d-flex" style="height: 40%; width: 100%">
        <div class="pesilat-a d-flex" style="width: 50%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 19%;border-radius: 50%; {{$tampil['id'] == $sudut_biru['id'] ? "background-color: #0053a6" : "background-color: #db3545"}}">
                <img src="{{ $tampil["img"] == null ? url('/assets/profile/default.webp') : url("/assets/img/".$tampil["img"]) }}" alt="" style="height: 90%; margin-top: 8px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <p class="fw-bold" style="font-size: 2rem;">{{$tampil['nama']}}</p>
                <p class="fw-bold" style="font-size: 2rem;{{$tampil['id'] == $sudut_biru['id'] ? "color: #0053a6" : "color: #db3545"}}">{{$tampil['kontingen']}}</p>
            </div>
        </div>
        <div class="timer d-flex flex-column text-center" style="width: 50%">
            @if ($mulai == true  || $jadwal->tahap == "tampil")
            {{-- @if ($gelanggang->waktu != 0)
                <div class="timer-text" style="height: 40%">
                    <p class="text-hasil fw-bold" style="font-size: 2rem;">Waktu</p>
                </div>
                    <div class="timer-clock">
                        <p class="text-hasil fw-bold" style="font-size: 3rem;">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</p>
                    </div>
                @endif --}}
            @else
                <div class="box-nilai"  style="height: 100%">
                    <div class="up d-flex" style="height: 50%">
                        <div class="median border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success " style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Median</p>
                            </div>
                            <div class="median-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">{{number_format($median,3)}}</h3>
                            </div>
                        </div>
                        <div class="penalty border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Penalty</p>
                            </div>
                            <div class="penalty-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty == 0 ? "0" : $penalty * -0.5}}
                                </h3>
                            </div>
                        </div>
                        <div class="time-performance border border-dark" style="height: 100%;width: 40%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Time Performance</p>
                            </div>
                            <div class="time-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{$penalty_solo ? sprintf("%02d:%02d", floor($penalty_solo->performa_waktu), ($penalty_solo->performa_waktu*60)%60) : "00:00"}}
                                </h3>
                            </div>
                        </div>
                        <div class="total border border-dark" style="height: 100%;width: 20%">
                            <div class="header bg-success" style="height: 50%">
                                <p class="text-hasil fw-bold" style="font-size: 1.3rem; color: #fff">Total</p>
                            </div>
                            <div class="total-nilai">
                                <h3 class="fw-bold" style="margin-top: -16px">
                                    {{number_format($median - $penalty * 0.5,3)}}
                                </h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="down" style="height: 50%">
                      <div class="standard border border-dark" style="height: 100%;width: 100%">
                            <div class="header bg-success pb-2" style="height: 30%">
                                <p class="text-hasil fw-bold" style="font-size: 1rem; color: #fff;margin-top: ;">Standard Deviation</p>
                            </div>
                            <div class="standard-nilai">
                                <h3 class="fw-bold mt-1" style="">
                                    {{number_format($standard_deviation,9)}}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="tgr-content mt-5 d-flex text-center" style="width: 100%;height: 40%;">
        @if ($tampil_nilai == true)
            
            @if (count($penilaian_solo_juri) == $length*2)
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
                    <div class="box gap-1 p-1 d-flex flex-column justify-content-center" style="width: {{100/$length*2}}%">
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
                                $juri_name = $j->permissions;
                            }
                        }
                    @endphp
                    <div class="box gap-1 p-1 d-flex flex-column justify-content-center" style="width: {{100/$length*2}}%">
                        <div class="up-{{$i}} {{( $i  == $length -1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                            <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{$juri_name}}</p>
                        </div>
                        <div class="down-{{$i}} {{( $i  == $length -1) ? "bg-success" : "bg-primary"}}" style="height: 50%;width: 100%">
                            <p class="text-hasil fw-bold mt-1" style="font-size: 2rem;">{{number_format($nilai->skor,2)}}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    </div>
</div>

@section('script')
    <script>
        setInterval(() => {
            @this.call('kurangiWaktu')
        }, 1600);
    </script>
@endsection
@endif

