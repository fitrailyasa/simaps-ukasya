@extends('layouts.client.app')
@section('content')
    <div class="pt-5"
        style="background-image: url('{{ asset('assets/img/bg.jpg') }}'); background-size: 100%; background-repeat: no-repeat; background-position: center; height: 100vh;">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/img/ipsi.png') }}" class="img-fluid" width="300px" alt="">
        </div>
        <div class="text-center mb-3">
            <h1 class="">Halaman Ketua Pertandingan</h1>
            <p>Selamat Datang di Aplikasi SIMAPS</p>
            <a href="#" class="btn btn-primary">Beranda</a>
            <a href="{{ route('ketua.tanding') }}" class="btn btn-primary">Arena A</a>
            <a href="{{ route('ketua.tunggal') }}" class="btn btn-primary">Arena B</a>
            <a href="{{ route('ketua.ganda') }}" class="btn btn-primary">Arena C</a>
            <a href="{{ route('ketua.regu') }}" class="btn btn-primary">Arena D</a>
            <a href="{{ route('ketua.solo') }}" class="btn btn-primary">Arena E</a>
        </div>
    </div>
@endsection
