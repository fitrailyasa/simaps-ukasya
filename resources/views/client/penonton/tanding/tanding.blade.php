<div class="tanding-container p-3 {{$mulai == true ? "mulai" : ""}}" style="height: 50vh;">
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
    }
    @endphp
    <div class="tanding-header d-flex" style="height: 20%; width: 100%">
        <div class="sudut_merah d-flex" style="width: 40%">
            <div class="bendera" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 12%;border-radius: 50%; background-color: #0053a6">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 4px">
            </div>
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <h5 class="fw-bold">{{$sudut_merah->nama}}</h5>
                <h3 class="fw-bold" style="color: #db3545">{{$sudut_merah->negara}}</h3>
            </div>
        </div>
        <div class="time text-center d-flex flex-column justify-content-center" style="width:20%">
            <div class="d-flex justify-content-center text-center"><h3 class="fw-bold">{{ sprintf("%02d:%02d", floor($gelanggang->waktu), ($gelanggang->waktu*60)%60) }}</span></div>
        </div>
        <div class="sudut-biru d-flex" style="width: 40%">
            <div class="pesilat-name m-1 p-2 text-center" style="width: 43%">
                <h5 class="fw-bold">{{$sudut_biru->nama}}</h5>
                <h3 class="fw-bold" style="color: #0053a6">{{$sudut_biru->negara}}</h3>
            </div>
            <div class="profile-picture m-1 p-1 text-center" style="height: 100%;width: 12%;border-radius: 50%; background-color: #db3545">
                <img src="{{url('/assets/profile/default.png')}}" alt="" style="height: 90%; margin-top: 4px">
            </div>
             <div class="bendera d-flex justify-content-end" style="width: 30%;">
                <img src="{{url('/assets/img/indonesia.gif')}}" alt="" style="height: 100%">
            </div>
        </div>
    </div>
    <div class="tanding-content mt-3 d-flex" style="width: 100%;height: 100%;">
        <div class="sudut_merah d-flex" style="width: 45%;height: 100%;">
            <div class="indikator border" style="width: 40%; height: 100%;">
                <div class="binaan d-flex gap-1 justify-content-center border" style="height: 33%">
                    @if ($penilaian_tanding_merah->where('jenis','binaan')->where('babak',$jadwal->babak_tanding)->count() == 0)
                        <img src="{{url('/assets/img/tangan1.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @elseif ($penilaian_tanding_merah->where('jenis','binaan')->where('babak',$jadwal->babak_tanding)->count() == 1)
                        <img src="{{url('/assets/img/tangan1k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @elseif ($penilaian_tanding_merah->where('jenis','binaan')->where('babak',$jadwal->babak_tanding)->count() == 2)
                        <img src="{{url('/assets/img/tangan1k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @else
                        <img src="{{url('/assets/img/tangan1k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @endif  
                </div>
                <div class="teguran d-flex gap-4 justify-content-center border" style="height: 33%">
                    @if ($penilaian_tanding_merah->where('jenis','teguran')->where('babak',$jadwal->babak_tanding)->count() == 0)
                        <img src="{{url('/assets/img/tangan2.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3.png')}}" alt="" height="50" width="25" style="margin-top: 15%">                
                    @elseif ($penilaian_tanding_merah->where('jenis','teguran')->where('babak',$jadwal->babak_tanding)->count() == 1)
                        <img src="{{url('/assets/img/tangan2k.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3.png')}}" alt="" height="50" width="25" style="margin-top: 15%">                
                    @elseif ($penilaian_tanding_merah->where('jenis','teguran')->where('babak',$jadwal->babak_tanding)->count() == 2)
                        <img src="{{url('/assets/img/tangan2k.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3k.png')}}" alt="" height="50" width="25" style="margin-top: 15%">        
                    @else
                        <img src="{{url('/assets/img/tangan2k.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3k.png')}}" alt="" height="50" width="25" style="margin-top: 15%">                
                    @endif  
                    
                        
                </div>
                <div class="peringatan d-flex gap-4 justify-content-center border" style="height: 33%">
                    @if ($penilaian_tanding_merah->where('jenis','peringatan')->count() == 0 || $penilaian_tanding_merah->where('jenis','peringatan') == null)
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @elseif ($penilaian_tanding_merah->where('jenis','peringatan')->count() == 1)
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @elseif ($penilaian_tanding_merah->where('jenis','peringatan')->count() == 2)
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @elseif ($penilaian_tanding_merah->where('jenis','peringatan')->count() == 3)
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @else
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @endif  
                    
                </div>
            </div>
            <div class="poin d-flex justify-content-center"  style="width: 60%;height: 100%;background-repeat: no-repeat;background-size: 100% 150%; background-image: url({{url('assets/img/merah.jpg')}}); ">
                <p class="text" style="font-size: 375px ; color: #fff ;margin-top: -20%">{{$total_merah}}</p>            
            </div>
        </div>
        <div class="round d-flex flex-column justify-content-center border" style="width: 10%;height: 100%;">
            <div class="box border border-dark" style="height: 20%">
            @if($jadwal->babak_tanding == 3)
                <div class="box bg-success text-center d-flex justify-content-center" style="height: 70%;margin-bottom: 4px">
                    <img src="{{url('/assets/svg/svg-white3.svg')}}" alt="" style="height: 100%;">
                </div>
                <div class="round border border-dark text-center" style="height: 30%">
                    <p class="fw-bold" style="margin-top: -4px">Round</p>
                </div>
                @endif</div>
            <div class="box border border-dark" style="height: 20%">
            @if($jadwal->babak_tanding == 2)
                <div class="box bg-success text-center d-flex justify-content-center" style="height: 70%;margin-bottom: 4px">
                    <img src="{{url('/assets/svg/svg-white2.svg')}}" alt="" style="height: 100%;">
                </div>
                <div class="round border border-dark text-center" style="height: 30%">
                    <p class="fw-bold" style="margin-top: -4px">Round</p>
                </div>
                @endif</div>
            <div class="box border border-dark p-2 " style="height: 20%">
                @if($jadwal->babak_tanding == 1)
                <div class="box bg-success text-center d-flex justify-content-center" style="height: 70%;margin-bottom: 4px">
                    <img src="{{url('/assets/svg/svg-white1.svg')}}" alt="" style="height: 100%;">
                </div>
                <div class="round border border-dark text-center" style="height: 30%">
                    <p class="fw-bold" style="margin-top: -4px">Round</p>
                </div>
                @endif
            </div>
        </div>
        <div class="sudut-biru d-flex" style="width: 45%">
            <div class="poin d-flex justify-content-center"  style="width: 60%;height: 100%;background-repeat: no-repeat;background-size: 100% 150%; background-image: url({{url('assets/img/biru.jpg')}}); ">
                <p class="text" style="font-size: 375px ; color: #fff ;margin-top: -20%">{{$total_biru}}</p>
            </div>
            <div class="indikator border" style="width: 40%; height: 100%;">
                <div class="binaan d-flex gap-1 justify-content-center border" style="height: 33%">
                    @if ($penilaian_tanding_biru->where('jenis','binaan')->where('babak',$jadwal->babak_tanding)->count() == 0)
                        <img src="{{url('/assets/img/tangan1.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @elseif ($penilaian_tanding_biru->where('jenis','binaan')->where('babak',$jadwal->babak_tanding)->count() == 1)
                        <img src="{{url('/assets/img/tangan1k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @elseif ($penilaian_tanding_biru->where('jenis','binaan')->where('babak',$jadwal->babak_tanding)->count() == 2)
                        <img src="{{url('/assets/img/tangan1k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @else
                        <img src="{{url('/assets/img/tangan1k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                        <img src="{{url('/assets/img/tangan4k.png')}}" alt="" height="25" width="50" style="margin-top: 20%">
                    @endif  
                </div>
                <div class="teguran d-flex gap-4 justify-content-center border" style="height: 33%">
                    @if ($penilaian_tanding_biru->where('jenis','teguran')->where('babak',$jadwal->babak_tanding)->count() == 0)
                        <img src="{{url('/assets/img/tangan2.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3.png')}}" alt="" height="50" width="25" style="margin-top: 15%">                
                    @elseif ($penilaian_tanding_biru->where('jenis','teguran')->where('babak',$jadwal->babak_tanding)->count() == 1)
                        <img src="{{url('/assets/img/tangan2k.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3.png')}}" alt="" height="50" width="25" style="margin-top: 15%">                
                    @elseif ($penilaian_tanding_biru->where('jenis','teguran')->where('babak',$jadwal->babak_tanding)->count() == 2)
                        <img src="{{url('/assets/img/tangan2k.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3k.png')}}" alt="" height="50" width="25" style="margin-top: 15%">        
                    @else
                        <img src="{{url('/assets/img/tangan2k.png')}}" alt="" height="50" width="25" style="margin-top: 15%;margin-left: -16px">
                        <img src="{{url('/assets/img/tangan3k.png')}}" alt="" height="50" width="25" style="margin-top: 15%">                
                    @endif  
                    
                        
                </div>
                <div class="peringatan d-flex gap-4 justify-content-center border" style="height: 33%">
                    @if ($penilaian_tanding_biru->where('jenis','peringatan')->count() == 0 || $penilaian_tanding_biru->where('jenis','peringatan') == null)
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @elseif ($penilaian_tanding_biru->where('jenis','peringatan')->count() == 1)
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @elseif ($penilaian_tanding_biru->where('jenis','peringatan')->count() == 2)
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @elseif ($penilaian_tanding_biru->where('jenis','peringatan')->count() == 3)
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @else
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%">
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                        <img src="{{url('/assets/img/tangan5k1.png')}}" alt="" height="50" width="25" style="margin-top: 15%"> 
                    @endif  
                    
                </div>
            </div>
        </div>
    </div>
    <div class="tanding-footer text-center d-flex" style="height: 30%">
        <div class="sudut_merah" style="width: 45%;height: 100%;">
            <div class="baris-1 d-flex border" style="width: 100%; height: 50%;">
                {{-- @dd($penilaian_tanding_merah->where('aktif',false)->last()) --}}
                <div class="j-1 border mt-1 {{$pukulan_merah->juri_1 ?? null == 1 ? "active-2" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J1</h3>
                </div>
                <div class="j-2 border mt-1 {{$pukulan_merah->juri_2 ?? null ==  2 ? "active-2" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J2</h3>
                </div>
                <div class="j-3 border mt-1 {{$pukulan_merah->juri_3 ?? null ==  3 ? "active-2" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J3</h3>
                </div>
            </div>
            <div class="baris-2 d-flex border" style="width: 100%; height: 50%;">
                <div class="j-1 border mt-1 {{$tendangan_merah->juri_1 ?? null == 1 ? "active" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J1</h3>
                </div> 
                <div class="j-2 border mt-1 {{$tendangan_merah->juri_2 ?? null == 2 ? "active" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J2</h3>
                </div>
                <div class="j-3 border mt-1 {{$tendangan_merah->juri_3 ?? null == 3 ? "active" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J3</h3>
                </div>
            </div>
        </div>
        <div class="round d-flex flex-column justify-content-center" style="width: 10%;height: 100%;">
            <div class="j-1 border active-2" style="width: 100%;height: 50%;">
                <img src="{{url('/assets/img/tinju.png')}}" alt="" style="height: 100%">
            </div>
            <div class="j-2 border active" style="width: 100%;height: 50%;">
                <img src="{{url('/assets/img/tendang.png')}}" alt="" style="height: 100%">
            </div>
        </div>
        <div class="sudut-biru" style="width: 45%">
             <div class="baris-pukulan d-flex border" style="width: 100%; height: 50%;">
                <div class="j-1 border mt-1 {{$pukulan_biru->juri_1 ?? null == 1 ? "active-2" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J1</h3>
                </div>
                <div class="j-2 border mt-1 {{$pukulan_biru->juri_2 ?? null == 2 ? "active-2" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J2</h3>
                </div>
                <div class="j-3 border mt-1 {{$pukulan_biru->juri_3 ?? null == 3 ? "active-2" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J3</h3>
                </div>
            </div>
            <div class="baris-tendangan d-flex border" style="width: 100%; height: 50%;">
                <div class="j-1 border mt-1 {{$tendangan_biru->juri_1 ?? null == 1 ? "active" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J1</h3>
                </div>
                <div class="j-2 border mt-1 {{$tendangan_biru->juri_2 ?? null == 2 ? "active" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J2</h3>
                </div>
                <div class="j-3 border mt-1 {{$tendangan_biru->juri_3 ?? null == 3 ? "active" : ""}}" style="width: 33.3%;height: 80%;">
                    <h3>J3 </h3>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        let intervalRef; 
        function observeChanges() {
            // Buat instance dari MutationObserver
            const observer = new MutationObserver(function(mutationsList, observer) {
                // Iterasi melalui setiap mutasi
                for(let mutation of mutationsList) {
                    // Periksa apakah mutasi menambahkan kelas "timer" ke elemen
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class' && $(mutation.target).hasClass('mulai')) {
                        // Lakukan sesuatu, misalnya menjalankan interval
                        
                        intervalRef = setInterval(function () {
                            if (@this.get('waktu') <= 0){
                                @this.call('resetWaktu');
                                clearInterval(intervalRef);
                                return;
                            }
                            @this.call('decrementWaktu');
                        }, 10);
                    }else{
                        // clearInterval(intervalRef);
                        return;
                    }
                }
            });

            // Mulai memantau perubahan pada elemen dengan kelas "tes"
            observer.observe(document.body, { attributes: true, subtree: true });
        }

        setInterval(() => {
            @this.call('resetIndikator')
        }, 1000);
    </script>
@endsection

