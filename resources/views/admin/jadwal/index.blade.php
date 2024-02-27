@extends('layouts.admin.table')

@section('title', 'Jadwal')

@section('table-jadwal', 'active')

@section('formCreate')
    @include('admin.jadwal.create')
@endsection

@section('formUpload')
    @include('admin.jadwal.upload')
@endsection

@section('formDeleteAll')
    @include('admin.jadwal.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Partai</th>
                {{-- <th>Tanggal</th> --}}
                <th>Gelanggang</th>
                <th>Babak</th>
                <th>Kelompok</th>
                <th>Sudut Biru</th>
                <th>Sudut Merah</th>
                <th>Status</th>
                <th>Pemenang</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwals as $jadwal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwal->partai }}</td>
                    {{-- <td>{{ $jadwal->tanggal }}</td> --}}
                    <td>{{ $jadwal->gelanggang }}</td>
                    <td>{{ $jadwal->babak }}</td>
                    <td>{{ $jadwal->kelompok }}</td>
                    <td class="bg-primary">{{ $jadwal->pemain_biru }} - {{ $jadwal->partai_biru }}</td>
                    <td class="bg-danger">{{ $jadwal->pemain_merah }} - {{ $jadwal->partai_merah }}</td>
                    <td>{{ $jadwal->status }}</td>
                    <td>{{ $jadwal->pemenang }}</td>
                    <td>{{ $jadwal->aktif }}</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-sm{{ $jadwal->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm{{ $jadwal->id }}" tabindex="-1" role="dialog"
                                aria-hidden="">
                                <div class="modal-dialog" role="document">
                                    @include('admin.jadwal.edit')
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target=".formEdit{{ $jadwal->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade formEdit{{ $jadwal->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST">
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
                <th>Partai</th>
                {{-- <th>Tanggal</th> --}}
                <th>Gelanggang</th>
                <th>Babak</th>
                <th>Kelompok</th>
                <th>Sudut Biru</th>
                <th>Sudut Merah</th>
                <th>Status</th>
                <th>Pemenang</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
