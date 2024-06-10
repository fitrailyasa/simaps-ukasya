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
                @if ($jadwaltanding->berat_merah == null && $jadwaltanding->berat_biru == null)
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
                            @include('admin.timbang-ulang.create')
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
                @if ($timbangulang->berat_merah != null && $timbangulang->berat_biru != null)
                    @php
                        $waitingPartaiMerah = $timbangulangs
                            ->where('next_sudut', 1)
                            ->where('next_partai', $timbangulang->partai)
                            ->first();
                        $waitingPartaiBiru = $timbangulangs
                            ->where('next_sudut', 2)
                            ->where('next_partai', $timbangulang->partai)
                            ->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $timbangulang->partai ?? '-' }}</td>
                        <td>{{ $timbangulang->Gelanggang->nama ?? '-' }}</td>
                        <td>{{ $timbangulang->babak ?? '-' }}</td>
                        <td>{{ $timbangulang->PengundianTandingBiru->Tanding->kelas ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->kelas ?? '-') }}
                            {{ $timbangulang->PengundianTandingBiru->Tanding->jenis_kelamin ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->jenis_kelamin ?? '-') }}
                            {{ $timbangulang->PengundianTandingBiru->Tanding->golongan ?? ($waitingPartaiBiru->PengundianTandingBiru->Tanding->golongan ?? '-') }}
                        </td>
                        <td class="bg-primary">
                            @if ($timbangulang->sudut_biru)
                                {{ $timbangulang->PengundianTandingBiru->Tanding->nama ?? '' }}
                                ({{ $timbangulang->PengundianTandingBiru->Tanding->kontingen ?? '' }})
                            @else
                                Pemenang Partai ke-{{ $waitingPartaiBiru ? $waitingPartaiBiru->partai : '1' }}
                            @endif
                        </td>
                        <td class="bg-danger">
                            @if ($timbangulang->sudut_merah)
                                {{ $timbangulang->PengundianTandingMerah->Tanding->nama ?? '' }}
                                ({{ $timbangulang->PengundianTandingMerah->Tanding->kontingen ?? '' }})
                            @else
                                Pemenang Partai ke-{{ $waitingPartaiMerah ? $waitingPartaiMerah->partai : '1' }}
                            @endif
                        </td>
                        <td class="manage-row">
                            @include('admin.timbang-ulang.edit')
                            @include('admin.timbang-ulang.delete')
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
                <th>Timbang Ulang Biru</th>
                <th>Timbang Ulang Merah</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
