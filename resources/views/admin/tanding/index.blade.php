@extends('layouts.admin.table')

@section('title', 'Tanding')

@section('table-tanding', 'active')

@section('formCreate')
    @include('admin.tanding.create')
@endsection

@section('formUpload')
    @include('admin.tanding.upload')
@endsection

@section('formDeleteAll')
    @include('admin.tanding.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Img</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Kontingen</th>
                <th>Kelas</th>
                <th>Golongan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tandings as $tanding)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($tanding->img == null)
                            <img src="{{ asset('assets/profile/default.png') }}" alt="{{ $tanding->nama }}" width="100">
                        @else
                            <a href="#" data-toggle="modal" data-target="#myModal{{ $tanding->id }}">
                                <img class="img img-fluid rounded" src="{{ asset('assets/img/' . $tanding->img) }}"
                                    alt="{{ $tanding->img }}" width="100">
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{ $tanding->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <a href="{{ asset('assets/img/' . $tanding->img) }}">
                                                <img class="img img-fluid" src="{{ asset('assets/img/' . $tanding->img) }}"
                                                    alt="{{ $tanding->img }}">
                                            </a>
                                            <!-- Tombol Download -->
                                            <a href="{{ asset('assets/img/' . $tanding->img) }}"
                                                download="{{ $tanding->img }}" class="btn btn-success mt-2 col-12">Download
                                                Gambar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td>{{ $tanding->nama }}</td>
                    <td>{{ $tanding->jenis_kelamin == 'L' ? 'Putra' : 'Putri' }}</td>
                    <td>{{ $tanding->tinggi_badan }} cm</td>
                    <td>{{ $tanding->berat_badan }} kg</td>
                    <td>{{ $tanding->kontingen }}</td>
                    <td>{{ $tanding->kelas }}</td>
                    <td>{{ $tanding->golongan }}</td>
                    <td class="manage-row">
                        <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                            data-bs-target=".formEdit{{ $tanding->id }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade formEdit{{ $tanding->id }}" tabindex="-1" role="dialog" aria-hidden="">
                            <div class="modal-dialog" role="document">
                                @include('admin.tanding.edit')
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                        <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                            data-bs-target=".bd-example-modal-sm{{ $tanding->id }}">
                            <i class="fa fa-trash"></i>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-sm{{ $tanding->id }}" tabindex="-1" role="dialog"
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
                                        <form action="{{ route('admin.tanding.destroy', $tanding->id) }}" method="POST">
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
                <th>Img</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Kontingen</th>
                <th>Kelas</th>
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
