<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // authenticatet user
    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials=$request->only('perid', 'password');

        $perid = $request->perid;
        $password = $request->password;

        if (Auth::attempt(['perid'=> $perid,'password'=> $password])){
            // Authentication passed...
            return redirect('dashboard');
        }else{
            $request->session()->regenerate();

            return redirect('login')->withErrors(['User'=>'Perid o Password errata!Accesso Negato!']);
        }
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();


        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    //Change Password
    public function updatepassword(Request $request){

        $validate = $request->validate([
            'oldpassword'=> 'required',
            'password'=> 'required|min:8|confirmed',
            'password_confirmation' => 'required|'
        ]);

        $userobj = new User();
        $user = $userobj->where('perid',$request->perid)->first();

        if(Hash::check($request->oldpassword, $user->password)){

            $user->password = Hash::make($request->password);
            $user->save();
            $alert = [
                'type'=>'success',
                'message' => 'Password Cambiata con successo'
            ];
        }else{
            $alert = [
                'type'=>'warning',
                'message' => 'Password non modificata!Probabilmente hai sbagliato la vecchia Password'
            ];
        }


            return redirect('dashboard')->with('alerttype',$alert['type'])->with('alertmessage',$alert['message']);


    }
}
