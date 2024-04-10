@extends('layouts.admin.table')

@section('title', 'Pengundian TGR')

@section('table-pengundian-tgr', 'active')

@section('topLeft')
    @include('admin.pengundian-tgr.create')
@endsection

@section('formDeleteAll')
    @include('admin.pengundian-tgr.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Golongan</th>
                <th>Kategori</th>
                <th>Kelamin</th>
                <th>Atlet</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $unique_combinations = []; // Array untuk melacak kombinasi unik
            ?>
            @foreach ($pengundiantgrs as $pengundiantgr)
                <?php
                $combination = $pengundiantgr->TGR->golongan . '-' . $pengundiantgr->TGR->jenis_kelamin . '-' . $pengundiantgr->TGR->kategori; // Kombinasi golongan, jenis kelamin, dan kategori
                if (!isset($unique_combinations[$combination])) {
                    $unique_combinations[$combination] = 0; // Inisialisasi jumlah atlet untuk kombinasi unik
                }
                $unique_combinations[$combination]++; // Menambah jumlah atlet untuk kombinasi unik
                ?>
            @endforeach

            <?php $row_number = 1; ?>
            @foreach ($unique_combinations as $combination => $count)
                <?php
                [$golongan, $jenis_kelamin, $kategori] = explode('-', $combination); // Memecah kombinasi menjadi golongan, jenis kelamin, dan kategori
                ?>
                <tr>
                    <td>{{ $row_number }}</td>
                    <td>{{ $golongan }}</td>
                    <td>{{ $kategori }}</td>
                    <td>{{ $jenis_kelamin }}</td>
                    <td>{{ $count }} Atlet</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a class="btn-sm btn-primary" href="{{ route('admin.pengundian-tgr.table', $kelompok) }}"><i
                                    class="fas fa-eye"></i></a>
                        @elseif (auth()->user()->roles_id == 2)
                            <a class="btn-sm btn-primary" href="{{ route('op.pengundian-tgr.table', $kelompok) }}"><i
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
                <th>Kategori</th>
                <th>Kelamin</th>
                <th>Atlet</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
