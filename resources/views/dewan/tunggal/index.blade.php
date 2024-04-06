@extends('layouts.dewan.app') 
@section('title')
    Tunggal
@endsection
@section('content')
    @include('dewan.tunggal.header',['match'=>'1','arena'=>'A','nama'=>'ASEP YULDAN SANI'])
    @include('dewan.tunggal.body')
    @include('dewan.tunggal.footer')
@endsection