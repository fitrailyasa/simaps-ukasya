@extends('layouts.admin.table')

@section('title', 'Pengundian TGR')

@section('table-pengundianTGR', 'active')

@section('formCreate')
    @include('admin.pengundianTGR.create')
@endsection

@section('formUpload')
    @include('admin.pengundianTGR.upload')
@endsection

@section('formDeleteAll')
    @include('admin.pengundianTGR.deleteAll')
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
            @foreach ($pengundianTGRs as $pengundianTGR)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pengundianTGR->nama }}</td>
                    <td>{{ $pengundianTGR->no_undian }}</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-sm{{ $pengundianTGR->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm{{ $pengundianTGR->id }}" tabindex="-1" role="dialog"
                                aria-hidden="">
                                <div class="modal-dialog" role="document">
                                    @include('admin.pengundianTGR.edit')
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target=".formEdit{{ $pengundianTGR->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade formEdit{{ $pengundianTGR->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('admin.pengundianTGR.destroy', $pengundianTGR->id) }}"
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
                <th>No. Undian</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
