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
                @foreach ($jadwaltgrs as $jadwaltgr)
                    @if (auth()->user()->Gelanggang->id == $jadwaltgr->Gelanggang->id)
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
                                @if ($jadwaltgr->id == $gelanggang_operator->jadwal && $jadwaltgr->tahap == 'menunggu'  && $gelanggang_operator->jenis !== "Tanding")
                                    @switch($jadwaltgr->jenis)
                                        @case("Tunggal")
                                            <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/tunggal/{{$jadwaltgr->id}}">
                                                <i class="fa fa-tv"></i>
                                            </a>
                                            @break
                                        @case("Ganda")
                                            <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/ganda/{{$jadwaltgr->id}}">
                                                <i class="fa fa-tv"></i>
                                            </a>
                                            @break
                                        @case("Regu")
                                            <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/regu/{{$jadwaltgr->id}}">
                                                <i class="fa fa-tv"></i>
                                            </a>
                                            @break
                                        @case("Solo_Kreatif")
                                            <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tgr/solo/{{$jadwaltgr->id}}">
                                                <i class="fa fa-tv"></i>
                                            </a>
                                            @break
                                        @default
                                            
                                    @endswitch
                                    <form method="POST" action="stop-tgr/{{$jadwaltgr->id}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-danger">
                                            <i class=" fa fa-stop"></i>
                                        </button>
                                    </form>
                                @elseif($jadwaltgr->gelanggang == $gelanggang_operator->id && $jadwaltgr->tahap == "persiapan")
                                    <form method="POST" action="ubah-tgr/{{$jadwaltgr->id}}/{{$jadwaltgr->jenis}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-primary mr-2">
                                            <i class=" fa fa-play"></i>
                                        </button>
                                    </form>
                                @else
                                <form method="POST" action="reset-tgr/{{$jadwaltgr->id}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-sm btn-primary mr-2">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endif
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