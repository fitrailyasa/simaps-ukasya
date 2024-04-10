@extends('layouts.admin.bagan')

@section('title', 'Bagan Tanding')

@section('table-bagan-tanding', 'active')

@section('style')
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/bagan/css/jquery.bracket-world.css') }}" rel="stylesheet">
    <style>
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="card p-3">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="d-flex justify-content-center align-items-center">
                <div class="form-group ml-0">
                    <select name="golongan" id="golongan" class="form-select @error('golongan') is-invalid @enderror">
                        <option value="">-- Pilih Golongan --</option>
                        <option value="Usia Dini 1">Usia Dini 1</option>
                        <option value="Usia Dini 2">Usia Dini 2</option>
                        <option value="Pra Remaja">Pra Remaja</option>
                        <option value="Remaja">Remaja</option>
                        <option value="Dewasa">Dewasa</option>
                        <option value="Master">Master</option>
                    </select>
                </div>
                <div class="form-group ml-2">
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Putra</option>
                        <option value="P">Putri</option>
                    </select>
                </div>
                <div class="form-group ml-2">
                    <select name="kelas" id="kelas" class="form-select @error('kelas') is-invalid @enderror">
                        <option value="">-- Pilih Kelas Tanding --</option>
                        <option value="Kelas A">Kelas A</option>
                        <option value="Kelas B">Kelas B</option>
                        <option value="Kelas C">Kelas C</option>
                        <option value="Kelas D">Kelas D</option>
                        <option value="Kelas E">Kelas E</option>
                        <option value="Kelas F">Kelas F</option>
                        <option value="Kelas G">Kelas G</option>
                        <option value="Kelas H">Kelas H</option>
                        <option value="Kelas I">Kelas I</option>
                        <option value="Kelas J">Kelas J</option>
                        <option value="Kelas K">Kelas K</option>
                        <option value="Kelas L">Kelas L</option>
                        <option value="Kelas M">Kelas M</option>
                        <option value="Kelas N">Kelas N</option>
                        <option value="Kelas O">Kelas O</option>
                        <option value="Kelas P">Kelas P</option>
                        <option value="Kelas Q">Kelas Q</option>
                        <option value="Kelas R">Kelas R</option>
                        <option value="Kelas S">Kelas S</option>
                        <option value="Open 1">Open 1</option>
                        <option value="Open 2">Open 2</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center mb-3">
                <button type="submit" class="btn mx-1 btn-primary">Generate</button>
                <button type="button" class="btn mx-1 btn-success" onclick="window.print();">Print</button>
            </div>
        </form>
        <div id="bracket2" class="bracket"></div>
    </div>
@endsection

@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/bagan/js/jquery.bracket-world.min.js') }}"></script>
    <script>
        $('#bracket2').bracket({
            teams: {{ $pengundiantanding->count() }}, // Dynamically set the number of teams
            topOffset: 50,
            scale: 0.45,
            horizontal: 0,
            height: '1000px',
            icons: true,
            teamNames: [
                @foreach ($pengundiantanding as $team)
                    {
                        name: '{{ $team->Tanding->nama }}',
                        seed: '{{ $team->no_undian }}'
                    },
                @endforeach
            ]
        });
    </script>
@endsection
