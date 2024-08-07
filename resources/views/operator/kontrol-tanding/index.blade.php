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
            @foreach ($jadwaltandings as $jadwaltanding)
                @if (auth()->user()->Gelanggang->jenis == $jadwaltanding->Gelanggang->jenis)
                @php
                    $waitingPartaiMerah = $jadwaltandings
                        ->where('next_sudut', 1)
                        ->where('next_partai', $jadwaltanding->partai)
                        ->first();
                    $waitingPartaiBiru = $jadwaltandings
                        ->where('next_sudut', 2)
                        ->where('next_partai', $jadwaltanding->partai)
                        ->first();
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwaltanding->partai ?? '-' }}</td>
                    <td>{{ $jadwaltanding->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $jadwaltanding->babak ?? '-' }}</td>
                    <td>
                        {{ $jadwaltanding->PengundianTandingBiru->Tanding->kelas ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->kelas ?? '-') }}
                        {{ $jadwaltanding->PengundianTandingBiru->Tanding->jenis_kelamin ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->jenis_kelamin ?? '-') }}
                        {{ $jadwaltanding->PengundianTandingBiru->Tanding->golongan ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->golongan ?? '-') }}
                    </td>
                    <td class="bg-primary">
                        @if ($jadwaltanding->sudut_biru)
                            <b>{{ $jadwaltanding->PengundianTandingBiru->Tanding->nama ?? '-' }}
                                ({{ $jadwaltanding->PengundianTandingBiru->Tanding->kontingen ?? '-' }})
                            </b><br>({{ $jadwaltanding->status_biru ?? 'Belum Ditimbang Ulang' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiBiru ? $waitingPartaiBiru->partai : '1' }}
                        @endif
                    </td>
                    <td class="bg-danger">
                        @if ($jadwaltanding->sudut_merah)
                            <b>{{ $jadwaltanding->PengundianTandingMerah->Tanding->nama ?? '-' }}
                                ({{ $jadwaltanding->PengundianTandingMerah->Tanding->kontingen ?? '-' }})
                            </b><br>({{ $jadwaltanding->status_merah ?? 'Belum Ditimbang Ulang' }})
                        @else
                            Pemenang Partai ke-{{ $waitingPartaiMerah ? $waitingPartaiMerah->partai : '1' }}
                        @endif
                    </td>
                    <td>{{ $jadwaltanding->PemenangTanding->Tanding->nama ?? '' }}
                        ({{ $jadwaltanding->PemenangTanding->Tanding->kontingen ?? 'Belum Bertanding' }})
                    </td>
                    <td>{{ $jadwaltanding->skor_biru ?? '0' }} -
                        {{ $jadwaltanding->skor_merah ?? '0' }}</td>
                    <td class="manage-row justify-content-center d-flex flex-row">
                        @if ($gelanggang_operator->Jadwal_Tanding && $jadwaltanding->partai == $gelanggang_operator->Jadwal_Tanding->partai &&  $jadwaltanding->tahap == "persiapan"  && $gelanggang_operator->jenis == "Tanding")
                            <a role="button" class="btn-sm btn-primary mr-2" href="kontrol-tanding/{{$jadwaltanding->id}}">
                                <i class="fa fa-tv"></i>
                            </a>
                            <form method="POST" action="stop/{{$jadwaltanding->id}}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-sm btn-danger">
                                    <i class=" fa fa-stop"></i>
                                </button>
                            </form>
                        @elseif ($jadwaltanding->tahap == "menunggu")
                            <form method="POST" action="ubah/{{$jadwaltanding->id}}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-sm btn-primary mr-2">
                                    <i class="fa fa-play"></i>
                                </button>
                            </form>
                            @else
                            <form method="POST" action="reset/{{$jadwaltanding->id}}" style="display:inline;">
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
