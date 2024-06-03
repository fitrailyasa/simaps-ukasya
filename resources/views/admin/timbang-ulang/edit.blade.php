<!-- Tombol untuk membuka modal -->
<a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
    data-bs-target=".bd-example-modal-sm{{ $timbangulang->id }}">
    <i class="fa fa-edit"></i>
</a>
<!-- Modal -->
<div class="modal fade bd-example-modal-sm{{ $timbangulang->id }}" tabindex="-1" role="dialog" aria-hidden="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.timbang-ulang.update', $timbangulang->id) }}"
                    enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.timbang-ulang.update', $timbangulang->id) }}"
                        enctype="multipart/form-data">
            @endif
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Edit Timbang Ulang Partai
                    Ke-{{ $timbangulang->partai ?? '-' }}
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Partai</label>
                            <input type="hidden" name="sudut_biru"
                                value="{{ $timbangulang->PengundianTandingBiru->Tanding->id ?? '-' }}">
                            <input type="text" class="form-control bg-primary" readonly
                                value="{{ $timbangulang->PengundianTandingBiru->Tanding->kontingen ?? '-' }}">
                            <input type="text" class="form-control bg-primary" readonly
                                value="{{ $timbangulang->PengundianTandingBiru->Tanding->nama ?? '-' }}">
                        </div>
                    </div>
                    <div class="col-md-2 text-center align-self-center fw-bold">VS</div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Partai</label>
                            <input type="hidden" name="sudut_merah"
                                value="{{ $timbangulang->PengundianTandingMerah->Tanding->id ?? '-' }}">
                            <input type="text" class="form-control bg-danger" readonly
                                value="{{ $timbangulang->PengundianTandingMerah->Tanding->kontingen ?? '-' }}">
                            <input type="text" class="form-control bg-danger" readonly
                                value="{{ $timbangulang->PengundianTandingMerah->Tanding->nama ?? '-' }}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Hasil Timbang</label>
                            <input type="number" class="form-control" placeholder="60" name="berat_biru" required
                                value="{{ $timbangulang->berat_biru }}">
                        </div>
                    </div>
                    <div class="col-md-2 text-center align-self-center fw-bold">VS</div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Hasil Timbang</label>
                            <input type="number" class="form-control" placeholder="60" name="berat_merah" required
                                value="{{ $timbangulang->berat_merah }}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Keputusan</label>
                            <select name="status_biru" id="status_biru" class="form-select" required>
                                <option value="">-- Pilih Keputusan --</option>
                                <option value="SAH" {{ $timbangulang->status_biru == 'SAH' ? 'selected' : '' }}>SAH
                                </option>
                                <option value="TIDAK SAH"
                                    {{ $timbangulang->status_biru == 'TIDAK SAH' ? 'selected' : '' }}>TIDAK SAH
                                </option>
                                <option value="UNDUR DIRI"
                                    {{ $timbangulang->status_biru == 'UNDUR DIRI' ? 'selected' : '' }}>UNDUR DIRI
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 text-center align-self-center fw-bold">VS</div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Keputusan</label>
                            <select name="status_merah" id="status_merah" class="form-select" required>
                                <option value="">-- Pilih Keputusan --</option>
                                <option value="SAH" {{ $timbangulang->status_merah == 'SAH' ? 'selected' : '' }}>
                                    SAH</option>
                                <option value="TIDAK SAH"
                                    {{ $timbangulang->status_merah == 'TIDAK SAH' ? 'selected' : '' }}>TIDAK SAH
                                </option>
                                <option value="UNDUR DIRI"
                                    {{ $timbangulang->status_merah == 'UNDUR DIRI' ? 'selected' : '' }}>UNDUR DIRI
                                </option>
                            </select>
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
