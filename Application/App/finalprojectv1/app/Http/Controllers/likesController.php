<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\likes;
use App\Models\posts;
use Illuminate\Support\Facades\DB;

class likesController extends Controller
{
 

    public function likeme(Request $request, $id){
        $likes = new likes;

       
            if($likes::where('post_id',$request->postid)->where('user_id',$id)->get()->count()>0){
                return 'already liked';
            }
          
        else{
            $likes = new likes([
                'likes' => 1,
                'post_id' => $request->postid,
                'user_id' => $id
            ]);
            
         

        }
  
       $confirmation =  $likes->save();

       if($confirmation){

           $response = array(
                'status' => '200',
                'message' => "Your likes has been Added",
            );
            
            return $response;
        }
    }

    
    public function getLikes(Request $request){


        $alllikes = DB::table('likes')->where('post_id',$request->postid)->select(DB::raw('count("likes") as totallikes'))->get();

        return $alllikes[0]; 

    }
   
}
