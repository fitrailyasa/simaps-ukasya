@extends('layouts.admin.table')

@section('title', 'Tanding')

@section('table-tanding', 'active')

@section('topLeft')
    <h4>Kelola Data Tabel Tanding</h4>
@endsection

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
                        @include('admin.tanding.edit')
                        @include('admin.tanding.delete')
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
