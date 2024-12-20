<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\post;
use App\Models\status;
use App\Models\likes; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiledata = $this->profiledata(session('id'));
        return view('profilepage',['pdata'=> $profiledata]);
       
    }

    public function profiledata($user) {

        $userinfo = new user;
        $userinfo = $userinfo->where('id','=',$user)->get();
        
        $data = [
            'fname' => $userinfo[0]->name,
            'email' => $userinfo[0]->email,
            'profileimage'=>$userinfo[0]->profileimage,
            'phonenumber' =>$userinfo[0]->phone_num,
            'occupation' => $userinfo[0]->occupation,
            'dataofbirth' => $this->agecal($userinfo[0]->dateofbirth),
            'totalpost' => $this->totalpost($user),
            'totalstatus' =>$this->totalstatus($user),
            'totalpostslike' => $this->totalpostslikes($user),
            'password'=>$userinfo[0]->password,
            'dob' =>$userinfo[0]->dateofbirth,
            'imagepath'=>$userinfo[0]->profileimage

        ];

        return $data;
    }

    public function agecal($dob): int{

        $datenow = Carbon::now();

        $datenow = $datenow->diffinYears($dob);

        return $datenow;

    }
    public function totalpost($user) : int{

        $post = new post;
        $totalpost = $post->where('user_id','=',$user)->count();


        return $totalpost;
    }
    public function totalstatus($user) : int {
        $status = new status;

        $status = $status->where('user_id','=',$user)->count();
        $totalstatus = $status;

        return $totalstatus;
    }

    public function totalpostslikes($user) : int{
        $likes = new likes;
        $likes = $likes->where('user_id','=',$user)->count();
        $totalpostlike = $likes;

        return $totalpostlike;
    }

    public function storefile(Request $request){
       
        $file = $request->all();

        // return $request->file('image'); die();
        $input = $request->all();
        if($request->hasFile('image')){
            $destination_path = 'public/profileimages';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path,$image_name);

            $updatefilename = db::table('users')->where('id',session('id'))->update([
                'profileimage'=> "storage/profileimages/" . $image_name
            ]);

        }
        
        return redirect('profile');

    }


  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
        $user = new user;
       
       if($user->where('id','!=',session('id'))->where('email','=',$request->emailaddress)->exists()){

        return redirect()->back()->withErrors(['msg'=>'email already exists please add other email address']);

       }
       else{
    
        $user = $user->where('id','=',session('id'))->update(
            [
                'name'=>$request->username,
                'email'=>$request->emailaddress,
                'password'=>$request->password,
                'dateofbirth'=>$request->dateofbirth,
                'phone_num'=>$request->contactnumber,
              
            ]
        );
               
       }

        
        return $this->index();
    }

    
}
