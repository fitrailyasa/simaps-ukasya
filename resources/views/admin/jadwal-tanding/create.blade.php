<!-- Tombol untuk membuka modal -->
<a role="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#modalFormCreate">Tambah</a>

<!-- Modal -->
<div class="modal fade" id="modalFormCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if (auth()->user()->roles_id == 1)
                <form method="POST" action="{{ route('admin.jadwal-tanding.store') }}" enctype="multipart/form-data">
                @elseif (auth()->user()->roles_id == 2)
                    <form method="POST" action="{{ route('op.jadwal-tanding.store') }}" enctype="multipart/form-data">
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
                            <input type="number" class="form-control @error('partai') is-invalid @enderror"
                                placeholder="partai" name="partai" id="partai" required>
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
                                <option selected disabled>Pilih Gelanggang</option>
                                @foreach ($gelanggangs as $gelanggang)
                                    <option value="{{ $gelanggang->id }}">{{ $gelanggang->nama ?? '-' }}</option>
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
                            <select class="form-select @error('babak') is-invalid @enderror" name="babak"
                                id="babak" required>
                                <option selected disabled>Pilih Babak</option>
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
                            <label class="form-label">Golongan</label>
                            <select name="golongan" id="golongan"
                                class="form-select @error('golongan') is-invalid @enderror">
                                <option value="">Pilih Golongan</option>
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
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Putra</option>
                                <option value="P">Putri</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">Kelas Tanding</label>
                            <select name="kelas" id="kelas"
                                class="form-select @error('kelas') is-invalid @enderror">
                                <option value="">Pilih Kelas Tanding</option>
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
                            <label class="form-label">Sudut Biru</label>
                            <select class="form-select @error('sudut_biru') is-invalid @enderror" name="sudut_biru"
                                id="sudut_biru" required>
                                <option selected disabled data-golongan="" data-jenis-kelamin="" data-kelas="">Pilih
                                    Atlet</option>
                                @foreach ($pengundiantandings as $pengundiantanding)
                                    <option value="{{ $pengundiantanding->no_undian }}"
                                        data-golongan="{{ $pengundiantanding->Tanding->golongan }}"
                                        data-jenis-kelamin="{{ $pengundiantanding->Tanding->jenis_kelamin }}"
                                        data-kelas="{{ $pengundiantanding->Tanding->kelas }}">
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
                                <option selected disabled data-golongan="" data-jenis-kelamin="" data-kelas="">Pilih
                                    Atlet</option>
                                @foreach ($pengundiantandings as $pengundiantanding)
                                    <option value="{{ $pengundiantanding->no_undian }}"
                                        data-golongan="{{ $pengundiantanding->Tanding->golongan }}"
                                        data-jenis-kelamin="{{ $pengundiantanding->Tanding->jenis_kelamin }}"
                                        data-kelas="{{ $pengundiantanding->Tanding->kelas }}">
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
                                <option selected disabled>Pilih Sudut</option>
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
                                placeholder="next_partai" name="next_partai" id="next_partai" required>
                            @error('next_partai')
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

<script>
    // Fungsi untuk mengatur opsi atlet berdasarkan filter
    function filterAtlet() {
        var golongan = document.getElementById('golongan').value;
        var jenis_kelamin = document.getElementById('jenis_kelamin').value;
        var kelas = document.getElementById('kelas').value;
        var sudut_biru = document.getElementById('sudut_biru').value; // Atlet sudut biru yang dipilih
        var atlet_options = document.querySelectorAll('#sudut_biru option, #sudut_merah option');

        atlet_options.forEach(function(option) {
            var atlet_golongan = option.getAttribute('data-golongan');
            var atlet_jenis_kelamin = option.getAttribute('data-jenis-kelamin');
            var atlet_kelas = option.getAttribute('data-kelas');
            var atlet_sudut = option.value; // Sudut atlet (biru atau merah)

            // Tampilkan atlet yang sesuai dengan filter dan bukan atlet yang dipilih pada sudut biru
            if ((golongan === '' || golongan === atlet_golongan) &&
                (jenis_kelamin === '' || jenis_kelamin === atlet_jenis_kelamin) &&
                (kelas === '' || kelas === atlet_kelas) &&
                (atlet_sudut !== sudut_biru)) { // Tambahkan kondisi untuk memeriksa sudut
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
    }

    document.getElementById('golongan').addEventListener('change', filterAtlet);
    document.getElementById('jenis_kelamin').addEventListener('change', filterAtlet);
    document.getElementById('kelas').addEventListener('change', filterAtlet);
    document.getElementById('sudut_biru').addEventListener('change', filterAtlet); // Tambahkan event listener

    window.addEventListener('load', filterAtlet);
</script>
