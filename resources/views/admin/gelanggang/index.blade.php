@extends('layouts.admin.table')

@section('title', 'Gelanggang')

@section('table-gelanggang', 'active')

@section('topLeft')
    <h4>Kelola Data Gelanggang</h4>
@endsection

@section('formCreate')
    @include('admin.gelanggang.create')
@endsection

@section('formUpload')
    @include('admin.gelanggang.upload')
@endsection

@section('formDeleteAll')
    @include('admin.gelanggang.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gelanggangs as $gelanggang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $gelanggang->nama }}</td>
                    <td>{{ $gelanggang->waktu }} menit</td>
                    <td>{{ $gelanggang->jenis }}</td>
                    <td><a class="btn-sm btn-primary" href="#">{{ $gelanggang->JadwalTGR->count() + $gelanggang->JadwalTanding->count() }} jadwal</a>
                    </td>
                    <td class="manage-row">
                        @include('admin.gelanggang.edit')
                        @include('admin.gelanggang.delete')
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
