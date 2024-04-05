@extends('layouts.admin.table')

@section('title', 'Jadwal TGR')

@section('table-jadwal-tgr', 'active')

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
            @foreach ($jadwaltgrs as $jadwaltgr)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwaltgr->partai ?? '-' }}</td>
                    <td>{{ $jadwaltgr->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $jadwaltgr->babak ?? '-' }}</td>
                    <td>{{ $jadwaltgr->kelompok ?? '-' }}</td>
                    <td class="bg-primary">{{ $jadwaltgr->PengundianTGRBiru->TGR->nama ?? '-' }}
                        ({{ $jadwaltgr->PengundianTGRBiru->TGR->kontingen ?? '-' }})
                    </td>
                    <td class="bg-danger">{{ $jadwaltgr->PengundianTGRMerah->TGR->nama ?? '-' }}
                        ({{ $jadwaltgr->PengundianTGRMerah->TGR->kontingen ?? '-' }})</td>
                    <td>{{ $jadwaltgr->PemenangTGR->TGR->nama ?? '' }}
                        ({{ $jadwaltgr->PemenangTGR->TGR->kontingen ?? 'Belum Bertanding' }})
                    </td>
                    <td>{{ $jadwaltgr->skor_biru ?? '0' }} - {{ $jadwaltgr->skor_merah ?? '0' }}</td>
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
                <th>Pemenang</th>
                <th>Skor</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
