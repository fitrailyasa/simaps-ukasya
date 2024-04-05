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
                <th>Golongan</th>
                <th>Kelas</th>
                <th>Kelamin</th>
                <th>Atlet</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengundiantandings as $pengundiantanding)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundiantanding->Tanding->golongan ?? '-' }}</td>
                    <td>{{ $pengundiantanding->Tanding->kelas ?? '-' }}</td>
                    <td>{{ $pengundiantanding->Tanding->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $pengundiantanding->Tanding->count() ?? '-' }} Atlet</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a class="btn-sm btn-primary" href="{{ route('admin.pengundian-tanding.table') }}"><i
                                    class="fas fa-eye"></i></a>
                        @elseif (auth()->user()->roles_id == 2)
                            <a class="btn-sm btn-primary" href="{{ route('op.pengundian-tanding.table') }}"><i
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
                <th>Kelas</th>
                <th>Kelamin</th>
                <th>Atlet</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
