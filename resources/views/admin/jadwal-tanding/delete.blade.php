<!-- Tombol untuk membuka modal -->
<a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
    data-bs-target=".formEdit{{ $jadwaltanding->id }}">
    <i class="fa fa-trash"></i>
</a>
<!-- Modal -->
<div class="modal fade formEdit{{ $jadwaltanding->id }}" tabindex="-1" role="dialog" aria-hidden="">
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
                @if (auth()->user()->roles_id == 1)
                    <form method="POST" action="{{ route('admin.jadwal-tanding.destroy', $jadwaltanding->id) }}"
                        enctype="multipart/form-data">
                    @elseif (auth()->user()->roles_id == 2)
                        <form method="POST" action="{{ route('op.jadwal-tanding.destroy', $jadwaltanding->id) }}"
                            enctype="multipart/form-data">
                @endif
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger light" name="" id="" value="Hapus">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                </form>
            </div>
        </div>
    </div>
</div>
