@extends('layouts.client.app')
@section('content')
    <div class="pt-5"
        style="background-image: url('{{ asset('assets/img/bg.jpg') }}'); background-size: 100%; background-repeat: no-repeat; background-position: center; height: 100vh;">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/img/ipsi.webp') }}" class="img-fluid" width="300px" alt="">
        </div>
        <div class="text-center mb-3">
            <h1 class="">Halaman Ketua Pertandingan</h1>
            <p>Selamat Datang di Aplikasi SIMAPS</p>
            <a href="#" class="btn btn-primary">Beranda</a>

            <a href="/ketuapertandingan/1" class="btn btn-primary">Arena A</a>
            <a href="/ketuapertandingan/2" class="btn btn-primary">Arena B</a>
            <a href="/ketuapertandingan/3" class="btn btn-primary">Arena C</a>
            <a href="/ketuapertandingan/4" class="btn btn-primary">Arena D</a>
            <a href="/ketuapertandingan/5" class="btn btn-primary">Arena E</a>
        </div>
    </div>
@endsection
