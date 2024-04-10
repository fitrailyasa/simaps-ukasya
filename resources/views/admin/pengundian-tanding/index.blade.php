@extends('layouts.admin.table')

@section('title', 'Pengundian Tanding')

@section('table-pengundian-tanding', 'active')

@section('topLeft')
    @include('admin.pengundian-tanding.create')
@endsection

@section('formDeleteAll')
    @include('admin.pengundian-tanding.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Golongan</th>
                <th>Kelas</th>
                <th>Kelamin</th>
                <th>Atlet</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $unique_combinations = []; // Array untuk melacak kombinasi unik
            ?>
            @foreach ($pengundiantandings as $pengundiantanding)
                <?php
                $combination = $pengundiantanding->Tanding->golongan . '-' . $pengundiantanding->Tanding->jenis_kelamin . '-' . $pengundiantanding->Tanding->kelas; // Kombinasi golongan, jenis kelamin, dan kelas
                if (!isset($unique_combinations[$combination])) {
                    $unique_combinations[$combination] = 0; // Inisialisasi jumlah atlet untuk kombinasi unik
                }
                $unique_combinations[$combination]++; // Menambah jumlah atlet untuk kombinasi unik
                ?>
            @endforeach

            <?php $row_number = 1; ?>
            @foreach ($unique_combinations as $combination => $count)
                <?php
                [$golongan, $jenis_kelamin, $kelas] = explode('-', $combination); // Memecah kombinasi menjadi golongan, jenis kelamin, dan kelas
                ?>
                <tr>
                    <td>{{ $row_number }}</td>
                    <td>{{ $golongan }}</td>
                    <td>{{ $kelas }}</td>
                    <td>{{ $jenis_kelamin }}</td>
                    <td>{{ $count }} Atlet</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a class="btn-sm btn-primary" href="{{ route('admin.pengundian-tanding.table', $kelompok) }}"><i
                                    class="fas fa-eye"></i></a>
                        @elseif (auth()->user()->roles_id == 2)
                            <a class="btn-sm btn-primary" href="{{ route('op.pengundian-tanding.table', $kelompok) }}"><i
                                    class="fas fa-eye"></i></a>
                        @endif
                    </td>
                </tr>
                <?php $row_number++; ?>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Golongan</th>
                <th>Kelas</th>
                <th>Kelamin</th>
                <th>Atlet</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
