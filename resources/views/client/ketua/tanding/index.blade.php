@extends('layouts.client.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/ketua-pertandingan-tanding.css') }}">
@endsection
@section('content')
    @include('client.ketua.tanding.navbar', [
        'jenis' => 'TANDING',
        'class' => 'CLASS E - FINAL',
        'match' => $match,
        'arena' => $arena,
    ])
    <div class="content p-4" style="width:100%;height: auto">
        <div class="content-header d-flex">
            <div class="biru  d-flex justify-content-between p-2 " style="width: 40%">
                <div class="biru-nama">
                    <h5 class="ml-4 fw-bold">{{ $biru_region }}</h5>
                    <h4 class="fw-bold mt-4" style="color:#252c94">{{ $biru_nama }}</h4>
                </div>
                <div class="biru-score d-flex flex-column justify-content-center" style="height: 100%">
                    <h3 class="fw-bold" style="color:#252c94">0</h3>
                </div>
            </div>
            <div class="waktu text-center d-flex flex-column justify-content-center" style="width: 20%">
                <h2 class="">02:00.0</h2>
            </div>
            <div class="merah  d-flex justify-content-between p-2" style="width: 40%">
                <div class="merah-score d-flex flex-column justify-content-center">
                    <h3 class="fw-bold" style="color: #db3545 ">0</h3>
                </div>
                <div class="merah-nama text-end">
                    <h5 class="mr-4 fw-bold">{{ $merah_region }}</h5>
                    <h4 class="fw-bold mt-4" style="color: #db3545 ">{{ $merah_nama }}</h4>
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
                                <div class="nilai-juri-1 border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-juri-2 border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-juri-3 border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-skor border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-jatuhan border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-binaan border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-teguran border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-peringatan border border-dark" style="width: 100%; height: 12.5%;"></div>
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
            <div class="PenilaianTanding" style="width: 10%">
                <div class="table-header border border-dark text-center">
                    <h4 class="fw-bold pt-1">PenilaianTanding</h4>
                </div>
                <div class="table-body border border-dark" style="height: 89.1%">
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
                                <div class="nilai-juri-1 border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-juri-2 border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-juri-3 border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-skor border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-jatuhan border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-binaan border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-teguran border border-dark" style="width: 100%; height: 12.5%;"></div>
                                <div class="nilai-peringatan border border-dark" style="width: 100%; height: 12.5%;">
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
@endsection
