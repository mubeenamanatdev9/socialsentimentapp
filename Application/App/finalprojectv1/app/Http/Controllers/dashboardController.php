<?php

namespace App\Http\Controllers;

use App\analysisClass\analysisbaseclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $post = DB::table('comments')->join('posts', 'comments.postid', '=', 'posts.id')->select(db::raw('avg(totalscores) as scored ,posts.category,postid'))->orderBy('scored', 'DESC')->groupBy('postid')->paginate(5);

        foreach ($post as $key => $value) {

            $sentiment = '';

            if ($value->scored < 0) {
                $sentiment = "Bad";

            } elseif ($value->scored >= 0 && $value->scored < 1) {
                $sentiment = "Neutral";

            } elseif ($value->scored >= 1) {
                $sentiment = "Good";

            }

            $value->sentiment = $sentiment;

        }
        return view('dashboard', [
            'allpostlistdata' => $post,
        ]);

    }

    /**
     *  Below Code is extra
     *
     * 
     */

    public function analyizetext(Request $request)
    {
        $values = $request->all();
        $commentsarray = DB::table('posts')->select('comments')->where('id', '=', $values['postid'])->get();
        $explodedCommentsArray = explode(',', $commentsarray[0]->comments);
        if ($commentsarray[0]->comments == null) {
            return "NO COMMENTS PRESENT";
        }
        $commenttext = $commentsarray[0]->comments;
        $analysis = new analysisbaseclass();
        $finalCleanArray = $analysis->analysisbase($commenttext);

        $scoreing = $analysis->makescore($finalCleanArray);

        return $scoreing;
    }

    public function getindividualcommentanalysis($commentid, $postid)
    {

        $comment = DB::table('topics')->select('comments')->where('id', '=', $postid)->get();
        $commentarray = explode(',', $comment[0]->comments);
        $analysis = new analysisbaseclass();
        $finalCleanArray = $analysis->analysisbase($commentarray[$commentid]);
        $scoreing = $analysis->makescore($finalCleanArray);

        return $scoreing;

    }

    public function fetchspecificpost(Request $request, $id)
    {

        $post = DB::table('topics')->select('topic_details', 'category', 'date')->where('id', '=', $id)->get();

        return $post[0];
    }

    public function addkeywords(Request $request)
    {
        $table = 'sentinetwords';
        $keyword = strtolower($request->keyword);
        $keywordmodied = "'" . $keyword . '#' . 1 . "'";
        $keywordtoadd = "";

        $count = db::select("SELECT SynsetTerms FROM sentinetwords WHERE
        FIND_IN_SET($keywordmodied,SynsetTerms)");
        $numberassigner = 0;
        if (count($count) > 0) {
            $totalcount = 1;
            $index = 2;
            do {

                $keywordmodied = "'" . $keyword . '#' . $index . "'";
                $run = true;
                $countingofafter = db::select("SELECT SynsetTerms FROM sentinetwords WHERE
                FIND_IN_SET($keywordmodied,SynsetTerms)");

                if (count($countingofafter) > 0) {

                    $index++;
                    $totalcount++;
                } else {
                    $run = false;
                }
            } while ($run == true);
            $numberassigner = $totalcount + 1;
            $keywordtoadd = $keyword . '#' . $numberassigner;

        } else {
            $keywordtoadd = $keyword . '#' . 1;

        }

        $post = DB::table($table)->insert([
            'PosScore' => $request->positivevalue,
            'NegScore' => $request->negativevalue,
            'SynsetTerms' => $keywordtoadd,
            'POS' => $request->pos,
            'Gloss' => $request->glossary,
        ]);

        if ($post) {
            return redirect('dashboard');
        } else {
            return 'faildedtoaddkeyword';
        }
    }

    public function commentarray($id)
    {
        $commentsarray = DB::table('topics')->select('comments')->where('id', '=', $id)->get();
        $explodedCommentsArray = explode(',', $commentsarray[0]->comments);
        if ($commentsarray[0]->comments == null) {
            return "NO COMMENTS PRESENT";
        }
        $data = array('data' => $explodedCommentsArray);

        return $data;
    }

}
