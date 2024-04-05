@extends('layouts.admin.table')

@section('title', 'Pengundian TGR')

@section('table-pengundian-tgr', 'active')

@section('formCreate')
    @include('admin.pengundian-tgr.create')
@endsection

{{-- @section('formUpload')
    @include('admin.pengundian-tgr.upload')
@endsection --}}

@section('formDeleteAll')
    @include('admin.pengundian-tgr.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengundiantgrs as $pengundiantgr)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundiantgr->TGR->nama ?? '-' }}</td>
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
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
