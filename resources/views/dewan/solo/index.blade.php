@extends('layouts.dewan.app') 
@section('title')
    Solo
@endsection
@section('content')
    @include('dewan.solo.header',['match'=>'1','arena'=>'A','nama'=>['ASEP YULDAN SANI','RIRIN RINASIH']])
    @include('dewan.solo.body')
    @include('dewan.solo.footer')
@endsection