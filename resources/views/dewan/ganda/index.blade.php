@extends('layouts.dewan.app') 
@section('title')
    Ganda
@endsection
@section('content')
    @include('dewan.ganda.header',['match'=>'1','arena'=>'A','nama'=>['ASEP YULDAN SANI','RIRIN RINASIH']])
    @include('dewan.ganda.body')
    @include('dewan.ganda.footer')
@endsection