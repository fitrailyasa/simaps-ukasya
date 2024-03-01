    <div class="modal-content">
        @if (auth()->user()->roles_id == 1)
            <form method="POST" action="{{ route('admin.jadwal-tanding.store') }}" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="modalFormLabel">Tambah Jadwal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Partai</label>
                        <input type="text" class="form-control @error('partai') is-invalid @enderror"
                            placeholder="partai" name="partai" id="partai" required>
                        @error('partai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                            placeholder="tanggal" name="tanggal" id="tanggal" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Gelanggang</label>
                        <input type="text" class="form-control @error('gelanggang') is-invalid @enderror"
                            placeholder="gelanggang" name="gelanggang" id="gelanggang" required>
                        @error('gelanggang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Babak</label>
                        <input type="text" class="form-control @error('babak') is-invalid @enderror"
                            placeholder="babak" name="babak" id="babak" required>
                        @error('babak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Kelompok</label>
                        <input type="text" class="form-control @error('kelompok') is-invalid @enderror"
                            placeholder="kelompok" name="kelompok" id="kelompok" required>
                        @error('kelompok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Pemain Biru</label>
                        <input type="text" class="form-control @error('pemain_biru') is-invalid @enderror"
                            placeholder="pemain_biru" name="pemain_biru" id="pemain_biru" required>
                        @error('pemain_biru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Partai Biru</label>
                        <input type="text" class="form-control @error('partai_biru') is-invalid @enderror"
                            placeholder="partai_biru" name="partai_biru" id="partai_biru" required>
                        @error('partai_biru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Pemain Merah</label>
                        <input type="text" class="form-control @error('pemain_merah') is-invalid @enderror"
                            placeholder="pemain_merah" name="pemain_merah" id="pemain_merah" required>
                        @error('pemain_merah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Partai Merah</label>
                        <input type="text" class="form-control @error('partai_merah') is-invalid @enderror"
                            placeholder="partai_merah" name="partai_merah" id="partai_merah" required>
                        @error('partai_merah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control @error('status') is-invalid @enderror"
                            placeholder="status" name="status" id="status" required>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Pemenang</label>
                        <input type="text" class="form-control @error('pemenang') is-invalid @enderror"
                            placeholder="pemenang" name="pemenang" id="pemenang" required>
                        @error('pemenang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Aktif</label>
                        <input type="text" class="form-control @error('aktif') is-invalid @enderror"
                            placeholder="aktif" name="aktif" id="aktif" required>
                        @error('aktif')
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
