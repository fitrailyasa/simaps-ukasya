    <div class="modal-content">
        @if (auth()->user()->roles_id == 1)
            <form method="POST" action="{{ route('admin.gelanggang.store') }}" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="modalFormLabel">Tambah Gelanggang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="nama" name="nama" id="nama" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Waktu</label>
                        <input type="number" class="form-control @error('waktu') is-invalid @enderror"
                            placeholder="waktu" name="waktu" id="waktu" required>
                        @error('waktu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Audio</label>
                        <input type="file" class="form-control @error('audio') is-invalid @enderror"
                            placeholder="audio" name="audio" id="audio" enabled>
                        @error('audio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Jenis</label>
                        <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                            placeholder="jenis" name="jenis" id="jenis" required>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                            placeholder="jumlah" name="jumlah" id="jumlah" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
