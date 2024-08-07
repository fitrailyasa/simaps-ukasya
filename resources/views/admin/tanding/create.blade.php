<!-- Tombol untuk membuka modal -->
<a role="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#modalFormCreate">Tambah</a>

<!-- Modal -->
<div class="modal fade" id="modalFormCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.tanding.store') }}" enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.tanding.store') }}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Tambah Atlet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="nama" name="nama" id="nama" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label class="form-label">Images</label>
                            <input id="image-input" accept="image/*" type="file"
                                class="form-control @error('img') is-invalid @enderror" placeholder="img" name="img"
                                id="img">
                            <img class="img-fluid py-3" id="image-preview" width="100"
                                src="{{ asset('assets/profile/default.webp') }}" alt="Image Preview">
                            @error('img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Putra">Putra</option>
                                <option value="Putri">Putri</option>
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
                                placeholder="tinggi_badan" name="tinggi_badan" id="tinggi_badan" required>
                            @error('tinggi_badan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Berat Badan</label>
                            <input type="number" class="form-control @error('berat_badan') is-invalid @enderror"
                                placeholder="berat_badan" name="berat_badan" id="berat_badan" required>
                            @error('berat_badan')
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
                            <label class="form-label">Kelas</label>
                            <select name="kelas" id="kelas"
                                class="form-select @error('kelas') is-invalid @enderror">
                                <option value="">-- Pilih Kelas Tanding --</option>
                                <option value="Kelas A">Kelas A</option>
                                <option value="Kelas B">Kelas B</option>
                                <option value="Kelas C">Kelas C</option>
                                <option value="Kelas D">Kelas D</option>
                                <option value="Kelas E">Kelas E</option>
                                <option value="Kelas F">Kelas F</option>
                                <option value="Kelas G">Kelas G</option>
                                <option value="Kelas H">Kelas H</option>
                                <option value="Kelas I">Kelas I</option>
                                <option value="Kelas J">Kelas J</option>
                                <option value="Kelas K">Kelas K</option>
                                <option value="Kelas L">Kelas L</option>
                                <option value="Kelas M">Kelas M</option>
                                <option value="Kelas N">Kelas N</option>
                                <option value="Kelas O">Kelas O</option>
                                <option value="Kelas P">Kelas P</option>
                                <option value="Kelas Q">Kelas Q</option>
                                <option value="Kelas R">Kelas R</option>
                                <option value="Kelas S">Kelas S</option>
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
                            <select name="golongan" id="golongan"
                                class="form-select @error('golongan') is-invalid @enderror">
                                <option value="">-- Pilih Golongan --</option>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
