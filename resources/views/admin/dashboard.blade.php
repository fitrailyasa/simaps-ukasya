@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('activeDashboard', 'active')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $tanding }}</h3>

                    <p>Tanding</p>
                </div>
                <a href="{{ route('admin.tanding.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $tgr }}</h3>

                    <p>TGR</p>
                </div>
                <a href="{{ route('admin.tgr.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jadwaltanding }}</h3>

                    <p>Jadwal Tanding</p>
                </div>
                <a href="{{ route('admin.jadwal-tanding.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jadwaltgr }}</h3>

                    <p>Jadwal TGR</p>
                </div>
                <a href="{{ route('admin.jadwal-tgr.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
