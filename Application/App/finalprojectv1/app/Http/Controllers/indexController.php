<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\analysisClass\analysisbaseclass;

class indexController extends Controller
{
    public function showindex(Request $request)
    {

        $checklikes = array();

        $postsdata = DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')
            ->select('posts.subject', 'posts.id as postid', 'posts.created_at', 'posts.postcontent', 'posts.category', 'users.profileimage  as postuserimage', 'users.name'
            )->orderBy('created_at', 'DESC')->get();

        $postsdata->map(function ($data) {
            $isliked = false;
            $countlikes = null;
            $countcomments = null;

            $countlikes = DB::table('likes')->where('post_id', $data->postid)->count();
            $countcomments = DB::table('comments')->where('postid', $data->postid)->count();
            $checkuserlikes = DB::table('likes')->where('post_id', $data->postid)->where('user_id', session('id'))->count();
            $individualscore = DB::table('comments')->where('postid', $data->postid)
                ->select(DB::raw('avg(totalscores) as scores'))->get();
            $data->scores = number_format($individualscore[0]->scores,3);
            $sentisense = new analysisbaseclass();
            $data->sentiment = $sentisense->sentimentsense($data->scores);
            if ($checkuserlikes > 0) {
                $isliked = true;
            }
            if ($countlikes > 0 && $countcomments > 0) {

                return [

                    $data->isliked = $isliked,
                    $data->likes = $countlikes,
                    $data->comments = $countcomments,

                ];
            } else {
                return [

                    $data->isliked = $isliked,
                    $data->likes = $countlikes,
                    $data->comments = $countcomments,
                ];

            }
        });

        $postsdata = $postsdata->sortByDesc('scores');
        $postsdata = $postsdata->values()->all();

        // return $postsdata; die();
        return view('layouts.include', [
            'postsdata' => $postsdata,
            'userdetails' => $this->userdetails(),
            'statuslatest' => $this->statuslatest(),
        ]);

    }

    public function logout()
    {
        session()->flush();

        return redirect('login')->with('status', 'you are logout now');
    }

    public function topicCommentsload(Request $request, $postid)
    {

        return

        json_encode(DB::table('comments')->join('users', 'users.id', '=', 'comments.userid')
                ->where('postid', $postid)
                ->select('comments.comment as comments', 'users.name')
                ->get());
    }

    public function searchbycate(Request $request, $element)
    {

        $result = '';
        $element = $element . '%';
        $query = DB::table('posts')->select('category')->where('category', 'like', $element)->distinct()->get();

        foreach ($query as $value) {

            $result .= " <option class='w-100' " . "  value='" . $value->category . "'> ";

        }

        return $result;

    }
    public function searchedposts(Request $request)
    {

        $checklikes = array();

        $postsdata = DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')
        ->select('posts.subject', 'posts.id as postid', 'posts.created_at', 'posts.postcontent', 'posts.category', 'users.profileimage  as postuserimage', 'users.name'
        )->where('posts.category', '=', $request->postcategoryname)->get();


        $postsdata->map(function ($data) {
            $isliked = false;
            $countlikes = null;
            $countcomments = null;

            $countlikes = DB::table('likes')->where('post_id', $data->postid)->count();
            $countcomments = DB::table('comments')->where('postid', $data->postid)->count();
            $checkuserlikes = DB::table('likes')->where('post_id', $data->postid)->where('user_id', session('id'))->count();
            $individualscore = DB::table('comments')->where('postid', $data->postid)
                ->select(DB::raw('avg(totalscores) as scores'))->get();
            $data->scores = number_format($individualscore[0]->scores,3);
            $sentisense = new analysisbaseclass();
            $data->sentiment = $sentisense->sentimentsense($data->scores);
            if ($checkuserlikes > 0) {
                $isliked = true;
            }
            if ($countlikes > 0 && $countcomments > 0) {

                return [

                    $data->isliked = $isliked,
                    $data->likes = $countlikes,
                    $data->comments = $countcomments,
                ];
            } else {
                return [

                    $data->isliked = $isliked,
                    $data->likes = $countlikes,
                    $data->comments = $countcomments,
                ];

            }
        });

        $commentsdata = DB::table('comments')->join('users', 'users.id', '=', 'comments.userid')
            ->select('comments.comment as comments', 'comments.postid', 'users.name')
            ->get();

            return view('layouts.include', [
                'postsdata' => $postsdata,
                'userdetails' => $this->userdetails(),
                'statuslatest' => $this->statuslatest(),
            ]);
    }
    public function userdetails()
    {
        $userdetails = DB::table('users')->where('id', session('id'))->get();
        return $userdetails;
    }
    public function statuslatest()
    {

        $statuslatest = DB::table('statuses')->leftJoin('users', 'statuses.user_id', '=', 'users.id')
            ->select('statuses.image', 'statuses.description', 'statuses.updated_at', 'users.name')->orderBy('updated_at', 'DESC')->limit(2)->get();

        return $statuslatest;

    }
    
    public function simpledatafetch(){

        $options = db::table('posts')->select('category')->get();
        $option = " ";
        foreach ($options as $key => $value) {
            $option .= "<option value=> ". $value->category . "</option>";
            
        }
        return $option;
    }
}
