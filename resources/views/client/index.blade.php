@extends('layouts.client.app')

@section('title', 'Beranda')

{{-- @section('textHome', 'bg-warning rounded') --}}

@section('content')

    <div class="pt-5"
        style="background-image: url('{{ asset('assets/img/bg.jpg') }}'); background-size: 100%; background-repeat: no-repeat; background-position: center; height: 100vh;">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/img/ipsi.png') }}" class="img-fluid" width="300px" alt="">
        </div>
        <div class="text-center mb-3">
            <h1 class="">Halaman Penonton</h1>
            <p>Selamat Datang di Aplikasi SIMAPS</p>
            <a href="#" class="btn btn-primary">Beranda</a>
            <a href="#" class="btn btn-primary">Arena A</a>
            <a href="#" class="btn btn-primary">Arena B</a>
            <a href="#" class="btn btn-primary">Arena C</a>
            <a href="#" class="btn btn-primary">Arena D</a>
        </div>
        <div class="d-flex justify-content-center pb-5">
            <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa-solid fa-right-to-bracket me-1"></i>
                Login</a>
        </div>
    </div>

@endsection
