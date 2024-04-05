@extends('layouts.client.app')
@section('style')
    <link rel="stylesheet" href="{{url('assets/css/ketua-pertandingan-tunggal.css')}}">
@endsection
@section('content')
    @include('client.penonton.ketua.tunggal.navbar',['jenis'=>'TUNGGAL','class'=>'TUNGGAL'])
    <div class="content p-4" style="width:100%;height: auto">
        <div class="content-header d-flex">
            <div class="biru  d-flex justify-content-between p-2 " style="width: 50%">
                <div class="biru-nama">
                    <h5 class="ml-4 fw-bold">{{$region}}</h5>
                    <h4 class="fw-bold mt-4" style="color:#252c94">{{$nama}}</h4>
                </div>
            </div>
            <div class="merah  d-flex justify-content-end p-2" style="width: 50%">
                <div class="merah-nama text-end">
                    <h5 class="fw-bold" >Arena {{$arena}}, Match {{$match}}</h5>
                    <h4 class="fw-bold mt-4" style="">TUNGGAL</h4>
                </div>
            </div>
        </div>
        <div class="content-body d-flex gap-1">
            <div class="indikator" style="width: 20%">
                <div class="indikator-header border border-dark pt-2 pl-2" style="background-color: #ececec;">
                    <h6 class="fw-bold">Judge</h6>
                </div>
                <div class="indikator-body">
                    <div class="movement border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Judge</h6>  
                    </div>
                    <div class="correctness border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Judge</h6>
                    </div>
                    <div class="flow border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Judge</h6>
                    </div>
                    <div class="total border border-dark pt-2 pl-2 mt-1" style="background-color: #ececec;">
                        <h6 class="fw-bold">Judge</h6>
                    </div>
                </div>
            </div>
            <div class="nilai">
                <div class="nilai-1"></div>
                <div class="nilai-2"></div>
                <div class="nilai-3"></div>
                <div class="nilai-4"></div>
                <div class="nilai-5"></div>
            </div>
        </div>
    </div>
@endsection