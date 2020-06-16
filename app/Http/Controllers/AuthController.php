<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function ambilKey()
    {
        return 'ini key';
    }

    public function registrasi(Request $request)
    {
        $nim = $request->input('nim');
        $nama = $request->input('nama');
        $password = Hash::make($request->input('password'));

        $registrasi = User::create([
            'nim' => $nim,
            'nama' => $nama,
            'password' => $password,
            'api_token' => ''
        ]);

        if ($registrasi) {
            return response()->json([
                'success' => true,
                'pesan' => 'Berhasil Menyimpan Data',
                'data' => $registrasi
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'pesan' => 'Gagal Menyimpan Data'
            ], 400);
        }
    }

    public function masuk(Request $request)
    {
        $nim = $request->input('nim');
        $password = $request->input('password');

        $carinim = User::where('nim', $nim)->first();

        if (Hash::check($password, $carinim->password)) {
            $api_token = base64_encode(str_random(32));

            $carinim->update([
                'api_token' => $api_token
            ]);

            return response()->json([
                'success' => true,
                'pesan' => 'Berhasil Masuk',
                'data' => [
                    'pengguna' => $carinim,
                    'api_token' => $api_token
                ]
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'pesan' => 'Gagal Masuk',
                'data' => ''
            ], 201);
        }
    }

    //
}
