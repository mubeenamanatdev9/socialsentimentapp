<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (session()->has('name')) {
            return redirect('index');
        } else {
            return view('login');
        }

    }

    public function login(Request $request)
    {

        $validate = $request->validate([
            'email' => ['required', 'min:4', 'email'],
            'password' => ['required', 'min:4'],
        ]);

        if (User::where('email', '=', $request->email)->where('password', '=', $request->password)->exists()) {
            $user = User::where('email', '=', $request->email)->where('password', '=', $request->password)->
                select('name', 'id', 'email', 'isadmin')->get();

            session([
                'id' => $user[0]->id,
                'name' => $user[0]->name,
                'email' => $user[0]->email,
                'isadmin' => $user[0]->isadmin,
            ]);

            return redirect('index');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Email or password doesnt matched']);
        }

    }

}
