@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tgr.css')}}">
@endsection

@if ($jenis == "tunggal")
<div class="hasil-container text-center p-3" style="height: 50vh">
@php
    if(count($penilaian_tunggal_juri_merah)%2==0){
        $length = count($penilaian_tunggal_juri_merah)/2;
    }else{
        $length = (count($penilaian_tunggal_juri_merah)+1)/2;
    }
    if($penalty_tunggal_merah){
        $penalty_merah = $penalty_tunggal_merah->toleransi_waktu+$penalty_tunggal_merah->keluar_arena+$penalty_tunggal_merah->menyentuh_lantai+$penalty_tunggal_merah->pakaian+$penalty_tunggal_merah->tidak_bergerak;
    }else{
        $penalty_merah = 0;
    }
    $total_merah = 0;
    foreach ($penilaian_tunggal_juri_merah as $penilaian_juri) {
        $total_merah += $penilaian_juri->skor;
    }
    if(!count($penilaian_tunggal_juri_merah) == 0){
        $mean_merah = $total_merah / count($penilaian_tunggal_juri_merah);
    }else{
        $mean_merah = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_merah = 0;
    foreach ($penilaian_tunggal_juri_merah as $penilaian_juri) {
        $total_diff_squared_merah += pow($penilaian_juri->skor - $mean_merah, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_tunggal_juri_merah) == 0){
        $standard_deviation_merah = sqrt($total_diff_squared_merah / count($penilaian_tunggal_juri_merah));
    }else{
        $standard_deviation_merah = 0;
    }

    if(count($penilaian_tunggal_juri_biru)%2==0){
        $length = count($penilaian_tunggal_juri_biru)/2;
    }else{
        $length = (count($penilaian_tunggal_juri_biru)+1)/2;
    }
    if($penalty_tunggal_biru){
        $penalty_biru = $penalty_tunggal_biru->toleransi_waktu+$penalty_tunggal_biru->keluar_arena+$penalty_tunggal_biru->menyentuh_lantai+$penalty_tunggal_biru->pakaian+$penalty_tunggal_biru->tidak_bergerak;
    }else{
        $penalty_biru = 0;
    }
    $total_biru = 0;
    foreach ($penilaian_tunggal_juri_biru as $penilaian_juri) {
        $total_biru += $penilaian_juri->skor;
    }
    if(!count($penilaian_tunggal_juri) == 0){
        $mean_biru = $total_biru / count($penilaian_tunggal_juri_biru);
    }else{
        $mean_biru = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_biru = 0;
    foreach ($penilaian_tunggal_juri_biru as $penilaian_juri) {
        $total_diff_squared_biru += pow($penilaian_juri->skor - $mean_biru, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_tunggal_juri_biru) == 0){
        $standard_deviation_biru = sqrt($total_diff_squared_biru / count($penilaian_tunggal_juri_biru));
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
         <div class="pesilat-b d-flex justify-content-center" style="width: 50%">
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
                <div class="standard-deviation d-flex gap-1  " style="width: 100%;height: 14.3%;">
                    <div class="left border border-dark" style="width: 50%;height: 100%">
                        <p class="fw-bold" style="font-size: 1.2rem;">Standar Deviasi</p>
                    </div>
                    <div class="right d-flex gap-1" style="width: 50%;height: 100%;">
                            <div class="merah border border-dark" style="width: 50%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_merah}}</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_biru}}</p>
                            </div>
                    </div>
                </div>  
                <div class="performance-time d-flex gap-1  " style="width: 100%;height: 14.3%;">
                    <div class="left border border-dark" style="width: 50%;height: 100%">
                        <p class="fw-bold" style="font-size: 1.2rem;">Performa Waktu</p>
                    </div>
                    <div class="right d-flex gap-1" style="width: 50%;height: 100%;">
                            <div class="merah border border-dark" style="width: 50%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{ $penalty_tunggal_merah ? sprintf("%02d:%02d", floor($penalty_tunggal_merah->performa_waktu), ($penalty_tunggal_merah->performa_waktu*60)%60) : "00:00"  }}</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_tunggal_biru ? sprintf("%02d:%02d", floor($penalty_tunggal_biru->performa_waktu), ($penalty_tunggal_biru->performa_waktu*60)%60) : "00:00" }}</p>
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
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_merah}}</p>
                            </div>
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 10%;height: 100%;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">-</p>
                            </div>
                            <div class="biru border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_biru}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif ($jenis == "regu")
<div class="hasil-container text-center p-3" style="height: 50vh">
@php
    if(count($penilaian_regu_juri_merah)%2==0){
        $length = count($penilaian_regu_juri_merah)/2;
    }else{
        $length = (count($penilaian_regu_juri_merah)+1)/2;
    }
    if($penalty_regu_merah){
        $penalty_merah = $penalty_regu_merah->toleransi_waktu+$penalty_regu_merah->keluar_arena+$penalty_regu_merah->menyentuh_lantai+$penalty_regu_merah->pakaian+$penalty_regu_merah->tidak_bergerak;
    }else{
        $penalty_merah = 0;
    }
    $total_merah = 0;
    foreach ($penilaian_regu_juri_merah as $penilaian_juri) {
        $total_merah += $penilaian_juri->skor;
    }
    if(!count($penilaian_regu_juri) == 0){
        $mean_merah = $total_merah / count($penilaian_regu_juri_merah);
    }else{
        $mean_merah = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_merah = 0;
    foreach ($penilaian_regu_juri_merah as $penilaian_juri) {
        $total_diff_squared_merah += pow($penilaian_juri->skor - $mean_merah, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_regu_juri_merah) == 0){
        $standard_deviation_merah = sqrt($total_diff_squared_merah / count($penilaian_regu_juri_merah));
    }else{
        $standard_deviation_merah = 0;
    }

    if(count($penilaian_regu_juri_biru)%2==0){
        $length = count($penilaian_regu_juri_biru)/2;
    }else{
        $length = (count($penilaian_regu_juri_biru)+1)/2;
    }
    if($penalty_regu_biru){
        $penalty_biru = $penalty_regu_biru->toleransi_waktu+$penalty_regu_biru->keluar_arena+$penalty_regu_biru->menyentuh_lantai+$penalty_regu_biru->pakaian+$penalty_regu_biru->tidak_bergerak;
    }else{
        $penalty_biru = 0;
    }
    $total_biru = 0;
    foreach ($penilaian_regu_juri_biru as $penilaian_juri) {
        $total_biru += $penilaian_juri->skor;
    }
    if(!count($penilaian_regu_juri) == 0){
        $mean_biru = $total_biru / count($penilaian_regu_juri_biru);
    }else{
        $mean_biru = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_biru = 0;
    foreach ($penilaian_regu_juri_biru as $penilaian_juri) {
        $total_diff_squared_biru += pow($penilaian_juri->skor - $mean_biru, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_regu_juri_biru) == 0){
        $standard_deviation_biru = sqrt($total_diff_squared_biru / count($penilaian_regu_juri_biru));
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
                <div class="standard-deviation d-flex gap-1  " style="width: 100%;height: 14.3%;">
                    <div class="left border border-dark" style="width: 50%;height: 100%">
                        <p class="fw-bold" style="font-size: 1.2rem;">Standar Deviasi</p>
                    </div>
                    <div class="right d-flex gap-1" style="width: 50%;height: 100%;">
                            <div class="merah border border-dark" style="width: 50%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_merah}}</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_biru}}</p>
                            </div>
                    </div>
                </div>  
                <div class="performance-time d-flex gap-1  " style="width: 100%;height: 14.3%;">
                    <div class="left border border-dark" style="width: 50%;height: 100%">
                        <p class="fw-bold" style="font-size: 1.2rem;">Performa Waktu</p>
                    </div>
                    <div class="right d-flex gap-1" style="width: 50%;height: 100%;">
                            <div class="merah border border-dark" style="width: 50%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_regu_merah ? sprintf("%02d:%02d", floor($penalty_regu_merah->performa_waktu), ($penalty_regu_merah->performa_waktu*60)%60) : "00:00" }}</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_regu_biru ? sprintf("%02d:%02d", floor($penalty_regu_biru->performa_waktu), ($penalty_regu_biru->performa_waktu*60)%60) : "00:00" }}</p>
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
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_merah}}</p>
                            </div>
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 10%;height: 100%;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">-</p>
                            </div>
                            <div class="biru border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_biru}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif ($jenis == "ganda")
<div class="hasil-container text-center p-3" style="height: 50vh">
@php
    if(count($penilaian_ganda_juri_merah)%2==0){
        $length = count($penilaian_ganda_juri_merah)/2;
    }else{
        $length = (count($penilaian_ganda_juri_merah)+1)/2;
    }
    if($penalty_ganda_merah){
        $penalty_merah = $penalty_ganda_merah->toleransi_waktu+$penalty_ganda_merah->keluar_arena+$penalty_ganda_merah->menyentuh_lantai+$penalty_ganda_merah->pakaian+$penalty_ganda_merah->tidak_bergerak;
    }else{
        $penalty_merah = 0;
    }
    $total_merah = 0;
    foreach ($penilaian_ganda_juri_merah as $penilaian_juri) {
        $total_merah += $penilaian_juri->skor;
    }
    if(!count($penilaian_ganda_juri) == 0){
        $mean_merah = $total_merah / count($penilaian_ganda_juri_merah);
    }else{
        $mean_merah = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_merah = 0;
    foreach ($penilaian_ganda_juri_merah as $penilaian_juri) {
        $total_diff_squared_merah += pow($penilaian_juri->skor - $mean_merah, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_ganda_juri_merah) == 0){
        $standard_deviation_merah = sqrt($total_diff_squared_merah / count($penilaian_ganda_juri_merah));
    }else{
        $standard_deviation_merah = 0;
    }

    if(count($penilaian_ganda_juri_biru)%2==0){
        $length = count($penilaian_ganda_juri_biru)/2;
    }else{
        $length = (count($penilaian_ganda_juri_biru)+1)/2;
    }
    if($penalty_ganda_biru){
        $penalty_biru = $penalty_ganda_biru->toleransi_waktu+$penalty_ganda_biru->keluar_arena+$penalty_ganda_biru->menyentuh_lantai+$penalty_ganda_biru->pakaian+$penalty_ganda_biru->tidak_bergerak;
    }else{
        $penalty_biru = 0;
    }    
    $total_biru = 0;
    foreach ($penilaian_ganda_juri_biru as $penilaian_juri) {
        $total_biru += $penilaian_juri->skor;
    }
    if(!count($penilaian_ganda_juri) == 0){
        $mean_biru = $total_biru / count($penilaian_ganda_juri_biru);
    }else{
        $mean_biru = 0;
    }
    
    // Menghitung selisih kuadrat dari setiap nilai dengan rata-rata
    $total_diff_squared_biru = 0;
    foreach ($penilaian_ganda_juri_biru as $penilaian_juri) {
        $total_diff_squared_biru += pow($penilaian_juri->skor - $mean_biru, 2);
    }

    // Menghitung standar deviasi
    if(!count($penilaian_ganda_juri_biru) == 0){
        $standard_deviation_biru = sqrt($total_diff_squared_biru / count($penilaian_ganda_juri_biru));
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
        @if ($jadwal->pemenang == $sudut_biru->id)
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
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_ganda_merah ? sprintf("%02d:%02d", floor($penalty_ganda_merah->performa_waktu), ($penalty_ganda_merah->performa_waktu*60)%60) : "00:00" }}</p>
                            </div>
                            <div class="biru border border-dark" style="width: 50%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$penalty_ganda_biru ? sprintf("%02d:%02d", floor($penalty_ganda_biru->performa_waktu), ($penalty_ganda_biru->performa_waktu*60)%60) : "00:00" }}</p>
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
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_merah}}</p>
                            </div>
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 10%;height: 100%;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">-</p>
                            </div>
                            <div class="biru border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_biru}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif ($jenis == "solo")
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
    $penalty_biru = $penalty_solo_biru->toleransi_waktu+$penalty_solo->keluar_arena+$penalty_solo->menyentuh_lantai+$penalty_solo->pakaian+$penalty_solo->tidak_bergerak;
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
        @if ($jadwal->pemenang == $sudut_biru->id)
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
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #db3545;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_merah}}</p>
                            </div>
                            <div class="merah border border-dark d-flex flex-column justify-content-center" style="width: 10%;height: 100%;">
                                 <p class="fw-bold " style="font-size: 1.2rem;">-</p>
                            </div>
                            <div class="biru border border-dark d-flex flex-column justify-content-center" style="width: 45%;height: 100%;color: #0053a6">
                                 <p class="fw-bold " style="font-size: 1.2rem;">{{$standard_deviation_biru}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
