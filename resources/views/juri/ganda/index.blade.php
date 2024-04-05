@extends('layouts.juri.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/juri-ganda.css') }}">
@endsection
@section('title')
    Ganda
@endsection

@section('content')
    @include('juri.ganda.header', [
        'pemain' => ['MOHD TAQIYUDDIN BIN HAMID', 'SAZZLAN BIN YUGA'],
        'region' => 'MALAYSIA',
        'arena' => 'A',
        'match' => '3',
        'juri' => '1',
        'jenis' => 'GANDA',
    ])
    @include('juri.ganda.content')
@endsection

@section('script')
@endsection
