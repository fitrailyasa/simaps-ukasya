@php
// Daftar warna yang mungkin untuk latar belakang
$backgroundColors = ['#FF5733', '#33FF57', '#5733FF', '#33FFFF', '#FFFF33', '#FF33FF', '#33FF33', '#3333FF', '#FF3333'];
@endphp

<div>
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/ketua-pertandingan-tanding.css') }}">
@endsection
    @include('client.ketua.tanding.navbar')
    <div class="content p-4" style="width:100%;height: auto">
        <div class="content-header d-flex">
            <div class="biru  d-flex justify-content-between p-2 " style="width: 40%">
                <div class="biru-nama">
                    <h5 class="ml-4 fw-bold">{{ $sudut_biru->negara }}</h5>
                    <h4 class="fw-bold mt-4" style="color:#252c94">{{ $sudut_biru->nama}}</h4>
                </div>
                <div class="biru-score d-flex flex-column justify-content-center" style="height: 100%">
                    <h3 class="fw-bold" style="color:#252c94">0</h3>
                </div>
            </div>
            <div class="{{$mulai == true ? "mulai" : ""}} waktu text-center d-flex flex-column justify-content-center" style="width: 20%">
                <h2 class="">{{ sprintf("%02d:%02d:%02d", floor($waktu / 60), $waktu % 60, ($waktu - floor($waktu)) * 10) }}</h2>
            </div>
            <div class="merah  d-flex justify-content-between p-2" style="width: 40%">
                <div class="merah-score d-flex flex-column justify-content-center">
                    <h3 class="fw-bold" style="color: #db3545 ">0</h3>
                </div>
                <div class="merah-nama text-end">
                    <h5 class="mr-4 fw-bold">{{ $sudut_merah->negara }}</h5>
                    <h4 class="fw-bold mt-4" style="color: #db3545 ">{{ $sudut_merah->nama }}</h4>
                </div>
            </div>
        </div>
        <div class="content-body d-flex">
            <div class="biru" style="width: 45%">
                <div class="table-header border border-dark text-center">
                    <h4 class="fw-bold pt-1" style="color:#252c94">BIRU</h4>
                </div>
                <div class="table-body d-flex" style="width: 100%">
                    <div class="total" style="width: 20%">
                        <div class="total-header border border-dark text-center" style="background-color: #375cbf">
                            <h4 class="text-white fw-bold">Total</h4>
                        </div>
                        <div class="table-body border border-dark" style="height: 89.1%">
                            <div class="total-akhir"></div>
                        </div>
                    </div>
                    <div class="detail-poin" style="width: 80%">
                        <div class="detail-poin-header border border-dark text-center" style="background-color: #375cbf">
                            <h4 class="text-white fw-bold">Detail Poin</h4>
                        </div>
                        <div class="detail-poin-body d-flex">
                            <div class="total-sementara" style="width: 10%">
                                <div class="total-sementara-juri border border-dark" style="width: 100%; height: 50%;">
                                </div>
                                <div class="total-sementara-jatuhan border border-dark" style="width: 100%; height: 12.5%;">
                                </div>
                                <div class="total-sementara-binaan border border-dark" style="width: 100%; height: 12.5%;">
                                </div>
                                <div class="total-sementara-teguran border border-dark" style="width: 100%; height: 12.5%;">
                                </div>
                                <div class="total-sementara-peringatan border border-dark"
                                    style="width: 100%; height: 12.5%;"></div>
                            </div>
                            <div class="nilai" style="width: 50%">
                                @foreach ($juris as $index => $juri)
                                    <div class="nilai-juri-{{$index}} border border-dark" style="width: 100%; height: 12.5%;">
                                        @if (json_decode($penilaian_juri_biru[$index]->data) && $penilaian_juri_biru[$index]->sudut == $jadwal->sudut_biru && $juri->id == $penilaian_juri_biru[$index]->juri)
                                            @foreach (json_decode($penilaian_juri_biru[$index]->data) as $nilai)
                                                @if ($nilai == '1_in')
                                                    <img src="{{url('assets/svg/1.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                                @elseif ($nilai == '2_in')
                                                    <img src="{{url('assets/svg/2.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                                @elseif ($nilai == '1_out')
                                                    <img src="{{url('assets/svg/1blocked.svg')}}" alt="" height="40" style=" ">
                                                @elseif ($nilai == '2_out')
                                                    <img src="{{url('assets/svg/2blocked.svg')}}" alt="" height="40" style=" ">
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                                <div class="nilai-skor border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                     @if (json_decode($penilaian_tanding_biru->skor) ?? null)
                                        @foreach (json_decode($penilaian_tanding_biru->skor) as $item)
                                            @if ($item == '1')
                                                 <img src="{{url('assets/svg/1.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                            @elseif ($item == 2)
                                                 <img src="{{url('assets/svg/2.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="nilai-jatuhan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_biru->jatuhan; $i++)
                                        <h5 class="fw-bold m-2">3</h5>
                                    @endfor
                                </div>
                                <div class="nilai-binaan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_biru->binaan; $i++)
                                        <h5 class="fw-bold m-2">{{$i*0}}</h5>
                                    @endfor
                                </div>
                                <div class="nilai-teguran border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_biru->teguran; $i++)
                                        <h5 class="fw-bold m-2">{{$i*-1}}</h5>
                                    @endfor
                                </div>
                                <div class="nilai-peringatan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_biru->peringatan; $i++)
                                        <h5 class="fw-bold m-2">{{$i*-5}}</h5>
                                    @endfor
                                </div>
                            </div>
                            <div class="indikasi" style="width: 40%">
                                <div class="juri-1 border border-dark text-center">
                                    <h4 class="fw-bold">Juri 1</h4>
                                </div>
                                <div class="juri-2 border border-dark text-center">
                                    <h4 class="fw-bold">Juri 2</h4>
                                </div>
                                <div class="juri-3 border border-dark text-center">
                                    <h4 class="fw-bold">Juri 3</h4>
                                </div>
                                <div class="skor border border-dark text-center">
                                    <h4 class="fw-bold">Skor</h4>
                                </div>
                                <div class="jatuhan border border-dark text-center">
                                    <h4 class="fw-bold">Jatuhan</h4>
                                </div>
                                <div class="binaan border border-dark text-center">
                                    <h4 class="fw-bold">Binaan</h4>
                                </div>
                                <div class="teguran border border-dark text-center">
                                    <h4 class="fw-bold">Teguran</h4>
                                </div>
                                <div class="peringatan border border-dark text-center">
                                    <h4 class="fw-bold">Peringatan</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="babak" style="width: 10%">
                <div class="table-header border border-dark text-center">
                    <h4 class="fw-bold pt-1">Babak</h4>
                </div>
                <div class="table-body border border-dark d-flex flex-column justify-content-center text-center" style="height: 89.1%">
                    @if ($jadwal->babak_tanding == 1)
                        <img src="{{url('/assets/svg/romawi-1.svg')}}" alt="">
                    @elseif ($jadwal->babak_tanding == 3)
                         <img src="{{url('/assets/svg/romawi-2.svg')}}" alt="">
                    @else
                         <img src="{{url('/assets/svg/romawi-3.svg')}}" alt="">
                    @endif
                </div>
            </div>
            <div class="merah" style="width: 45%">
                <div class="table-header border border-dark text-center">
                    <h4 class="fw-bold pt-1" style="color:#db3545">MERAH</h4>
                </div>
                <div class="table-body d-flex" style="width: 100%">
                    <div class="detail-poin" style="width: 80%">
                        <div class="detail-poin-header border border-dark text-center" style="background-color: #db3545">
                            <h4 class="text-white fw-bold">Detail Poin</h4>
                        </div>
                        <div class="detail-poin-body d-flex">
                            <div class="indikasi" style="width: 40%">
                                <div class="juri-1 border border-dark text-center">
                                    <h4 class="fw-bold">Juri 1</h4>
                                </div>
                                <div class="juri-2 border border-dark text-center">
                                    <h4 class="fw-bold">Juri 2</h4>
                                </div>
                                <div class="juri-3 border border-dark text-center">
                                    <h4 class="fw-bold">Juri 3</h4>
                                </div>
                                <div class="skor border border-dark text-center">
                                    <h4 class="fw-bold">Skor</h4>
                                </div>
                                <div class="jatuhan border border-dark text-center">
                                    <h4 class="fw-bold">Jatuhan</h4>
                                </div>
                                <div class="binaan border border-dark text-center">
                                    <h4 class="fw-bold">Binaan</h4>
                                </div>
                                <div class="teguran border border-dark text-center">
                                    <h4 class="fw-bold">Teguran</h4>
                                </div>
                                <div class="peringatan border border-dark text-center">
                                    <h4 class="fw-bold">Peringatan</h4>
                                </div>
                            </div>
                            <div class="nilai" style="width: 50%">
                                @foreach ($juris as $index => $juri)
                                    <div class="nilai-juri-{{$index}} border border-dark" style="width: 100%; height: 12.5%;">
                                        @if (json_decode($penilaian_juri_merah[$index]->data) && $penilaian_juri_merah[$index]->sudut == $jadwal->sudut_merah && $juri->id == $penilaian_juri_merah[$index]->juri)
                                            @foreach (json_decode($penilaian_juri_merah[$index]->data) as $nilai)
                                                @if ($nilai == '1_in')
                                                    <img src="{{url('assets/svg/1.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                                @elseif ($nilai == '2_in')
                                                    <img src="{{url('assets/svg/2.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                                @elseif ($nilai == '1_out')
                                                    <img src="{{url('assets/svg/1blocked.svg')}}" alt="" height="40" style=" ">
                                                @elseif ($nilai == '2_out')
                                                    <img src="{{url('assets/svg/2blocked.svg')}}" alt="" height="40" style=" ">
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                                 <div class="nilai-skor border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @if (json_decode($penilaian_tanding_merah->skor) ?? null)
                                        @foreach (json_decode($penilaian_tanding_merah->skor) as $item)
                                            @if ($item == '1')
                                                 <img src="{{url('assets/svg/1.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                            @elseif ($item == 2)
                                                 <img src="{{url('assets/svg/2.svg')}}" alt="" height="40" style="background-color: {{ $backgroundColors[mt_rand(1, 100)%8]}} ">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="nilai-jatuhan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_merah->jatuhan; $i++)
                                        <h5 class="fw-bold m-2">3</h5>
                                    @endfor
                                </div>
                                <div class="nilai-binaan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_merah->binaan; $i++)
                                        <h5 class="fw-bold m-2">{{$i*0}}</h5>
                                    @endfor
                                </div>
                                <div class="nilai-teguran border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_merah->teguran; $i++)
                                        <h5 class="fw-bold m-2">{{$i*-1}}</h5>
                                    @endfor
                                </div>
                                <div class="nilai-peringatan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    @for ($i = 1; $i <= $penilaian_tanding_merah->peringatan; $i++)
                                        <h5 class="fw-bold m-2">{{$i*-5}}</h5>
                                    @endfor
                                </div>
                            </div>
                            <div class="total-sementara" style="width: 10%">
                                <div class="total-sementara-juri border border-dark" style="width: 100%; height: 50%;">
                                </div>
                                <div class="total-sementara-jatuhan border border-dark"
                                    style="width: 100%; height: 12.5%;"></div>
                                <div class="total-sementara-binaan border border-dark"
                                    style="width: 100%; height: 12.5%;"></div>
                                <div class="total-sementara-teguran border border-dark"
                                    style="width: 100%; height: 12.5%;"></div>
                                <div class="total-sementara-peringatan border border-dark"
                                    style="width: 100%; height: 12.5%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="total" style="width: 20%">
                        <div class="total-header border border-dark text-center" style="background-color: #db3545">
                            <h4 class="text-white fw-bold">Total</h4>
                        </div>
                        <div class="table-body border border-dark" style="height: 89.1%">
                            <div class="total-akhir"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client.ketua.tanding.modal', ['pemenang' => 'merah'])
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
        observeChanges();
    </script>
@endsection
