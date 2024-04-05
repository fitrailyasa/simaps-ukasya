@extends('layouts.admin.table')

@section('title', 'Peserta Tanding')

@section('table-pengundian-tanding', 'active')

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Golongan</th>
                <th>Kelas</th>
                <th>Kelamin</th>
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengundiantandings as $pengundiantanding)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundiantanding->Tanding->nama ?? '-' }}</td>
                    <td>{{ $pengundiantanding->Tanding->golongan ?? '-' }}</td>
                    <td>{{ $pengundiantanding->Tanding->kelas ?? '-' }}</td>
                    <td>{{ $pengundiantanding->Tanding->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $pengundiantanding->no_undian ?? '-' }}</td>
                    <td class="manage-row">
                        @include('admin.pengundian-tanding.edit')
                        @include('admin.pengundian-tanding.delete')
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Golongan</th>
                <th>Kelas</th>
                <th>Kelamin</th>
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
