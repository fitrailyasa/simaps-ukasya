@extends('layouts.admin.bagan')

@section('title', 'Bagan TGR')

@section('table-bagan-tgr', 'active')
@section('tgr', 'menu-open')

@section('style')
    
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
    @if (session('alert'))
        <script>
            alert("{{ session('alert') }}");
        </script>
    @endif
    <div class="card p-3">
        <form action="{{ route('admin.generate.tgr') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                        <option value="Putra">Putra</option>
                        <option value="Putri">Putri</option>
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
        <div id="bracket2" class="bracket">
            @if (isset($template))
                {!! $template !!}
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/bagan/js/jquery.bracket-world.min.js') }}"></script>
    @if (isset($script))
        {!! $script !!}
    @endif
@endsection
