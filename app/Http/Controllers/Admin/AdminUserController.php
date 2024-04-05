<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Gelanggang;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        $gelanggangs = Gelanggang::all();
        return view('admin.user.index', compact('users', 'roles', 'gelanggangs'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|max:255|unique:users,email',
                'gelanggang' => 'required',
                'password' => 'required',
                'roles_id' => 'required',
                'status' => 'required'
            ],
            [
                'name.required' => 'name harus diisi!',
                'name.max' => 'name maksimal 255 karakter!',
                'email.required' => 'Email harus diisi!',
                'email.max' => 'Email maksimal 255 karakter!',
                'email.unique' => 'Email sudah terdaftar!',
                'gelanggang.required' => 'No HP harus diisi!',
                'password.required' => 'Password harus diisi!',
                'roles_id.required' => 'Roles harus diisi!',
                'status.required' => 'Status harus diisi!'
            ]
        );
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gelanggang' => $request->gelanggang,
            'password' => Hash::make($request->password),
            'roles_id' => $request->roles_id
        ]);

        if (auth()->user()->roles_id == 1) {
            return redirect('admin/user')->with('sukses', 'Berhasil Tambah User!');
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
                'gelanggang' => 'required',
                'roles_id' => 'required',
                'status' => 'required'
            ],
            [
                'name.required' => 'name harus diisi!',
                'name.max' => 'name maksimal 255 karakter!',
                'email.required' => 'Email harus diisi!',
                'email.max' => 'Email maksimal 255 karakter!',
                'gelanggang.required' => 'No HP harus diisi!',
                'roles_id.required' => 'Roles harus diisi!',
                'status.required' => 'Status harus diisi!'
            ]
        );

        $user = User::where('id', $id)->first();
        $user->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'gelanggang' => $request->gelanggang,
                'password' => Hash::make($request->password),
                'roles_id' => $request->roles_id,
                'status' => $request->status
            ]
        );
        if (auth()->user()->roles_id == 1) {
            return redirect('admin/user')->with('sukses', 'Berhasil Edit User!');
        }
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if (auth()->user()->roles_id == 1) {
            return redirect('admin/user')->with('sukses', 'Berhasil Hapus User!');
        }
    }
}
