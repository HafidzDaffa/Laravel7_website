<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function process(Request $request) {
        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $result = Admin::where('username', '=',$validateData['username'])->first();

        if($result) {
            if(Hash::check($request->password, $result->password)) {
                session(['id_admin' => $result->id]);
                return redirect(route('halaman.index'));
            } else {
                return back()->withInput()->with('pesan', 'Password Salah');
            }
        } else {
            return back()->withInput()->with('pesan', 'Login Gagal');
        }
    }

    public function logout() {
        session()->forget('id_admin');
        session()->flush();
        return redirect(route('auth.index'));
    }
}
