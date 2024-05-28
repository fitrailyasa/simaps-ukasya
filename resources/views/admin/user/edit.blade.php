<div class="modal-content">
    <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title" id="modalFormLabel">Edit @yield('title')</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="nama" name="name" id="name" value="{{ $user->name }}" required>
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
                            @foreach ($gelanggangs as $gelanggang)
                                <option value="{{ $gelanggang->id }}"
                                    {{ $gelanggang->id == $user->gelanggang ? 'selected' : '' }}>
                                    {{ $gelanggang->nama }}
                                </option>
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
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="status"
                            required>
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
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
                            placeholder="email" name="email" id="email" value="{{ $user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="password" name="password" id="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <select class="form-select @error('permissions') is-invalid @enderror" name="permissions"
                            id="permissions" required>
                            <option disabled>Pilih Roles</option>
                            <option value="Admin" {{ $user->permissions == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Operator" {{ $user->permissions == 'Operator' ? 'selected' : '' }}>Operator
                            </option>
                            <option value="Dewan" {{ $user->permissions == 'Dewan' ? 'selected' : '' }}>Dewan</option>
                            <option value="Juri 1" {{ $user->permissions == 'Juri 1' ? 'selected' : '' }}>Juri 1
                            </option>
                            <option value="Juri 2" {{ $user->permissions == 'Juri 2' ? 'selected' : '' }}>Juri 2
                            </option>
                            <option value="Juri 3" {{ $user->permissions == 'Juri 3' ? 'selected' : '' }}>Juri 3
                            </option>
                            <option value="Juri 4" {{ $user->permissions == 'Juri 4' ? 'selected' : '' }}>Juri 4
                            </option>
                            <option value="Juri 5" {{ $user->permissions == 'Juri 5' ? 'selected' : '' }}>Juri 5
                            </option>
                            <option value="Juri 6" {{ $user->permissions == 'Juri 6' ? 'selected' : '' }}>Juri 6
                            </option>
                            <option value="Juri 7" {{ $user->permissions == 'Juri 7' ? 'selected' : '' }}>Juri 7
                            </option>
                            <option value="Juri 8" {{ $user->permissions == 'Juri 8' ? 'selected' : '' }}>Juri 8
                            </option>
                            <option value="Juri 9" {{ $user->permissions == 'Juri 9' ? 'selected' : '' }}>Juri 9
                            </option>
                            <option value="Juri 10" {{ $user->permissions == 'Juri 10' ? 'selected' : '' }}>Juri 10
                            </option>
                        </select>
                        @error('permissions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="roles_id" id="roles_id"
                    value="{{ old('roles_id', $user->roles_id ?? '') }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script>
    function updateRolesId() {
        var roles_id = document.getElementById('roles_id');
        var selectedRole = document.getElementById('permissions').value;

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
    }

    document.getElementById('permissions').addEventListener('change', updateRolesId);

    document.addEventListener('DOMContentLoaded', function() {
        updateRolesId();
    });
</script>
