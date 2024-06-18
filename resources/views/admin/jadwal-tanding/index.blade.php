@extends('layouts.admin.table')

@section('title', 'Jadwal Tanding')

@section('table-jadwal-tanding', 'active')
@section('tanding', 'menu-open')

@section('topLeft')
    <h4>Kelola Data Jadwal Tanding</h4>
@endsection

@section('formCreate')
    @include('admin.jadwal-tanding.create')
@endsection

@section('formUpload')
    @include('admin.jadwal-tanding.upload')
@endsection

@section('formDeleteAll')
    @include('admin.jadwal-tanding.deleteAll')
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
            @foreach ($jadwaltandings as $jadwaltanding)
                @php
                    $waitingPartaiMerah = $jadwaltandings
                        ->where('next_sudut', 2)
                        ->where('next_partai', $jadwaltanding->partai)
                        ->first();
                    $waitingPartaiBiru = $jadwaltandings
                        ->where('next_sudut', 1)
                        ->where('next_partai', $jadwaltanding->partai)
                        ->first();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwaltanding->partai ?? '-' }}</td>
                    <td>{{ $jadwaltanding->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $jadwaltanding->babak ?? '-' }}</td>
                    <td>{{ $jadwaltanding->PengundianTandingBiru->Tanding->kelas ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->kelas ?? '-') }}
                        {{ $jadwaltanding->PengundianTandingBiru->Tanding->jenis_kelamin ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->jenis_kelamin ?? '-') }}
                        {{ $jadwaltanding->PengundianTandingBiru->Tanding->golongan ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->golongan ?? '-') }}
                    </td>
                    <td class="bg-primary">
                        @if ($jadwaltanding->sudut_biru)
                            {{ $jadwaltanding->PengundianTandingBiru->Tanding->nama ?? '' }}
                            ({{ $jadwaltanding->PengundianTandingBiru->Tanding->kontingen ?? '' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiBiru ? $waitingPartaiBiru->partai : '1' }}
                        @endif
                    </td>
                    <td class="bg-danger">
                        @if ($jadwaltanding->sudut_merah)
                            {{ $jadwaltanding->PengundianTandingMerah->Tanding->nama ?? '' }}
                            ({{ $jadwaltanding->PengundianTandingMerah->Tanding->kontingen ?? '' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiMerah ? $waitingPartaiMerah->partai : '1' }}
                        @endif
                    </td>
                    <td class="manage-row">
                        @include('admin.jadwal-tanding.edit')
                        @include('admin.jadwal-tanding.delete')
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
