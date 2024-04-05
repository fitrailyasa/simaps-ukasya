<div class="modal-content">
    <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title" id="modalFormLabel">Edit @yield('title')
            </h5>
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
                            <div class="invalid-feedback">{{ $message }}
                            </div>
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
                            <div class="invalid-feedback">{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="status"
                            required>
                            <option selected value="{{ $user->status }}">
                                {{ $user->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</option>
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
                            placeholder="email" name="email" id="email" value="{{ $user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="password" name="password" id="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <select class="form-select @error('roles_id') is-invalid @enderror" name="roles_id"
                            id="roles_id" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ $role->id == $user->roles_id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('roles_id')
                            <div class="invalid-feedback">{{ $message }}
                            </div>
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
