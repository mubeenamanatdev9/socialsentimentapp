<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class signupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('signup');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        $validated = $request->validate([
            'name' => 'required|min:10|max:30',
            'email' => 'required|email',
            'password' => 'required|min:4|max:10',
            'confirmpassword' => 'required|min:4|max:10',
        ]);

        if ($request->password === $request->confirmpassword) {

            if (DB::table('users')->where('email', $request->email)->exists()) {

                // return view('signup',['emailalreadyexist'=>'Email Address already Exits']);
                return redirect()->back()->withErrors(['msg'=>"Email already exists"]);

                
            }else{
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = $request->password;
                $saved = $user->save();

                if ($saved) {
                    return redirect('login');
                }
                
            }

        } 
        else {
            // return view('signup',['errorofpnotmatch' => 'Confirm Password does not matched']);
            return redirect()->back()->withErrors(['msg'=>"Confirm Password does not matched"]);
        }

    }

   
}
