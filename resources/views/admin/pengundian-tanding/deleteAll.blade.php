<!-- Tombol untuk membuka modal -->
<a role="button" class="btn btn-danger mx-1" data-toggle="modal" data-target="#modalFormDeleteAll">Hapus
    Semua</a>

<!-- Modal -->
<div class="modal fade" id="modalFormDeleteAll" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.pengundian-tanding.destroy-all') }}"
                    enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.pengundian-tanding.destroy-all') }}"
                        enctype="multipart/form-data">
            @endif
            @csrf
            @method('delete')
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Hapus Semua Data Atlet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus semua data?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Hapus Semua</button>
            </div>
            </form>
        </div>
    </div>
</div>
