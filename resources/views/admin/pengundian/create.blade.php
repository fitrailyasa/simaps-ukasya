    <div class="modal-content">
        @if (auth()->user()->roles_id == 1)
            <form method="POST" action="{{ route('admin.pengundian.store') }}" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="modalFormLabel">Tambah Pengundian</h5>
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
                        <label class="form-label">Golongan</label>
                        <select name="golongan" id="golongan"
                            class="form-select @error('golongan') is-invalid @enderror">
                            <option value="Usia Dini 1">Usia Dini 1</option>
                            <option value="Usia Dini 2">Usia Dini 2</option>
                            <option value="Pra Remaja">Pra Remaja</option>
                            <option value="Remaja">Remaja</option>
                            <option value="Dewasa">Dewasa</option>
                            <option value="Master">Master</option>
                        </select>
                        @error('golongan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Kelas Kategori</label>
                        <input type="text" class="form-control @error('kelas_kategori') is-invalid @enderror"
                            placeholder="kelas_kategori" name="kelas_kategori" id="kelas_kategori" required>
                        @error('kelas_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Kontingen</label>
                        <input type="text" class="form-control @error('kontingen') is-invalid @enderror"
                            placeholder="kontingen" name="kontingen" id="kontingen" required>
                        @error('kontingen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">No Undian</label>
                        <input type="text" class="form-control @error('no_undian') is-invalid @enderror"
                            placeholder="no_undian" name="no_undian" id="no_undian" required>
                        @error('no_undian')
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
