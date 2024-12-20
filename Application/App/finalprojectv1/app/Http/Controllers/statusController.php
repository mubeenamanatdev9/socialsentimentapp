<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class statusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allstatus = DB::table('statuses')->leftJoin('users','statuses.user_id','=','users.id')->select('statuses.image','statuses.description','statuses.updated_at','users.name')->orderBy('updated_at','desc')->paginate(3);
        
        $currentuserstatus = DB::table('statuses')->where('user_id',session('id'))->get();
        
        // return $currentuserstatus; die();
        

        if(count($currentuserstatus)==null){
            $nullstatus = new \stdClass();
            $nullstatus->name = session('name'); 
            $nullstatus->image = 'storage/statusimages/status_hero_sm.jpg'; 
            $nullstatus->updated_at = 'No date'; 
            $nullstatus->description = 'No status has been updated yet'; 
             
            // return $nullstatus; die();
            return view('status',['currentstatus'=>array($nullstatus),'allstatus'=>$allstatus]);
        }else{
            $username = DB::table('users')->where('id',$currentuserstatus[0]->user_id)->select('name')->get();
            $currentuserstatus[0]->name=$username[0]->name;
            return view('status',['currentstatus'=>$currentuserstatus,'allstatus'=>$allstatus]);
        }

        return $currentuserstatus; die();
       
    }

    public function updatestatus(Request $request)
    {

        $values = $request->all();

        date_default_timezone_set('Asia/Karachi');
        if ($request->hasFile('image')) {
            $destination_path = 'public/statusimages';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            //check if user id exists
            if (DB::table('statuses')->where('user_id', session('id'))->exists()) {

                $updatefilename = db::table('statuses')->where('user_id', session('id'))->update([
                    'image' => "storage/statusimages/" . $image_name,
                    'description' => $values['statusdetails'],
                    'user_id' => session('id'),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            } else {
                $updatefilename = db::table('statuses')->where('user_id', session('id'))->insert([
                    'image' => "storage/statusimages/" . $image_name,
                    'description' => $values['statusdetails'],
                    'user_id' => session('id'),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }

        } else {

            if (DB::table('statuses')->where('user_id', session('id'))->exists()) {

                $updatefilename = db::table('statuses')->where('user_id', session('id'))->update([
                    'image' => 'storage/statusimages/status_hero_sm.jpg',
                    'description' => $values['statusdetails'],
                    'user_id' => session('id'),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            } else {
                $updatefilename = db::table('statuses')->where('user_id', session('id'))->insert([
                    'image' => 'storage/statusimages/status_hero_sm.jpg',
                    'description' => $values['statusdetails'],
                    'user_id' => session('id'),
                    'updated_at' => date("Y-m-d H:i:s"),
                ]);
            }

        }

       

        return redirect('status');
    }
}
