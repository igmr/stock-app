<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticationFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function create()
    {
        return view('authentication');
    }

    public function store(AuthenticationFormRequest $req)
    {
        $credentials = $req->validated();
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            return redirect()->route('app.dashboard');
        }
    }

    public function destroy(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('auth.login.index');
    }
}
