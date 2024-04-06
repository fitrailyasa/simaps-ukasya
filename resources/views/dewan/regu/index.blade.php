@extends('layouts.dewan.app') 
@section('title')
    Regu
@endsection
@section('content')
    @include('dewan.regu.header',['match'=>'1','arena'=>'A','nama'=>['ASEP YULDAN SANI','RIRIN RINASIH']])
    @include('dewan.regu.body')
    @include('dewan.regu.footer')
@endsection