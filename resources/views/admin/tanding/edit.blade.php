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
                        <option selected>
                            {{ $tanding->jenis_kelamin == 'L' ? 'Putra' : 'Putri' }}</option>
                        </option>
                        <option value="L">Putra</option>
                        <option value="P">Putri</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Tinggi Badan</label>
                    <input type="number" class="form-control @error('tinggi_badan') is-invalid @enderror"
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
                    <input type="number" class="form-control @error('berat_badan') is-invalid @enderror"
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
                    <select name="kelas" id="kelas" class="form-select @error('kelas') is-invalid @enderror">
                        <option selected value="{{ $tanding->kelas }}">{{ $tanding->kelas }}</option>
                        <option value="A">Kelas A</option>
                        <option value="B">Kelas B</option>
                        <option value="C">Kelas C</option>
                        <option value="D">Kelas D</option>
                        <option value="E">Kelas E</option>
                        <option value="F">Kelas F</option>
                        <option value="G">Kelas G</option>
                        <option value="H">Kelas H</option>
                        <option value="I">Kelas I</option>
                        <option value="J">Kelas J</option>
                        <option value="K">Kelas K</option>
                        <option value="L">Kelas L</option>
                        <option value="M">Kelas M</option>
                        <option value="N">Kelas N</option>
                        <option value="O">Kelas O</option>
                        <option value="P">Kelas P</option>
                        <option value="Q">Kelas Q</option>
                        <option value="R">Kelas R</option>
                        <option value="S">Kelas S</option>
                        <option value="Open 1">Open 1</option>
                        <option value="Open 2">Open 2</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Golongan</label>
                    <select name="golongan" id="golongan" class="form-select @error('golongan') is-invalid @enderror">
                        <option selected value="{{ $tanding->golongan }}">{{ $tanding->golongan }}</option>
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
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
    </form>
</div>
