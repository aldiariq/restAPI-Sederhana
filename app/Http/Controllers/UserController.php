<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detailuser($id)
    {
        $caripengguna = User::find($id);
        if ($caripengguna) {
            return response()->json([
                'success' => true,
                'pesan' => 'Id Ditemukan',
                'data' => $caripengguna
            ], 200);   
        }else {
            return response()->json([
                'success' => false,
                'pesan' => 'Id Tidak Ditemukan',
                'data' => ''
            ], 404);
        }
    }

    //
}
