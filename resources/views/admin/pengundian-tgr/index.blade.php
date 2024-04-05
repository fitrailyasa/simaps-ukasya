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
            @foreach ($pengundiantgrs as $pengundiantgr)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundiantgr->tgr->golongan ?? '-' }}</td>
                    <td>{{ $pengundiantgr->tgr->kategori ?? '-' }}</td>
                    <td>{{ $pengundiantgr->tgr->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $pengundiantgr->tgr->count() ?? '-' }} Atlet</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a class="btn-sm btn-primary" href="{{ route('admin.pengundian-tgr.table') }}"><i
                                    class="fas fa-eye"></i></a>
                        @elseif (auth()->user()->roles_id == 2)
                            <a class="btn-sm btn-primary" href="{{ route('op.pengundian-tgr.table') }}"><i
                                    class="fas fa-eye"></i></a>
                        @endif
                    </td>
                </tr>
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
