<?php 
namespace App\analysisClass;
use Illuminate\Support\Facades\DB;

class analysisbaseclass
{

    public function analysisbase($text)
    {
        // $pronouns = "all,another,any,anybody,anyone,anything,as,aught,both,each,eachother,either,enough,everybody,everyone,everything,few,he,her,hers,herself,him,himself,his,I,i,idem,it,its,itself,many,me,mine,most,my,myself,naught,neither,noone,nobody,none,nothing,nought,one,oneanother,one-another,other,others,ought,our,ours,ourself,ourselves,several,she,some,somebody,someone,something,somewhat,such,suchlike,that,thee,their,theirs,theirself,theirselves,them,themself,themselves,there,these,they,thine,this,This,those,thou,thy,thyself,us,we,what,whatever,whatnot,whatsoever,whence,where,whereby,wherefrom,wherein,whereinto,whereof,whereon,wherever,wheresoever,whereto,whereunto,wherewith,wherewithal,whether,which,whichever,whichsoever,who,whoever,whom,whomever,whomso,whomsoever,whose,whosever,whosesoever,whoso,whosoever,ye,yon,yonder,you,your,yours,yourself,yourselves,a,an,The,the,A,An,when,When,and,And";
        // $helpingverbs = "Am,am,is,are,was,were,being,been,be,Have,have,has,had,do,does,did,will,would,shall,should,may,might,must,can,could";
        // $prepositions = "About,After,Ago,Around,At,Before,By,Circa,During,Following,For,From,Gone,In,On,Past,Priorto,Since,Untiltill,Upto,Up until,Aboard,Above,Across,Against,Alongside,Amid,Among,Apartfrom,Astride,Atop,Behind,Below,Beneath,Beside,Between,Beyond,Close to,Far,Far from,Forward of,In between,In front of,Inside,Into,Minus,Near,Nearto,Next to,Of,Off,Onboard,On top of,Onto,Upon,Opposite,Out,Outof,Outside,Outside of,Over,Round,Through,Throughout,To,Together with,towards,Toward,Under,Underneath,Up against,With,Within,Without,Ahead,Along,Along with,Away,Away from,By means of,Down,Further to,Off of,Up,Via,According to,Anti,As,As for,As per,As to,As well as,Aside from,Bar,Barring,Because of,Besides,But for,But,Concerning,Considering,Contraryto,Counting,Cum,Dependingon,Despite,Dueto,Except,Exceptfor,Excepting,Excluding,Given,In addition to,in case of,In face of,In favor of, in favour of,In light of,In spite of,In view of,Including,Instead of,Less,Like,Not with standing,On account of,On behalf of,Other than,Owing to,Pending,Per,Plus,Preparatory to,Pro,Re,Regarding,Regardless of,Save,Save for,Saving,Than,Thanks to,Unlike,Versus,Withreferenceto,With regardto,Worth,about,after,ago,around,at,before,by,circa,during,following,for,from,gone,in,on,past,prior to,since,until,till,upto,up until,aboard,above,across,against,alongside,amid,among,apart from,astride,atop,behind,below,beneath,beside,between,beyond,close to,far,far from,forward of,in between,in front of,inside,into,minus,near,near to,next to,of,off,on board,on top of,onto,upon,opposite,out,out of,outside,outside of,over,round,through,through out,to,together with,towards,toward,under,underneath,up against,with,with in,with out,ahead,along,along with,away,away from,by means of,down,further to,off of,up,via,according to,anti,as,as for,as per,as to,as well as,aside from,bar,barring,because of,besides,but for,but,concerning,considering,contrary to,counting,cum,depending on,despite,due to,except,except for,excepting,excluding,given,in addition to,in case of,in face of,in favor of,in light of,inspite of,in view of,including,instead of,less,like,not with standing,on account of,on behalf of,other than,owing to,pending,per,plus,preparatory to,pro,re,regarding,regardless of,save,save for,saving,than,thanks to,unlike,versus,with reference to,with regard to,worth";
        // $notUsefulChar = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";

        $pronouns = "";
        $helpingverbs = "";
        $prepositions =  "";
        $notUsefulChar = "";
        $regx = "/[^a-z| |^A-Z|]|[']/";
        $spacecleaningregx = "/ {2,}/";
        $regxAppliedText = preg_replace($regx, '', $text);
        $regxAppliedText = preg_replace($spacecleaningregx, ' ', $regxAppliedText);
        $regxAppliedText = strtolower($regxAppliedText);
        $implodedText = str_replace(array(' '), ",", $regxAppliedText);
        $implodedTextarry = explode(',', $implodedText);
        $implodedTextarrayandunique = array_unique($implodedTextarry);
        $pronounsarray = explode(',', $pronouns);
        $helpingverbsarray = explode(',', $helpingverbs);
        $prepositionsarray = explode(',', $prepositions);
        $finalCleanArray = array_values(array_diff($implodedTextarrayandunique, $helpingverbsarray, $pronounsarray, $prepositionsarray));

        return $finalCleanArray;

    }

    public function makescore($finalCleanArray){

        $alldata = array();
        $scoredArray = array('positivescore' => 0, 'negativescore' => 0, 'average' => 0);
        $index = 0;

        foreach ($finalCleanArray as $key => $value) {

            if ($value != '' || $value != ' ') {


                /**Below: This code is for searching from Sentiword database */
                    $word ='"'.$value.'"';
                    DB::statement('CALL checkword('.$word.',@post,@neg,@avg)');
                    $scoresofsingle = DB::Select('select @post as positive, @neg as negative');
                    if (count($scoresofsingle) > 0) {
                            $alldata[$index] = $scoresofsingle[0];
                            $scoredArray['positivescore'] += $scoresofsingle[0]->positive;
                            $scoredArray['negativescore'] += $scoresofsingle[0]->negative;
                            // $scoredArray['average'] += $scoresofsingle[0]->average;
                        }
                /**Above: This code is for searching from sentiword database */


                $index++;

            }

        }

        $averagescore = $scoredArray['positivescore'] - $scoredArray['negativescore'];

        $scoredArray['compound'] = $averagescore;

        return $scoredArray;

       
    }
    public function sentimentsense($score){
        $sentiment = '';
        if ($score < 0) {
            $sentiment = "Bad";

        } elseif ($score >= 0 && $score < 1) {
            $sentiment = "Neutral";

        } elseif ($score >= 1) {
            $sentiment = "Good";

        }
        return $sentiment;
    }
}

     
 
 ?>
