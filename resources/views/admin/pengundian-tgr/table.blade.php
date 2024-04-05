@extends('layouts.admin.table')

@section('title', 'Peserta TGR')

@section('table-pengundian-tgr', 'active')

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Golongan</th>
                <th>Kategori</th>
                <th>Kelamin</th>
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengundiantgrs as $pengundiantgr)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundiantgr->tgr->nama ?? '-' }}</td>
                    <td>{{ $pengundiantgr->tgr->golongan ?? '-' }}</td>
                    <td>{{ $pengundiantgr->tgr->kategori ?? '-' }}</td>
                    <td>{{ $pengundiantgr->tgr->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $pengundiantgr->no_undian ?? '-' }}</td>
                    <td class="manage-row">
                        @include('admin.pengundian-tgr.edit')
                        @include('admin.pengundian-tgr.delete')
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Golongan</th>
                <th>Kategori</th>
                <th>Kelamin</th>
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
