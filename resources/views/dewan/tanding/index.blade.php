@extends('layouts.dewan.app') 
@section('style')
    <link rel="stylesheet" href="{{url('assets/css/dewan/tanding.css')}}">
@endsection
@section('title')
    Tanding
@endsection
@section('content')
    @include('dewan.tanding.header',['kelas_penyisihan'=>'A','gelombang'=>'A','partai'=>'100'])
    @include('dewan.tanding.body',['pesilat_a'=>'Pesilat','pesilat_b'=>'Pesilat'])
    @include('dewan.tanding.tombol')
@endsection
