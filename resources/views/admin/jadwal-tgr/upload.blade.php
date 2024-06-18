<!-- Tombol untuk membuka modal -->
<a role="button" class="btn btn-success mx-1" data-toggle="modal" data-target="#modalFormUpload">Upload</a>

<!-- Modal -->
<div class="modal fade" id="modalFormUpload" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.jadwal-tgr.import') }}" enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.jadwal-tgr.import') }}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Upload Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-1">
                            <label class="form-label">Golongan</label>
                            <select name="golongan" id="golongan"
                                class="form-select @error('golongan') is-invalid @enderror" required>
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
                    <div class="col-md-12">
                        <div class="mb-1">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Putra">Putra</option>
                                <option value="Putri">Putri</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-1">
                            <label class="form-label">Kategori</label>
                            <select name="jenis" id="kategori"
                                class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Tunggal">Tunggal</option>
                                <option value="Ganda">Ganda</option>
                                <option value="Regu">Regu</option>
                                <option value="Solo Kreatif">Solo Kreatif</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-1">
                            <label class="form-label">Upload File</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                placeholder="file" name="file" id="file" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-success" href="{{ asset('assets/template/jadwal-tgr-template.xlsx') }}"
                    download="jadwal-tgr-template.xlsx">Download
                    Format</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
