@extends('layouts.admin.table')

@section('title', 'User')

@section('table-user', 'active')

@section('topLeft')
    <h4>Kelola Data User</h4>
@endsection

@section('formCreate')
    @include('admin.user.create')
@endsection

@section('table')
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Gelanggang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name ?? '-' }}</td>
                    <td>{{ $user->email ?? '-' }}</td>
                    <td>
                        @if ($user->permissions == 'Admin')
                            <span class="badge bg-primary">Admin</span>
                        @elseif($user->permissions == 'Operator')
                            <span class="badge bg-success">Operator</span>
                        @elseif($user->permissions == 'Dewan')
                            <span class="badge bg-warning">Dewan</span>
                        @else
                            <span class="badge bg-secondary">{{ $user->permissions }}</span>
                        @endif
                    </td>
                    <td>{{ $user->Gelanggang->nama ?? '-' }}</td>
                    <td>
                        @if ($user->status == 1)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Tidak Aktif</span>
                        @endif
                    </td>
                    <td class="manage-row">
                        <a role="button" class="btn-sm btn-warning mr-2" data-bs-toggle="modal"
                            data-bs-target=".formEdit{{ $user->id }}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade formEdit{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="">
                            <div class="modal-dialog" role="document">
                                @include('admin.user.edit')
                            </div>
                        </div>
                        @if ($user->email != 'admin@admin.com')
                            <!-- Button trigger modal -->
                            <a role="button" class="btn-sm btn-danger delete-button" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-sm{{ $user->id }}">
                                <i class="fa fa-trash"></i>
                            </a>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-sm{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-hidden="">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><strong>Hapus @yield('title')</strong>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">Apakah anda yakin ingin menghapus
                                            @yield('title')?</div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input type="submit" class="btn btn-danger light" name=""
                                                    id="" value="Hapus">
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">Tidak</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Gelanggang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection
