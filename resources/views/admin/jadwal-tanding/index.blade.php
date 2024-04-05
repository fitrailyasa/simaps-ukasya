@extends('layouts.admin.table')

@section('title', 'Jadwal Tanding')

@section('table-jadwal-tanding', 'active')

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
                <th>Pemenang</th>
                <th>Skor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwaltandings as $jadwaltanding)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwaltanding->partai ?? '-' }}</td>
                    <td>{{ $jadwaltanding->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $jadwaltanding->babak ?? '-' }}</td>
                    <td>{{ $jadwaltanding->kelompok ?? '-' }}</td>
                    <td class="bg-primary">{{ $jadwaltanding->PengundianTandingBiru->Tanding->nama ?? '-' }}
                        ({{ $jadwaltanding->PengundianTandingBiru->Tanding->kontingen ?? '-' }})
                    </td>
                    <td class="bg-danger">{{ $jadwaltanding->PengundianTandingMerah->Tanding->nama ?? '-' }}
                        ({{ $jadwaltanding->PengundianTandingMerah->Tanding->kontingen ?? '-' }})</td>
                    <td>{{ $jadwaltanding->PemenangTanding->Tanding->nama ?? '' }}
                        ({{ $jadwaltanding->PemenangTanding->Tanding->kontingen ?? 'Belum Bertanding' }})
                    </td>
                    <td>{{ $jadwaltanding->skor_biru ?? '0' }} - {{ $jadwaltanding->skor_merah ?? '0' }}</td>
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
                <th>Pemenang</th>
                <th>Skor</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
