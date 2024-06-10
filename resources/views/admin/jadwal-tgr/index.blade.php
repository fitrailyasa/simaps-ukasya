@extends('layouts.admin.table')

@section('title', 'Jadwal TGR')

@section('table-jadwal-tgr', 'active')
@section('tgr', 'menu-open')

@section('topLeft')
    <h4>Kelola Data Jadwal TGR</h4>
@endsection

@section('formCreate')
    @include('admin.jadwal-tgr.create')
@endsection

@section('formUpload')
    @include('admin.jadwal-tgr.upload')
@endsection

@section('formDeleteAll')
    @include('admin.jadwal-tgr.deleteAll')
@endsection

@section('table')
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Partai</th>
                <th>Gelanggang</th>
                <th>Babak</th>
                <th>Kelompok</th>
                <th>Sudut Biru</th>
                <th>Sudut Merah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwaltgrs as $jadwaltgr)
                @php
                    $waitingPartaiMerah = $jadwaltgrs
                        ->where('next_sudut', 1)
                        ->where('next_partai', $jadwaltgr->partai)
                        ->first();
                    $waitingPartaiBiru = $jadwaltgrs
                        ->where('next_sudut', 2)
                        ->where('next_partai', $jadwaltgr->partai)
                        ->first();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwaltgr->partai ?? '-' }}</td>
                    <td>{{ $jadwaltgr->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $jadwaltgr->babak ?? '-' }}</td>
                    <td>{{ $jadwaltgr->PengundianTGRBiru->TGR->kategori ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->kategori ?? '-') }}
                        {{ $jadwaltgr->PengundianTGRBiru->TGR->jenis_kelamin ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->jenis_kelamin ?? '-') }}
                        {{ $jadwaltgr->PengundianTGRBiru->TGR->golongan ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->golongan ?? '-') }}
                    </td>
                    <td class="bg-primary">
                        @if ($jadwaltgr->sudut_biru)
                            {{ $jadwaltgr->PengundianTGRBiru->TGR->nama ?? '' }}
                            ({{ $jadwaltgr->PengundianTGRBiru->TGR->kontingen ?? '' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiBiru ? $waitingPartaiBiru->partai : '1' }}
                        @endif
                    </td>
                    <td class="bg-danger">
                        @if ($jadwaltgr->sudut_merah)
                            {{ $jadwaltgr->PengundianTGRMerah->TGR->nama ?? '' }}
                            ({{ $jadwaltgr->PengundianTGRMerah->TGR->kontingen ?? '' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiMerah ? $waitingPartaiMerah->partai : '1' }}
                        @endif
                    </td>
                    <td class="manage-row">
                        @include('admin.jadwal-tgr.edit')
                        @include('admin.jadwal-tgr.delete')
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Partai</th>
                <th>Gelanggang</th>
                <th>Babak</th>
                <th>Kelompok</th>
                <th>Sudut Biru</th>
                <th>Sudut Merah</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
