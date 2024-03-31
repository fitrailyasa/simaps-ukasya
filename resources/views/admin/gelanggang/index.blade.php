@extends('layouts.admin.table')

@section('title', 'Gelanggang')

@section('table-gelanggang', 'active')

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
                <th>jumlah</th>
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
                    <td><a class="btn-sm btn-primary" href="#">0 jadwal</a>
                    </td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-sm{{ $gelanggang->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm{{ $gelanggang->id }}" tabindex="-1" role="dialog"
                                aria-hidden="">
                                <div class="modal-dialog" role="document">
                                    @include('admin.gelanggang.edit')
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target=".formEdit{{ $gelanggang->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade formEdit{{ $gelanggang->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('admin.gelanggang.destroy', $gelanggang->id) }}"
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
                <th>Waktu</th>
                <th>Jenis</th>
                <th>jumlah</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
