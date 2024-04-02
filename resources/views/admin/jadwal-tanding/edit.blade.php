<div class="modal-content">
    <form method="POST" action="{{ route('admin.jadwal-tanding.update', $jadwaltanding->id) }}"
        enctype="multipart/form-data">
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
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Partai</label>
                        <input type="number" class="form-control @error('partai') is-invalid @enderror"
                            placeholder="partai" name="partai" id="partai" value="{{ $jadwaltanding->partai }}"
                            required>
                        @error('partai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Gelanggang</label>
                        <select class="form-select @error('gelanggang') is-invalid @enderror" name="gelanggang"
                            id="gelanggang" required>
                            @foreach ($gelanggangs as $gelanggang)
                                <option value="{{ $gelanggang->id }}"
                                    {{ $gelanggang->id == $jadwaltanding->gelanggang_id ? 'selected' : '' }}>
                                    {{ $gelanggang->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('gelanggang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Babak</label>
                        <select class="form-select @error('babak') is-invalid @enderror" name="babak" id="babak"
                            required>
                            <option selected>{{ $jadwaltanding->babak ?? '-' }}</option>
                            <option value="Penyisihan">Penyisihan</option>
                            <option value="Perempat Final">Perempat Final</option>
                            <option value="Semi Final">Semi Final</option>
                            <option value="Final">Final</option>
                        </select>
                        @error('babak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Kelompok</label>
                        <input type="text" class="form-control @error('kelompok') is-invalid @enderror"
                            placeholder="kelompok" name="kelompok" id="kelompok" value="{{ $jadwaltanding->kelompok }}"
                            required>
                        @error('kelompok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Sudut Biru</label>
                        <select class="form-select @error('sudut_biru') is-invalid @enderror" name="sudut_biru"
                            id="sudut_biru" required>
                            @foreach ($pengundiantandings as $pengundiantanding)
                                <option value="{{ $pengundiantanding->no_undian }}"
                                    {{ $pengundiantanding->no_undian == $jadwaltanding->sudut_biru ? 'selected' : '' }}>
                                    {{ $pengundiantanding->Tanding->nama ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('sudut_biru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Sudut Merah</label>
                        <select class="form-select @error('sudut_merah') is-invalid @enderror" name="sudut_merah"
                            id="sudut_merah" required>
                            @foreach ($pengundiantandings as $pengundiantanding)
                                <option value="{{ $pengundiantanding->no_undian }}"
                                    {{ $pengundiantanding->no_undian == $jadwaltanding->sudut_merah ? 'selected' : '' }}>
                                    {{ $pengundiantanding->Tanding->nama ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('sudut_merah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Sudut Selanjutnya</label>
                        <select class="form-select @error('next_sudut') is-invalid @enderror" name="next_sudut"
                            id="next_sudut" required>
                            <option selected value="{{ $jadwaltanding->next_sudut }}">
                                {{ $jadwaltanding->next_sudut == 1 ? 'Sudut Biru' : 'Sudut Merah' }}</option>
                            <option value="1">Sudut Biru</option>
                            <option value="2">Sudut Merah</option>
                        </select>
                        @error('next_sudut')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <label class="form-label">Next Partai</label>
                        <input type="number" class="form-control @error('next_partai') is-invalid @enderror"
                            placeholder="next_partai" name="next_partai" id="next_partai"
                            value="{{ $jadwaltanding->next_partai }}" required>
                        @error('next_partai')
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
