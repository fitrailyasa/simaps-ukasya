@extends('layouts.juri.app')
@section('style')
    <link rel="stylesheet" href="{{ url('assets/css/juri-solo.css') }}">
@endsection
@section('title')
    Solo
@endsection

@section('content')
    @include('juri.solo.header', [
        'pemain' => ['MOHD TAQIYUDDIN BIN HAMID', 'SAZZLAN BIN YUGA'],
        'region' => 'MALAYSIA',
        'arena' => 'A',
        'match' => '3',
        'juri' => '1',
        'jenis' => 'SOLO',
    ])
    @include('juri.solo.content')
@endsection

@section('script')
@endsection
