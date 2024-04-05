<!-- Tombol untuk membuka modal -->
<a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
    data-bs-target=".bd-example-modal-sm{{ $pengundiantanding->id }}">
    <i class="fa fa-edit"></i>
</a>
<!-- Modal -->
<div class="modal fade bd-example-modal-sm{{ $pengundiantanding->id }}" tabindex="-1" role="dialog" aria-hidden="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.pengundian-tanding.update', $pengundiantanding->id) }}"
                    enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.pengundian-tanding.update', $pengundiantanding->id) }}"
                        enctype="multipart/form-data">
            @endif
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Edit Pengundian Tanding
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Atlet</label>
                            <select class="form-select @error('atlet_id') is-invalid @enderror" name="atlet_id"
                                id="atlet_id" value="{{ $pengundiantanding->atlet_id }}" disabled>
                                <option selected disabled>{{ $pengundiantanding->Tanding->nama ?? 'Pilih Atlet' }}
                                </option>
                                @foreach ($tandings as $tanding)
                                    <option value="{{ $tanding->id }}">{{ $tanding->nama }}</option>
                                @endforeach
                            </select>
                            @error('atlet_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">No Undian</label>
                            <input type="number" class="form-control @error('no_undian') is-invalid @enderror"
                                placeholder="no_undian" name="no_undian" id="no_undian"
                                value="{{ $pengundiantanding->no_undian ?? 0 }}" required>
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
    </div>
</div>
