<?php

namespace App\Http\Controllers;

use App\analysisClass\analysisbaseclass;
use App\Models\comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class commentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function addcomment(Request $request, $id)
    {

        $comment = new comments;

        $comment->comment = $request->comment;
        $comment->postid = $request->postid;
        $comment->userid = $id;

        if ($comment->save()) {

            return $comment->id;
        }

    }

    public function analyizenow(Request $request)
    {

        $values = $request->all();
        $comment = DB::table('comments')->where('id', $values['commentid'])->select('comment')->get();
        $analizetext = new analysisbaseclass();
        $cleancomment = $analizetext->analysisbase($comment[0]->comment);
        $scoretoStore = $analizetext->makescore($cleancomment);
        $postivescore = $scoretoStore['positivescore'];
        $negativescore = $scoretoStore['negativescore'];
        $compoundscore = $scoretoStore['compound'];
        $analysisSave = "$postivescore" . "," . "$negativescore" . "," . "$compoundscore";
        $saveanalysis = DB::table('comments')->where('id', $values['commentid'])->update([
            'scores' => $analysisSave,
            'totalscores' => $compoundscore,
        ]);
        if($saveanalysis){
            return "analysissaved";
        }
        else{
            return "analysisnotsave";
        }
    }

    public function getcommentscount(Request $request)
    {
        $getcount = DB::table('comments')->where('postid', $request->postid)->select(DB::raw('count("comment") as totalcomments'))->get();

        return $getcount[0];
    }

}
