<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use 
use App\Models\post;
use App\Models\likes;
use App\Models\User;
class postPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createpost(Request $request,$id)
    {
        $validated = $request->validate([
            'subject' => ['required','min:10','max:50'],
            'category' => ['required','min:4','max:30'],
            'userpost' => ['required','min:1','max:2000']
        ]);

        

        $post = new post;
        $user = new User;
        $arr =  $user::where('id',session('id'))->select('isadmin')->get();


        if($arr[0]->isadmin=="admin"){

            $post->subject = $request->subject;
            $post->category = $request->category;
            $post->postcontent = $request->userpost;
            $post->user_id = $id;
    
            $post->save();

            return redirect('index');
        }else {
            return redirect()->back()->withErrors(['msg'=>'Sorry You Are not admin you are not allowed Add Topics']);
        }
        

        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $likes = new likes;
        $post =  post::all();

        return $post;
    }

}
