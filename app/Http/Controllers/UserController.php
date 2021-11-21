<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('adminuser.indexUser',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('adminuser.createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //routine registrazione nuovo utente
        $validate = $request->validate([
            'perid' => 'required|unique:users|',
            'name'=> 'required',
            'password' => 'required|confirmed|min:4|max:20',
        ]);

        $user = new User();
        $user->perid = $request->perid;
        $user->name = $request->name;
        if($request->admin == 'on'){
            $user->admin = true;
        }else{
            $user->admin = false;
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.index')
                ->with('alerttype','success')
                ->with('alertmessage',sprintf('Utente %s creato con Successo',$request->name));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);

        return view('adminuser.editUser',['user'=>$user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        $validate=$request->validate([
            'name'=>'required'
            ]);

        $user = User::find($id);

        if($user->perid == 'admin'){
            return redirect('user')->with('alerttype','warning')->with('alertmessage','Non puoi modificare l\'utente Admin!');
        }


        $user->name=$request->name;
        if($request->admin =='on'){
            $user->admin = 1;
        }else{
            $user->admin = 0;
        }


        $user->save();


        return redirect('user')->with('alerttype','success')->with('alertmessage',sprintf('Utente %s Modificato  con successo',$request->name));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        if($user->perid == 'admin'){
            return redirect('user')->with('alerttype','warning')->with('alertmessage','Non puoi eliminare l\'utente Admin!');
        }
        $user->delete();

        return redirect('user')->with('alerttype','warning')->with('alertmessage',sprintf('Utente %s Eliminato!',$user->name));
    }

    public function resetpassword($id){
        //routine di reset password per utenti

        $user = User::find($id);
        if($user->perid == 'admin'){
            return redirect('user')->with('alerttype','warning')->with('alertmessage','Non puoi modificare l\'utente Admin!');
        }

        return view('adminuser.resetpassword',['id'=> $id]);

    }

    public function  updatepassword(Request $request, $id){
        //routine di reset password -> modifica password in db

        $user = User::find($id);

        if($user->perid=='admin') return redirect('user')->with('alerttype','warning')->with('alertmessage','Non puoi modificare l\'utente Admin!');

        $validate = $request->validate([
            'password' => 'confirmed|required|min:4|max:20|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

       return redirect()->route('user.edit',$id)->with('alerttype','success ')->with('alertmessage','Password aggiornata con successo!');
    }
}
