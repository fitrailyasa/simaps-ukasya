@extends('layouts.admin.table')

@section('title', 'Pengundian Tanding')

@section('table-pengundian-tanding', 'active')

@section('formCreate')
    @include('admin.pengundian-tanding.create')
@endsection

{{-- @section('formUpload')
    @include('admin.pengundian-tanding.upload')
@endsection --}}

@section('formDeleteAll')
    @include('admin.pengundian-tanding.deleteAll')
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
            @foreach ($pengundiantandings as $pengundiantanding)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundiantanding->Tanding->nama ?? '-' }}</td>
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
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
