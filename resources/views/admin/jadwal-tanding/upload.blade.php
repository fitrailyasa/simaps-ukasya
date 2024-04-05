<!-- Tombol untuk membuka modal -->
<a role="button" class="btn btn-success mx-1" data-toggle="modal" data-target="#modalFormUpload">Upload</a>

<!-- Modal -->
<div class="modal fade" id="modalFormUpload" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.jadwal-tanding.import') }}" enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.jadwal-tanding.import') }}" enctype="multipart/form-data">
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
                            <label class="form-label">Kelompok</label>
                            <input type="text" class="form-control @error('kelompok') is-invalid @enderror"
                                placeholder="kelompok" name="kelompok" id="kelompok" required>
                            @error('kelompok')
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
                <a class="btn btn-success" href="{{ asset('assets/template/jadwal-tanding-template.xlsx') }}"
                    download="jadwal-tanding-template.xlsx">Download
                    Format</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
