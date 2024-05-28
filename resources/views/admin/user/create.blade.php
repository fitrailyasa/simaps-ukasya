<!-- Tombol untuk membuka modal -->
<a role="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#modalFormCreate">Tambah</a>

<!-- Modal -->
<div class="modal fade" id="modalFormCreate" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Tambah @yield('title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="nama" name="name" id="name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status"
                                    id="status" required>
                                    <option selected disabled>Pilih Status</option>
                                    <option value="0">Tidak Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="email" name="email" id="email" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="password" name="password" id="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Roles</label>
                                <select class="form-select @error('permissions') is-invalid @enderror"
                                    name="permissions" id="permissions" required>
                                    <option selected disabled>Pilih Roles</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Operator">Operator</option>
                                    <option value="Dewan">Dewan</option>
                                    <option value="Juri 1">Juri 1</option>
                                    <option value="Juri 2">Juri 2</option>
                                    <option value="Juri 3">Juri 3</option>
                                    <option value="Juri 4">Juri 4</option>
                                    <option value="Juri 5">Juri 5</option>
                                    <option value="Juri 6">Juri 6</option>
                                    <option value="Juri 7">Juri 7</option>
                                    <option value="Juri 8">Juri 8</option>
                                    <option value="Juri 9">Juri 9</option>
                                    <option value="Juri 10">Juri 10</option>
                                </select>
                                @error('permissions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="roles_id" id="roles_id">
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
    document.getElementById('permissions').addEventListener('change', function() {
        var roles_id = document.getElementById('roles_id');
        var selectedRole = this.value;

        switch (selectedRole) {
            case 'Admin':
                roles_id.value = 1;
                break;
            case 'Operator':
                roles_id.value = 2;
                break;
            case 'Dewan':
                roles_id.value = 3;
                break;
            default:
                if (selectedRole.startsWith('Juri')) {
                    roles_id.value = 4;
                } else {
                    roles_id.value = '';
                }
                break;
        }
    });
</script>
