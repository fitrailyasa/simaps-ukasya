@extends('layouts.admin.table')

@section('title', 'Pengundian')

@section('table-pengundian', 'active')

@section('formCreate')
    @include('admin.pengundian.create')
@endsection

@section('formUpload')
    @include('admin.pengundian.upload')
@endsection

@section('formDeleteAll')
    @include('admin.pengundian.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Golongan</th>   
                <th>Kelas/Kategori</th>
                <th>Jenis Kelamin</th>
                <th>Kontingen</th>
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengundians as $pengundian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundian->nama }}</td>
                    <td>{{ $pengundian->golongan }}</td>
                    <td>{{ $pengundian->kelas_kategori }}</td>
                    <td>{{ $pengundian->jenis_kelamin }}</td>
                    <td>{{ $pengundian->kontingen }}</td>
                    <td>{{ $pengundian->no_undian }}</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a role="button" class="btn-sm btn-success mr-2" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-sm{{ $pengundian->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm{{ $pengundian->id }}" tabindex="-1" role="dialog"
                                aria-hidden="">
                                <div class="modal-dialog" role="document">
                                    @include('admin.pengundian.edit')
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target=".formEdit{{ $pengundian->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade formEdit{{ $pengundian->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('admin.pengundian.destroy', $pengundian->id) }}"
                                                method="POST">
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
                <th>Golongan</th>
                <th>Kelas/Kategori</th>
                <th>Jenis Kelamin</th>
                <th>Kontingen</th>
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
