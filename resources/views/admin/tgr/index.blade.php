@extends('layouts.admin.table')

@section('title', 'TGR')

@section('table-tgr', 'active')

@section('formCreate')
    @include('admin.tgr.create')
@endsection

@section('formUpload')
    @include('admin.tgr.upload')
@endsection

@section('formDeleteAll')
    @include('admin.tgr.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kontingen</th>
                <th>Kategori</th>
                <th>Golongan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tgrs as $tgr)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tgr->nama }}</td>
                    <td>{{ $tgr->jenis_kelamin == 'L' ? 'Putra' : 'Putri' }}</td>
                    <td>{{ $tgr->kontingen }}</td>
                    <td>{{ $tgr->kategori }}</td>
                    <td>{{ $tgr->golongan }}</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-sm{{ $tgr->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm{{ $tgr->id }}" tabindex="-1" role="dialog"
                                aria-hidden="">
                                <div class="modal-dialog" role="document">
                                    @include('admin.tgr.edit')
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target=".formEdit{{ $tgr->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade formEdit{{ $tgr->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('admin.tgr.destroy', $tgr->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" class="btn btn-danger light" name=""
                                                    id="" value="Hapus">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Tidak</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kontingen</th>
                <th>Kategori</th>
                <th>Golongan</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
