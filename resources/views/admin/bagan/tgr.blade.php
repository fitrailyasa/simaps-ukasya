@extends('layouts.admin.bagan')

@section('title', 'Bagan TGR')

@section('table-bagan-tgr', 'active')

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
                    <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Tunggal">Tunggal</option>
                        <option value="Ganda">Ganda</option>
                        <option value="Regu">Regu</option>
                        <option value="Solo Kreatif">Solo Kreatif</option>
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
            teams: {{ $pengundiantgr->count() }}, // Dynamically set the number of teams
            topOffset: 50,
            scale: 0.45,
            horizontal: 0,
            height: '1000px',
            icons: true,
            teamNames: [
                @foreach ($pengundiantgr as $team)
                    {
                        name: '{{ $team->TGR->nama }}',
                        seed: '{{ $team->no_undian }}'
                    },
                @endforeach
            ]
        });
    </script>
@endsection
