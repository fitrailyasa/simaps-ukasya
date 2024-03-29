@extends('layouts.admin.table')

@section('title', 'Jadwal TGR')

@section('table-jadwal-tgr', 'active')

@section('formCreate')
    @include('admin.jadwal-tgr.create')
@endsection

@section('formUpload')
    @include('admin.jadwal-tgr.upload')
@endsection

@section('formDeleteAll')
    @include('admin.jadwal-tgr.deleteAll')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Partai</th>
                <th>Gelanggang</th>
                <th>Babak</th>
                <th>Kelompok</th>
                <th>Sudut Biru</th>
                <th>Sudut Merah</th>
                <th>Pemenang</th>
                <th>Skor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwaltgrs as $jadwaltgr)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $jadwaltgr->partai ?? '-' }}</td>
                    <td>{{ $jadwaltgr->Gelanggang->nama ?? '-' }}</td>
                    <td>{{ $jadwaltgr->babak ?? '-' }}</td>
                    <td>{{ $jadwaltgr->kelompok ?? '-' }}</td>
                    <td class="bg-primary">{{ $jadwaltgr->PengundianTGRBiru->TGR->nama ?? '-' }}
                        ({{ $jadwaltgr->PengundianTGRBiru->TGR->kontingen ?? '-' }})</td>
                    <td class="bg-danger">{{ $jadwaltgr->PengundianTGRMerah->TGR->nama ?? '-' }}
                        ({{ $jadwaltgr->PengundianTGRMerah->TGR->kontingen ?? '-' }})</td>
                    <td>{{ $jadwaltgr->PemenangTGR->TGR->nama ?? '' }}
                        ({{ $jadwaltgr->PemenangTGR->TGR->kontingen ?? 'Belum Bertanding' }})
                    </td>
                    <td>{{ $jadwaltgr->skor_biru ?? '0' }} - {{ $jadwaltgr->skor_merah ?? '0' }}</td>
                    <td class="manage-row">
                        @if (auth()->user()->roles_id == 1)
                            <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-sm{{ $jadwaltgr->id }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm{{ $jadwaltgr->id }}" tabindex="-1" role="dialog"
                                aria-hidden="">
                                <div class="modal-dialog" role="document">
                                    @include('admin.jadwal-tgr.edit')
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target=".formEdit{{ $jadwaltgr->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade formEdit{{ $jadwaltgr->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('admin.jadwal-tgr.destroy', $jadwaltgr->id) }}"
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
                <th>Partai</th>
                <th>Gelanggang</th>
                <th>Babak</th>
                <th>Kelompok</th>
                <th>Sudut Biru</th>
                <th>Sudut Merah</th>
                <th>Pemenang</th>
                <th>Skor</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
