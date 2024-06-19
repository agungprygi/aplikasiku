<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Session\Middleware\StartSession;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',[
            'title' => 'Register'
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'min:5', 'max:255', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => 'required|min:5|max:255'
        ]);

        // Enkripsi password sebelum menyimpan ke database
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Tambahkan user baru ke database
        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil.');

    }
}
