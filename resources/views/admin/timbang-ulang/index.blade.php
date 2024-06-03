@extends('layouts.admin.table')

@section('title', 'Timbang Ulang Partai')

@section('table-timbang-ulang', 'active')
@section('tanding', 'menu-open')

@section('topLeft')
    <h4>Jadwal Tanding</h4>
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
                    <td>{{ $jadwaltanding->PengundianTandingBiru->Tanding->kelas ?? '-' }}
                        {{ $jadwaltanding->PengundianTandingBiru->Tanding->jenis_kelamin == 'L' ? 'Putra' : 'Putri' ?? '-' }}
                        {{ $jadwaltanding->PengundianTandingBiru->Tanding->golongan ?? '-' }}</td>
                    <td class="bg-primary">{{ $jadwaltanding->PengundianTandingBiru->Tanding->nama ?? '-' }}
                        ({{ $jadwaltanding->PengundianTandingBiru->Tanding->kontingen ?? '-' }})
                    </td>
                    <td class="bg-danger">{{ $jadwaltanding->PengundianTandingMerah->Tanding->nama ?? '-' }}
                        ({{ $jadwaltanding->PengundianTandingMerah->Tanding->kontingen ?? '-' }})</td>
                    <td class="manage-row">
                        @include('admin.timbang-ulang.create')
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

    <hr>
    <h4>Data Timbang Ulang</h4>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Partai</th>
                <th>Gelanggang</th>
                <th>Babak</th>
                <th>Kelompok</th>
                <th>Timbang Ulang Biru</th>
                <th>Timbang Ulang Merah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($timbangulangs as $timbangulang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $timbangulang->JadwalTanding->partai ?? '-' }}</td>
                    <td>{{ $timbangulang->JadwalTanding->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $timbangulang->JadwalTanding->babak ?? '-' }}</td>
                    <td>{{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->kelas ?? '-' }}
                        {{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->jenis_kelamin == 'L' ? 'Putra' : 'Putri' ?? '-' }}
                        {{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->golongan ?? '-' }}</td>
                    <td class="bg-primary">{{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->nama ?? '-' }}
                        ({{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->kontingen ?? '-' }})
                        - {{ $timbangulang->berat_biru ?? '-' }} Kg
                        ({{ $timbangulang->status_biru ?? '-' }})</td>
                    <td class="bg-danger">{{ $timbangulang->JadwalTanding->PengundianTandingMerah->Tanding->nama ?? '-' }}
                        ({{ $timbangulang->JadwalTanding->PengundianTandingMerah->Tanding->kontingen ?? '-' }}) -
                        {{ $timbangulang->berat_merah ?? '-' }} Kg
                        ({{ $timbangulang->status_merah ?? '-' }})</td>
                    <td class="manage-row">
                        @include('admin.timbang-ulang.edit')
                        @include('admin.timbang-ulang.delete')
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
                <th>Timbang Ulang Biru</th>
                <th>Timbang Ulang Merah</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
