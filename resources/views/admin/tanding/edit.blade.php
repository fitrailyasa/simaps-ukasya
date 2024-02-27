<div class="modal-content">
    @if (auth()->user()->roles_id == 1)
        <form method="POST" action="{{ route('admin.tanding.update', $tanding->id) }}" enctype="multipart/form-data">
    @endif
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="modalFormLabel">Edit Atlet
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-2">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="nama"
                        name="nama" id="nama" value="{{ $tanding->nama }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                        <option value="{{ $tanding->jenis_kelamin }}">{{ $tanding->jenis_kelamin }}</option>
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
                    <label class="form-label">Tinggi Badan</label>
                    <input type="text" class="form-control @error('tinggi_badan') is-invalid @enderror"
                        placeholder="tinggi_badan" name="tinggi_badan" id="tinggi_badan"
                        value="{{ $tanding->tinggi_badan }}" required>
                    @error('tinggi_badan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Berat Badan</label>
                    <input type="text" class="form-control @error('berat_badan') is-invalid @enderror"
                        placeholder="berat_badan" name="berat_badan" id="berat_badan"
                        value="{{ $tanding->berat_badan }}" required>
                    @error('berat_badan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Kontingen</label>
                    <input type="text" class="form-control @error('kontingen') is-invalid @enderror"
                        placeholder="kontingen" name="kontingen" id="kontingen" value="{{ $tanding->kontingen }}"
                        required>
                    @error('kontingen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Kelas</label>
                    <input type="text" class="form-control @error('kelas') is-invalid @enderror" placeholder="kelas"
                        name="kelas" id="kelas" value="{{ $tanding->kelas }}" required>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Golongan</label>
                    <input type="text" class="form-control @error('golongan') is-invalid @enderror"
                        placeholder="golongan" name="golongan" id="golongan" value="{{ $tanding->golongan }}"
                        required>
                    @error('golongan')
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
