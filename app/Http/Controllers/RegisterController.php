<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        // Mengambil semua data level dan user
        $level = LevelModel::all();
        return view('auth.register', ['level' => $level]);
    }

    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi input dari form registrasi
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];

            // Melakukan validasi
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            // Hash password sebelum disimpan
            $data = $request->all();
            $data['password'] = Hash::make($request->password);

            // Simpan user baru ke database
            UserModel::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan',
                'redirect' => url('login') // Redirect ke halaman login
            ]);
        }

        return redirect('/'); // Jika bukan request AJAX, redirect ke home
    }
}
