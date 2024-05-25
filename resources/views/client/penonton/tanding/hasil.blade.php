<div class="hasil-container d-flex text-center p-3" style="height: 80vh">
     @php
    $total_merah = 0;
    foreach ($penilaian_tanding_merah->where('status', 'sah') ?? null as $penilaian) {
        if ($penilaian->jenis == 'pukulan') {
            $total_merah += 1;
        }elseif ($penilaian->jenis == 'tendangan') {
            $total_merah += 2;
        }else{
            $total_merah += $penilaian->dewan;
        }
    }
    
    $total_biru = 0;
    foreach ($penilaian_tanding_biru->where('status', 'sah') ?? null as $penilaian) {
        if ($penilaian->jenis == 'pukulan') {
            $total_biru += 1;
        }elseif ($penilaian->jenis == 'tendangan') {
            $total_biru += 2;
        }else{
            $total_biru += $penilaian->dewan;
        }

        $pemenang = $jadwal->pemenang == $jadwal->sudut_biru ? "biru":"merah";
    }
    @endphp
     <div class="pesilat-a d-flex justify-content-center flex-column text-center" style="height: 100%;width:30%">
        <div class="image d-flex justify-content-center" style="height: 20%;width: 100%" >
            <img src="{{url('/assets/img/ipsi.png')}}" alt="" style="height: 100%;width: 40%" >
        </div>
        <h1 style="color: #0053a6">{{$sudut_biru->nama}}</h1>
        <h1>{{$sudut_biru->kontingen}}</h1>
        <div class="score d-flex justify-content-center flex-column" style="height: 50%;width:100%;border: solid 3px #0053a6">
            <p class="text-hasil" style="font-size: 10rem;color: #0053a6">{{$total_biru}}</p>
        </div>
    </div>
    <div class="hasil  d-flex justify-content-center flex-column text-center" style="height: 100%;width:40%">
        <p class="text-hasil fw-bold" style="font-size: 3rem;">PEMENANG</p>
        <div class="score d-flex justify-content-center" style="height: 20%;width:100%;">
            <div class="button"  style="height: 90%;width:60%">
                <div class="" style="height: 100%;width:100%;{{$pemenang == "merah" ? "border: solid 3px #db3545;background-color: #db3545;" : "border: solid 3px #0053a6;background-color: #0053a6;"}} border-radius: 20px">
                    <p class="text-hasil" style="font-size: 4rem;color: #fff">{{$pemenang == "merah" ? "MERAH" : "BIRU"}}</p>
                </div>
            </div>
        </div>
        <p class="text-hasil fw-bold" style="font-size: 4rem;">SCORE</p>
    </div>
    <div class="pesilat-b d-flex justify-content-center flex-column" style="height: 100%;width:30%">
         <div class="image d-flex justify-content-center" style="height: 20%;width: 100%" >
            <img src="{{url('/assets/img/ipsi.png')}}" alt="" style="height: 100%;width: 40%;" >
        </div>
        <h1 style="color: #db3545">{{$sudut_biru->nama}}</h1>
        <h1>{{$sudut_biru->kontingen}}</h1>
        <div class="score d-flex justify-content-center flex-column" style="height: 50%;width:100%;border: solid 3px #db3545">
            <p class="text-hasil" style="font-size: 10rem;color: #db3545">{{$total_merah}}</p>
        </div>
    </div>
</div>
