<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    // authenticatet user
    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials=$request->only('perid', 'password');

        $perid = $request->perid;
        $password = $request->password;

        if (Auth::guard('admin')->attempt(['perid'=> $perid,'password'=> $password, 'admin' => 1])){
            // Authentication passed...
            return redirect('admindashboard');

        }elseif (Auth::guard('authuser')->attempt(['perid' => $perid, 'password' => $password, 'admin' => 0])){

            return redirect('dashboard');

        }else{

            return redirect('login')->withErrors(['User'=>'Perid o Password errata!Accesso Negato!']);
        }
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('admin')->logout();
        Auth::guard('authuser')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    //Change Password
    public function updatepassword(Request $request){
        dd($request);
    }
}
