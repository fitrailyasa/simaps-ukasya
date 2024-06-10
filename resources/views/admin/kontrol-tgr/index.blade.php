@extends('layouts.admin.table')

@section('title', 'Kontrol Tgr')

@section('table-kontrol-tgr', 'active')
@section('tgr', 'menu-open')

@section('topLeft')
    <h4>Kelola Data Kontrol Tgr</h4>
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
                    <td>{{ $jadwaltgr->PengundianTGRBiru->TGR->kelas ?? '-' }}
                        {{ $jadwaltgr->PengundianTGRBiru->TGR->jenis_kelamin ?? '-' }}
                        {{ $jadwaltgr->PengundianTGRBiru->TGR->golongan ?? '-' }}</td>
                    <td class="bg-primary"><b>{{ $jadwaltgr->PengundianTGRBiru->TGR->nama ?? '-' }}
                            ({{ $jadwaltgr->PengundianTGRBiru->TGR->kontingen ?? '-' }})
                        </b>
                        <br>({{ $jadwaltgr->status_biru ?? 'Belum Ditimbang Ulang' }})
                    </td>
                    <td class="bg-danger"><b>{{ $jadwaltgr->PengundianTGRMerah->TGR->nama ?? '-' }}
                            ({{ $jadwaltgr->PengundianTGRMerah->TGR->kontingen ?? '-' }})</b>
                        <br>({{ $jadwaltgr->status_merah ?? 'Belum Ditimbang Ulang' }})
                    </td>
                    <td>{{ $jadwaltgr->PemenangTGR->TGR->nama ?? '' }}
                        ({{ $jadwaltgr->PemenangTGR->TGR->kontingen ?? 'Belum Bertanding' }})
                    </td>
                    <td>{{ $jadwaltgr->skor_biru ?? '0' }} - {{ $jadwaltgr->skor_merah ?? '0' }}</td>
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
