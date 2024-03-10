<div class="modal-content">
    @if (auth()->user()->roles_id == 1)
        <form method="POST" action="{{ route('admin.gelanggang.update', $gelanggang->id) }}"
            enctype="multipart/form-data">
    @endif
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="modalFormLabel">Edit Gelanggang
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
                        name="nama" id="nama" value="{{ $gelanggang->nama ?? '-' }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Waktu</label>
                    <input type="number" class="form-control @error('waktu') is-invalid @enderror" placeholder="waktu"
                        name="waktu" id="waktu" value="{{ $gelanggang->waktu ?? 0 }}" required>
                    @error('waktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Jenis</label>
                    <select name="jenis" id="jenis" class="form-select @error('jenis') is-invalid @enderror">
                        <option selected value="{{ $gelanggang->jenis }}">{{ $gelanggang->jenis ?? 'Pilih Jenis' }}
                        </option>
                        <option value="Tanding">Tanding</option>
                        <option value="Tunggal">Tunggal</option>
                        <option value="Ganda">Ganda</option>
                        <option value="Regu">Regu</option>
                        <option value="Solo Kreatif">Solo Kreatif</option>
                    </select>
                    @error('jenis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Jumlah Jadwal Tanding</label>
                    <input type="number" class="form-control @error('jumlah_tanding') is-invalid @enderror"
                        placeholder="jumlah_tanding" name="jumlah_tanding" id="jumlah_tanding"
                        value="{{ $gelanggang->jumlah_tanding ?? 0 }}" required>
                    @error('jumlah_tanding')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label">Jumlah Jadwal TGR</label>
                    <input type="number" class="form-control @error('jumlah_tgr') is-invalid @enderror"
                        placeholder="jumlah_tgr" name="jumlah_tgr" id="jumlah_tgr"
                        value="{{ $gelanggang->jumlah_tgr ?? 0 }}" required>
                    @error('jumlah_tgr')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-2">
                    <label class="form-label">Audio</label>
                    <p>{{ $gelanggang->audio }} : <audio class="form-control" src="{{ asset($gelanggang->audio) }}"
                            controls></audio></p>
                    <input type="file" class="form-control @error('audio') is-invalid @enderror" placeholder="audio"
                        name="audio" id="audio" value="{{ $gelanggang->audio ?? '-' }}" enabled>
                    @error('audio')
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
</div>
</div>
