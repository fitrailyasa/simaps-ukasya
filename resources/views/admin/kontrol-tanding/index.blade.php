@extends('layouts.admin.table')

@section('title', 'Kontrol Tanding')

@section('table-kontrol-tanding', 'active')
@section('tanding', 'menu-open')

@section('topLeft')
    <h4>Kelola Data Kontrol Tanding</h4>
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
            @foreach ($timbangulangs as $timbangulang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $timbangulang->JadwalTanding->partai ?? '-' }}</td>
                    <td>{{ $timbangulang->JadwalTanding->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $timbangulang->JadwalTanding->babak ?? '-' }}</td>
                    <td>{{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->kelas ?? '-' }}
                        {{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->jenis_kelamin == 'L' ? 'Putra' : 'Putri' ?? '-' }}
                        {{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->golongan ?? '-' }}</td>
                    <td class="bg-primary"><b>{{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->nama ?? '-' }}
                        ({{ $timbangulang->JadwalTanding->PengundianTandingBiru->Tanding->kontingen ?? '-' }})</b>
                        <br>({{ $timbangulang->status_biru ?? 'Belum Ditimbang Ulang' }})
                    </td>
                    <td class="bg-danger"><b>{{ $timbangulang->JadwalTanding->PengundianTandingMerah->Tanding->nama ?? '-' }}
                        ({{ $timbangulang->JadwalTanding->PengundianTandingMerah->Tanding->kontingen ?? '-' }})</b>
                        <br>({{ $timbangulang->status_merah ?? 'Belum Ditimbang Ulang' }})
                    </td>
                    <td>{{ $timbangulang->JadwalTanding->PemenangTanding->Tanding->nama ?? '' }}
                        ({{ $timbangulang->JadwalTanding->PemenangTanding->Tanding->kontingen ?? 'Belum Bertanding' }})
                    </td>
                    <td>{{ $timbangulang->JadwalTanding->skor_biru ?? '0' }} - {{ $timbangulang->JadwalTanding->skor_merah ?? '0' }}</td>
                    <td class="manage-row">

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
