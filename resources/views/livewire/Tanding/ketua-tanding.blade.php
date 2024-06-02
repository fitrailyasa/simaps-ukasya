<div>
@php
    $jatuhan_biru = 0;
    $binaan_biru = 0;
    $teguran_biru = 0;
    $peringatan_biru = 0;
    $pukulan_tendangan_biru = 0;
    foreach ($penilaian_tanding_biru->where('status','sah') as $penilaian) {
        switch ($penilaian->jenis) {
            case 'jatuhan':
                $jatuhan_biru += $penilaian->dewan;
                break;
            case 'binaan':
                $binaan_biru += $penilaian->dewan;
                break;
            case 'teguran':
                $teguran_biru += $penilaian->dewan;
                break;
            case 'peringatan':
                $peringatan_biru += $penilaian->dewan;
                break;
            case 'pukulan':
                $pukulan_tendangan_biru += 1;
                break;
            case 'tendangan':
                $pukulan_tendangan_biru += 2;
                break;
        }
    }
    $total_poin_sementara_biru = $jatuhan_biru + $binaan_biru + $teguran_biru + $peringatan_biru + $pukulan_tendangan_biru ;

    $jatuhan_merah = 0;
    $binaan_merah = 0;
    $teguran_merah = 0;
    $peringatan_merah = 0;
    $pukulan_tendangan_merah = 0;
    foreach ($penilaian_tanding_merah->where('status','sah') as $penilaian) {
        switch ($penilaian->jenis) {
            case 'jatuhan':
                $jatuhan_merah += $penilaian->dewan;
                break;
            case 'binaan':
                $binaan_merah += $penilaian->dewan;
                break;
            case 'teguran':
                $teguran_merah += $penilaian->dewan;
                break;
            case 'peringatan':
                $peringatan_merah += $penilaian->dewan;
                break;
            case 'pukulan':
                $pukulan_tendangan_merah += 1;
                break;
            case 'tendangan':
                $pukulan_tendangan_merah += 2;
                break;
        }
    }
    $total_poin_sementara_merah = $jatuhan_merah + $binaan_merah + $teguran_merah + $peringatan_merah + $pukulan_tendangan_merah ;

    $total_poin_merah = 0;
    foreach ($poin_merah->where('status','sah') as $index => $poin) {
        switch ($poin->jenis) {
            case 'jatuhan':
                $total_poin_merah += $poin->dewan;
                break;
            case 'binaan':
                $total_poin_merah += $poin->dewan;
                break;
            case 'teguran':
                $total_poin_merah += $poin->dewan;
                break;
            case 'peringatan':
                $total_poin_merah += $poin->dewan;
                break;
            case 'pukulan':
                $total_poin_merah += 1;
                break;
            case 'tendangan':
                $total_poin_merah += 2;
                break;
        }
    }
    $total_poin_biru = 0;
    foreach ($poin_biru->where('status','sah') as $index => $poin) {
        switch ($poin->jenis) {
            case 'jatuhan':
                $total_poin_biru += $poin->dewan;
                break;
            case 'binaan':
                $total_poin_biru += $poin->dewan;
                break;
            case 'teguran':
                $total_poin_biru += $poin->dewan;
                break;
            case 'peringatan':
                $total_poin_biru += $poin->dewan;
                break;
            case 'pukulan':
                $total_poin_biru += 1;
                break;
            case 'tendangan':
                $total_poin_biru += 2;
                break;
        }
    }
    
@endphp
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
                    <h3 class="fw-bold" style="color:#252c94">{{$total_poin_biru}}</h3>
                </div>
            </div>
            <div class="{{$mulai == true ? "mulai" : ""}} waktu text-center d-flex flex-column justify-content-center" style="width: 20%">
                <h2 class="">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</h2>
            </div>
            <div class="merah  d-flex justify-content-between p-2" style="width: 40%">
                <div class="merah-score d-flex flex-column justify-content-center">
                    <h3 class="fw-bold" style="color: #db3545 ">{{$total_poin_merah }}</h3>
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
                        <div class="table-body border border-dark d-flex flex-column justify-content-center" style="height: 89.1%">
                            <div class="total-akhir d-flex justify-content-center">
                                <h1 class="fw-bold">
                                    {{$total_poin_biru}}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="detail-poin" style="width: 80%">
                        <div class="detail-poin-header border border-dark text-center" style="background-color: #375cbf">
                            <h4 class="text-white fw-bold">Detail Poin</h4>
                        </div>
                        <div class="detail-poin-body d-flex">
                            <div class="total-sementara" style="width: 10%">
                                <div class="total-sementara-juri border border-dark d-flex flex-column justify-content-center" style="width: 100%; height: 50%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$pukulan_tendangan_biru}}
                                    </h5>
                                </div>
                                <div class="total-sementara-jatuhan border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$jatuhan_biru}}
                                    </h5>
                                </div>
                                <div class="total-sementara-binaan border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$binaan_biru}}
                                    </h5>
                                </div>
                                <div class="total-sementara-teguran border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$teguran_biru}}
                                    </h5>
                                </div>
                                <div class="total-sementara-peringatan border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$peringatan_biru}}
                                    </h5>
                                </div>
                            </div>
                            <div class="nilai" style="width: 50%">
                                @foreach ($juris as $index => $juri)
                                    <div class="nilai-juri-{{$index}} border border-dark" style="width: 100%; height: 12.5%;">
                                        <h5 style="margin-left: 2px">
                                            @foreach ($penilaian_tanding_biru as $penilaian)
                                                @if ($index == 0)
                                                    @if ($penilaian->juri_1 == 1 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                                    @elseif ($penilaian->juri_1 == 1 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/1blocked.svg')}}" alt="1" width="15" height="30">
                                                    @elseif ($penilaian->juri_1 == 2 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style=" background-color: #ff8000">
                                                    @elseif ($penilaian->juri_1 == 2 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/2blocked.svg')}}" alt="1" width="15" height="30">
                                                    @endif
                                                @endif
                                                @if ($index == 1)
                                                    @if ($penilaian->juri_2 == 1 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                                    @elseif ($penilaian->juri_2 == 1 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/1blocked.svg')}}" alt="1" width="15" height="30">
                                                    @elseif ($penilaian->juri_2 == 2 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style=" background-color: #ff8000">
                                                    @elseif ($penilaian->juri_2 == 2 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/2blocked.svg')}}" alt="1" width="15" height="30">
                                                    @endif
                                                @endif
                                                @if ($index == 2)
                                                    @if ($penilaian->juri_3 == 1 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                                    @elseif ($penilaian->juri_3 == 1 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/1blocked.svg')}}" alt="1" width="15" height="30">
                                                    @elseif ($penilaian->juri_3 == 2 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style=" background-color: #ff8000">
                                                    @elseif ($penilaian->juri_3 == 2 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/2blocked.svg')}}" alt="1" width="15" height="30">
                                                    @endif
                                                @endif
                                            @endforeach
                                        </h5>
                                    </div>
                                @endforeach
                                <div class="nilai-skor border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 2px">
                                        @foreach ($penilaian_tanding_biru as $penilaian)
                                            @if ($penilaian->jenis == 'pukulan' && $penilaian->status == 'sah')
                                                <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                            @elseif ($penilaian->jenis == 'tendangan' && $penilaian->status == 'sah')
                                                <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style="background-color: #ff8000">
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-jatuhan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_biru as $penilaian)
                                            @if ($penilaian->jenis == 'jatuhan' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-binaan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_biru as $penilaian)
                                            @if ($penilaian->jenis == 'binaan' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-teguran border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_biru as $penilaian)
                                            @if ($penilaian->jenis == 'teguran' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-peringatan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_biru as $penilaian)
                                            @if ($penilaian->jenis == 'peringatan' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                            </div>
                            <div class="indikasi" style="width: 40%;height: 120% !important">
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
                <div class="table-body border border-dark d-flex flex-column justify-content-center text-center" style="height: 89.1%;background-color:#f0d500;">
                    @if ($jadwal->babak_tanding == 1)
                        <img src="{{url('/assets/svg/romawi-1.svg')}}" alt="">
                    @elseif ($jadwal->babak_tanding == 2)
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
                            <div class="indikasi" style="width: 40%;height: 120% !important">
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
                                        <h5 style="margin-left: 2px">
                                            @foreach ($penilaian_tanding_merah as $penilaian)
                                                @if ($index == 0)
                                                    @if ($penilaian->juri_1 == 1 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                                    @elseif ($penilaian->juri_1 == 1 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/1blocked.svg')}}" alt="1" width="15" height="30">
                                                    @elseif ($penilaian->juri_1 == 2 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style="background-color: #ff8000">
                                                    @elseif ($penilaian->juri_1 == 2 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/2blocked.svg')}}" alt="1" width="15" height="30">
                                                    @endif
                                                @endif
                                                @if ($index == 1)
                                                    @if ($penilaian->juri_2 == 1 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                                    @elseif ($penilaian->juri_2 == 1 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/1blocked.svg')}}" alt="1" width="15" height="30">
                                                    @elseif ($penilaian->juri_2 == 2 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style="background-color: #ff8000">
                                                    @elseif ($penilaian->juri_2 == 2 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/2blocked.svg')}}" alt="1" width="15" height="30">
                                                    @endif
                                                @endif
                                                @if ($index == 2)
                                                    @if ($penilaian->juri_3 == 1 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                                    @elseif ($penilaian->juri_3 == 1 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/1blocked.svg')}}" alt="1" width="15" height="30">
                                                    @elseif ($penilaian->juri_3 == 2 && $penilaian->status == 'sah')
                                                        <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style="background-color: #ff8000">
                                                    @elseif ($penilaian->juri_3 == 2 && $penilaian->status == 'tidak sah')
                                                        <img src="{{url('assets/svg/2blocked.svg')}}" alt="1" width="15" height="30">
                                                    @endif
                                                @endif
                                            @endforeach
                                        </h5>
                                    </div>
                                @endforeach
                                <div class="nilai-skor border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 2px">
                                        @foreach ($penilaian_tanding_merah as $penilaian)
                                            @if ($penilaian->jenis == 'pukulan' && $penilaian->status == 'sah')
                                                <img src="{{url('assets/svg/1.svg')}}" alt="1" width="15" height="30" style="background-color: #f0d500">
                                            @elseif ($penilaian->jenis == 'tendangan' && $penilaian->status == 'sah')
                                                <img src="{{url('assets/svg/2.svg')}}" alt="1" width="15" height="30" style="background-color: #ff8000">
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-jatuhan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_merah as $penilaian)
                                            @if ($penilaian->jenis == 'jatuhan' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-binaan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_merah as $penilaian)
                                            @if ($penilaian->jenis == 'binaan' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-teguran border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_merah as $penilaian)
                                            @if ($penilaian->jenis == 'teguran' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                                <div class="nilai-peringatan border border-dark d-flex" style="width: 100%; height: 12.5%;">
                                    <h5 class="fw-bold ml-1">
                                        @foreach ($penilaian_tanding_merah as $penilaian)
                                            @if ($penilaian->jenis == 'peringatan' && $penilaian->status == 'sah')
                                                {{$penilaian->dewan}}
                                            @endif        
                                        @endforeach
                                    </h5>
                                </div>
                            </div>
                            <div class="total-sementara" style="width: 10%">
                                <div class="total-sementara-juri border border-dark d-flex flex-column justify-content-center" style="width: 100%; height: 50%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$pukulan_tendangan_merah}}
                                    </h5>
                                </div>
                                <div class="total-sementara-jatuhan border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$jatuhan_merah}}
                                    </h5>
                                </div>
                                <div class="total-sementara-binaan border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$binaan_merah}}
                                    </h5>
                                </div>
                                <div class="total-sementara-teguran border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$teguran_merah}}
                                    </h5>
                                </div>
                                <div class="total-sementara-peringatan border border-dark" style="width: 100%; height: 12.5%;">
                                    <h5 style="margin-left: 15px; font-weight: bold">
                                        {{$peringatan_merah}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="total" style="width: 20%">
                        <div class="total-header border border-dark text-center" style="background-color: #db3545">
                            <h4 class="text-white fw-bold">Total</h4>
                        </div>
                        <div class="table-body border border-dark d-flex flex-column justify-content-center" style="height: 89.1%">
                            <div class="total-akhir d-flex justify-content-center">
                                <h1 class="fw-bold">
                                    {{$total_poin_merah}}
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client.ketua.tanding.modal')
</div>

@section('script')
     <script>
        setInterval(() => {
            @this.call('resetIndikator')
            if(@this.get('tahap') == 'hasil'){
                $('#keputusan-ketua').modal('show')
            }
        }, 1000);
    </script>
@endsection
