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
                <th>Img</th>
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
                    <td>
                        @if ($tgr->img == null)
                            <img src="{{ asset('assets/profile/default.png') }}" alt="{{ $tgr->nama }}" width="100">
                        @else
                            <a href="#" data-toggle="modal" data-target="#myModal{{ $tgr->id }}">
                                <img class="img img-fluid rounded" src="{{ asset('assets/img/' . $tgr->img) }}"
                                    alt="{{ $tgr->img }}" width="100">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{ $tgr->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <a href="{{ asset('assets/img/' . $tgr->img) }}">
                                                <img class="img img-fluid" src="{{ asset('assets/img/' . $tgr->img) }}"
                                                    alt="{{ $tgr->img }}">
                                            </a>
                                            <!-- Tombol Download -->
                                            <a href="{{ asset('assets/img/' . $tgr->img) }}"
                                                download="{{ $tgr->img }}" class="btn btn-success mt-2 col-12">Download
                                                Gambar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
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
                <th>Foto</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kontingen</th>
                <th>Kategori</th>
                <th>Golongan</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
    <script>
        function previewImage() {
            var input = document.getElementById('image-input');
            var preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '{{ asset('assets/profile/default.png') }}';
            }
        }

        document.getElementById('image-input').addEventListener('change', previewImage);
        window.addEventListener('load', previewImage);
    </script>
@endsection
