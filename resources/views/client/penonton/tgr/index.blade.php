@extends('layouts.client.app')



@section('content')
@include('client.penonton.tgr.navbar',['arena'=>$arena,'class'=>$class])
@if ($tahap == 'persiapan')
    @include('client.penonton.tgr.persiapan',['pesilat'=>$sudut,'partai'=>'100'])
@elseif($tahap == 'tampil')
    @include('client.penonton.tgr.tanding',['nilai'=>'true'])  
@elseif($tahap == 'hasil')
    @include('client.penonton.tgr.hasil',['pemenang'=>'biru'])
@endif
@endsection