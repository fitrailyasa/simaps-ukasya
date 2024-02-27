<div class="modal-content">
    @if (auth()->user()->roles_id == 1)
        <form method="POST" action="{{ route('admin.pengundian.update', $pengundian->id) }}"
            enctype="multipart/form-data">
    @endif
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="modalFormLabel">Edit Pengundian
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="nama"
                        name="nama" id="nama" value="{{ $pengundian->nama }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Golongan</label>
                    <input type="text" class="form-control @error('golongan') is-invalid @enderror"
                        placeholder="golongan" name="golongan" id="golongan" value="{{ $pengundian->golongan }}"
                        required>
                    @error('golongan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Kelas Kategori</label>
                    <input type="text" class="form-control @error('kelas_kategori') is-invalid @enderror"
                        placeholder="kelas_kategori" name="kelas_kategori" id="kelas_kategori"
                        value="{{ $pengundian->kelas_kategori }}" required>
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
                        <option value="{{ $pengundian->jenis_kelamin }}">{{ $pengundian->jenis_kelamin }}</option>
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
                        placeholder="kontingen" name="kontingen" id="kontingen" value="{{ $pengundian->kontingen }}"
                        required>
                    @error('kontingen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">No Undian</label>
                    <input type="text" class="form-control @error('no_undian') is-invalid @enderror"
                        placeholder="no_undian" name="no_undian" id="no_undian" value="{{ $pengundian->no_undian }}"
                        required>
                    @error('no_undian')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    </form>
</div>
