<!-- Tombol untuk membuka modal -->
<a role="button" class="btn-sm btn-primary mr-2" data-bs-toggle="modal" data-bs-target=".create{{ $jadwaltanding->id }}">
    <i class="fa fa-edit"></i>
</a>
<!-- Modal -->
<div class="modal fade create{{ $jadwaltanding->id }}" tabindex="-1" role="dialog" aria-hidden="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.timbang-ulang.store') }}" enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.timbang-ulang.store') }}" enctype="multipart/form-data">
            @endif
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Timbang Ulang Partai Ke-{{ $jadwaltanding->partai ?? '-' }}
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <input type="hidden" name="partai" value="{{ $jadwaltanding->partai }}">
                        <input type="hidden" name="gelanggang" value="{{ $jadwaltanding->Gelanggang->id }}">
                        <input type="hidden" name="babak" value="{{ $jadwaltanding->babak }}">
                        <input type="hidden" name="pemenang"
                            value="{{ $jadwaltanding->PemenangTanding->Tanding->id }}">
                        <input type="hidden" name="kelas"
                            value="{{ $jadwaltanding->PengundianTandingBiru->Tanding->kelas }}">
                        <div class="mb-2">
                            <label class="form-label">Partai</label>
                            <input type="hidden" name="sudut_biru"
                                value="{{ $jadwaltanding->PengundianTandingBiru->Tanding->id ?? '-' }}">
                            <input type="text" class="form-control bg-primary" readonly
                                value="{{ $jadwaltanding->PengundianTandingBiru->Tanding->kontingen ?? '-' }}">
                            <input type="text" class="form-control bg-primary" readonly
                                value="{{ $jadwaltanding->PengundianTandingBiru->Tanding->nama ?? '-' }}">
                        </div>
                    </div>
                    <div class="col-md-2 text-center align-self-center fw-bold">VS</div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Partai</label>
                            <input type="hidden" name="sudut_merah"
                                value="{{ $jadwaltanding->PengundianTandingMerah->Tanding->id ?? '-' }}">
                            <input type="text" class="form-control bg-danger" readonly
                                value="{{ $jadwaltanding->PengundianTandingMerah->Tanding->kontingen ?? '-' }}">
                            <input type="text" class="form-control bg-danger" readonly
                                value="{{ $jadwaltanding->PengundianTandingMerah->Tanding->nama ?? '-' }}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Hasil Timbang</label>
                            <input type="number" class="form-control" placeholder="60" name="berat_biru" required
                                value="{{ $jadwaltanding->PengundianTandingBiru->Tanding->berat_badan ?? '-' }}">
                        </div>
                    </div>
                    <div class="col-md-2 text-center align-self-center fw-bold">VS</div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Hasil Timbang</label>
                            <input type="number" class="form-control" placeholder="60" name="berat_merah" required
                                value="{{ $jadwaltanding->PengundianTandingMerah->Tanding->berat_badan ?? '-' }}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Keputusan</label>
                            <select name="status_biru" id="status_biru" class="form-select" required>
                                <option selected readonly>-- Pilih Keputusan --</option>
                                <option value="SAH">SAH</option>
                                <option value="TIDAK SAH">TIDAK SAH</option>
                                <option value="UNDUR DIRI">UNDUR DIRI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 text-center align-self-center fw-bold">VS</div>
                    <div class="col-md-5">
                        <div class="mb-2">
                            <label class="form-label">Keputusan</label>
                            <select name="status_merah" id="status_merah" class="form-select" required>
                                <option selected readonly>-- Pilih Keputusan --</option>
                                <option value="SAH">SAH</option>
                                <option value="TIDAK SAH">TIDAK SAH</option>
                                <option value="UNDUR DIRI">UNDUR DIRI</option>
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
