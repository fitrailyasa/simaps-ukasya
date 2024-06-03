@extends('layouts.admin.table')

@section('title', 'Jadwal TGR')

@section('table-kontrol-tgr', 'active')
@section('tgr', 'menu-open')

@section('topLeft')
    <h4>Kelola Data Jadwal TGR</h4>
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
            @if (auth()->user()->roles_id == 1)
                @foreach ($jadwaltgrs as $jadwaltgr)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwaltgr->partai ?? '-' }}</td>
                        <td>{{ $jadwaltgr->Gelanggang->nama ?? '-' }}</td>
                        <td>{{ $jadwaltgr->babak ?? '-' }}</td>
                        <td>{{ $jadwaltgr->PengundianTGRBiru->TGR->kategori ?? '-' }}
                            {{ $jadwaltgr->PengundianTGRBiru->TGR->jenis_kelamin == 'L' ? 'Putra' : 'Putri' ?? '-' }}
                            {{ $jadwaltgr->PengundianTGRBiru->TGR->golongan ?? '-' }}</td>
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
                        </td>
                    </tr>
            @endforeach
            @elseif (auth()->user()->roles_id == 2)
                @foreach ($jadwaltgrs as $jadwaltgr)
                    @if (auth()->user()->Gelanggang->jenis == $jadwaltgr->Gelanggang->jenis)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwaltgr->partai ?? '-' }}</td>
                            <td>{{ $jadwaltgr->Gelanggang->nama ?? '-' }}</td>
                            <td>{{ $jadwaltgr->babak ?? '-' }}</td>
                            <td>{{ $jadwaltgr->PengundianTGRBiru->TGR->kategori ?? '-' }}
                                {{ $jadwaltgr->PengundianTGRBiru->TGR->jenis_kelamin == 'L' ? 'Putra' : 'Putri' ?? '-' }}
                                {{ $jadwaltgr->PengundianTGRBiru->TGR->golongan ?? '-' }}</td>
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
                                @if ($jadwaltgr->id == $gelanggang_operator->jadwal && $jadwaltgr->tahap !== 'keputusan')
                                    <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/tunggal/{{$jadwaltgr->id}}">
                                        <i class="fa fa-tv"></i>
                                    </a>
                                    <form method="POST" action="stoptunggal/{{$jadwaltgr->id}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-danger">
                                            <i class=" fa fa-stop"></i>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="ubahtunggal/{{$jadwaltgr->id}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-primary mr-2">
                                            <i class=" fa fa-play"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
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
