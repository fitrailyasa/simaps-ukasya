@extends('layouts.admin.table')

@section('title', 'Kontrol TGR')

@section('table-kontrol-tgr', 'active')
@section('tgr', 'menu-open')

@section('topLeft')
    <h4>Kelola Data Kontrol TGR</h4>
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
                @php
                    $waitingPartaiMerah = $jadwaltgrs
                        ->where('next_sudut', 2)
                        ->where('next_partai', $jadwaltgr->partai)
                        ->first();
                    $waitingPartaiBiru = $jadwaltgrs
                        ->where('next_sudut', 1)
                        ->where('next_partai', $jadwaltgr->partai)
                        ->first();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwaltgr->partai ?? '-' }}</td>
                    <td>{{ $jadwaltgr->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $jadwaltgr->babak ?? '-' }}</td>
                    <td>
                        {{ $jadwaltgr->PengundianTGRBiru->TGR->kategori ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->kategori ?? '-') }}
                        {{ $jadwaltgr->PengundianTGRBiru->TGR->jenis_kelamin ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->jenis_kelamin ?? '-') }}
                        {{ $jadwaltgr->PengundianTGRBiru->TGR->golongan ?? ($waitingPartaiBiru->PengundianTGRBiru->TGR->golongan ?? '-') }}
                    </td>
                    <td class="bg-primary">
                        @if ($jadwaltgr->sudut_biru)
                            <b>{{ $jadwaltgr->PengundianTGRBiru->TGR->nama ?? '-' }}
                                ({{ $jadwaltgr->PengundianTGRBiru->TGR->kontingen ?? '-' }})
                            </b><br>({{ $jadwaltgr->status_biru ?? 'Belum Ditimbang Ulang' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiBiru ? $waitingPartaiBiru->partai : '1' }}
                        @endif
                    </td>
                    <td class="bg-danger">
                        @if ($jadwaltgr->sudut_merah)
                            <b>{{ $jadwaltgr->PengundianTGRMerah->TGR->nama ?? '-' }}
                                ({{ $jadwaltgr->PengundianTGRMerah->TGR->kontingen ?? '-' }})
                            </b><br>({{ $jadwaltgr->status_merah ?? 'Belum Ditimbang Ulang' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiMerah ? $waitingPartaiMerah->partai : '1' }}
                        @endif
                    </td>
                    <td>{{ $jadwaltgr->PemenangTgr->TGR->nama ?? '' }}
                        ({{ $jadwaltgr->PemenangTgr->TGR->kontingen ?? 'Belum Bertanding' }})
                    </td>
                    <td>{{ $jadwaltgr->skor_biru ?? '0' }} -
                        {{ $jadwaltgr->skor_merah ?? '0' }}</td>
                    <td class="manage-row">
                        @if ( $jadwaltgr->tahap == 'persiapan' || $jadwaltgr->tahap == "tampil")
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
                                            @case("Solo Kreatif")
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
                                    @elseif($jadwaltgr->tahap == "menunggu")
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
