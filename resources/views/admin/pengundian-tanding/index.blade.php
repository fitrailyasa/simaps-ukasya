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
                        <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-sm{{ $pengundiantanding->id }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-sm{{ $pengundiantanding->id }}" tabindex="-1" role="dialog"
                            aria-hidden="">
                            <div class="modal-dialog" role="document">
                                @include('admin.pengundian-tanding.edit')
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                        <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                            data-bs-target=".formEdit{{ $pengundiantanding->id }}">
                            <i class="fa fa-trash"></i>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade formEdit{{ $pengundiantanding->id }}" tabindex="-1" role="dialog"
                            aria-hidden="">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><strong>Hapus @yield('title')</strong>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">Apakah anda yakin ingin menghapus
                                        @yield('title')?</div>
                                    <div class="modal-footer">
                                        <form
                                            action="{{ route('admin.pengundian-tanding.destroy', $pengundiantanding->id) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-danger light" name="" id=""
                                                value="Hapus">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Tidak</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
