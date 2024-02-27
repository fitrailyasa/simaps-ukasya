    <div class="modal-content">
        @if (auth()->user()->roles_id == 1)
            <form method="POST" action="{{ route('admin.pengundian.import') }}" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="modalFormLabel">Upload Pengundian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <a class="btn btn-success" href="{{ asset('assets/template/pengundian-template.xlsx') }}"
                download="pengundian-template.xlsx">Download Format</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
