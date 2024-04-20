@extends('layouts.client.app')



@section('content')
@section('style')
    <link rel="stylesheet" href="{{url('/assets/css/dewan/tanding.css')}}">
@endsection
@include('client.penonton.tanding.navbar',['arena'=>$arena,'class'=>$class])
@if ($tahap == 'persiapan')
    @include('client.penonton.tanding.persiapan',['pesilat'=>$sudut,'partai'=>'100'])
@elseif($tahap == 'tanding')
    @include('client.penonton.tanding.tanding')  
@elseif($tahap == 'hasil')
    @include('client.penonton.tanding.hasil',['pemenang'=>'biru'])
@endif
@endsection