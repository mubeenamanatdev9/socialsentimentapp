<div class="card border-success mb-3 w-100" >
    <div class="card-header bg-transparent border-success d-md-flex justify-content-between">
        <div class="img">
            <img src="{{asset($imgofuserwhosepost)}}" alt="" class="imagebypost">
        </div>
        <div class="details">
            <div class="postimagestyle"></div>
            <div class="text-capitalize"><b>{{ $username }}</b></div>
            <div>{{ $createdat }}</div>
            <hr>

        </div>
    </div>
    <div class="card-body text-success">
        <h6 class="card-title p-2 badge badge-info text-capitalize">{{ $category }}</h6>
        <h4 class="firstlettercap">{{ $subject }}</h4>
        <div class="postimagestyle"></div>
        <p class="card-text text-dark firstlettercap p-1" style="background-color:rgb(250, 245, 245); border-radius:3px">{{ $postcontent }}</p>
    </div>
    <div class="card-footer bg-transparent border-success">
        <div class="likeshareinfo d-flex justify-content-around  ">
            <p class="likes"><span id="totallikes_{{$postid}}">{{$totallikes}}</span> Likes</p>
            <p class="shares"><span id="totalcomments_{{$postid}}">{{$totalcomments}}</span> Comments</p>
            <p class="ratings">Rating: {{$ratings}}
        </div>

        <div class="likesharebtns d-flex justify-content-around align-items-baseline mt-2">

            <button class="btn btn-transparent btn-danger w-100 brzero likebtn " id='{{$postid}}'
                onclick="liked(this.id,{{session('id')}})" isliked={{ $isliked }}>
                <span id="likecolorid_{{$postid}}" style="<?php
                    if ($isliked == true) {
                        echo 'color: rgb(142, 142, 255);';
                    } else {
                        echo 'color: white;';
                    } ?>">
                    <i class="fas fa-thumbs-up"></i>
                </span>
                Like</button>


            <button class="btn btn-transparent btn-dark w-100 brzero cmt-btn" id='commentid_{{ $postid }}'
                onclick="commentsload({{ $postid }})" type="button" data-toggle="collapse"
                data-target="#target{{ $postid }}" aria-expanded="true" aria-controls="collapseExample"><i
                    class="fas fa-comments"></i> Comment</button>

            <button class="btn btn-transparent btn-info w-100 brzero cmt-btn" >{{$sentiment}}</button>


            


        </div>
        <div class="collapse mt-3 bbb" id="target{{ $postid }}">
            <div class="d-flex justify-content-around mt-3 mb-3">
                <img src="{{asset($currentuserimage)}}" alt="" class="imagebycomment">
                <input type="text" class="commenttype commentfield" id='commentpostid_{{ $postid }}'
                    placeholder="Comment Here! Press Enter" style="width: 90%;">
                <span><button class="commentsendbtn" type="submit" id="{{ $postid }}"
                        onclick="submitcomment(this.id,{{ session('id') }})">
                        <i class="fas fa-paper-plane p-2" style="color: rgb(142, 142, 255); "></i>
                    </button>
                </span>
            </div>
            <div class="d-flex" id='commentnamesectionfor{{ $postid }}'>


                <div class="postedby ml-5">
                    <p class="commentsection d-flex flex-column">

                    </p>
                </div>

                <div class="comment ml-5">
                    <p class="commentercomment d-flex flex-column"></p>
                </div>



            </div>

        </div>
    </div>
</div>

<script>
    function submitcomment($postid, $user) {

        comment = $('#commentpostid_' + $postid).val();
        $.ajax({
            method: 'GET',
            url: 'addcomment/' + $user,
            data: {
                comment: comment,
                postid: $postid
            },
            success: function(response) {
                if (response) {
                    commentsload($postid);
                    getcommentcount($postid);
                    generateanalysis(response);
                    
                    $('#commentpostid_' + $postid).val('');
                }
            }
        });

    }
    function getcommentcount($postid){
        $.ajax({
            method: 'GET',
            url: 'getcommentscount' ,
            data: {
                postid: $postid,

            },
            success: function(response){
           
                document.getElementById('totalcomments_'+ $postid ).innerHTML = response.totalcomments;
            }
            

        });
    }

    function generateanalysis(id){

        $.ajax({
            method: 'GET',
            url: 'analyizenow/',
            data: {
                commentid: id,
                
            }, success:function(response){
                if(response=="analysissaved"){
                    
                    location.reload();
                }
            }
          
        });
    }

    function liked($postid, $userid) {

        document.getElementById('likecolorid_'+$postid).style = 'color:rgb(142, 142, 255);';
        $.ajax({
            method: 'GET',
            url: 'likeme/' + $userid,
            data: {
                postid: $postid,

            },
            success: function(response){
        
                likeordislikeload($userid,$postid);
            
            }
        });

    }

    function likeordislikeload($userid,$postid){
        $.ajax({
            method: 'GET',
            url: 'getlikes' ,
            data: {
                postid: $postid,

            },
            success: function(response){
               
                document.getElementById('totallikes_'+ $postid ).innerHTML = response.totallikes;
            }
            

        });
    }


    function commentsload(postid) {

        var selector = $('.cmt-btn').attr('aria-expanded');


        if (selector) {

            $.ajax({
                method: 'GET',
                url: 'index/topiccomments/' + postid,
                success: function(response) {
                    data = (JSON.parse(response));

                    var commentsec = $('#commentnamesectionfor' + postid);
                    commentsec.find('.commentsection').empty();
                    commentsec.find('.commentercomment').empty();
                    data.forEach(element => {

                        commentsec.find('.commentsection').append("<b>" + element.name + "</b>");
                        commentsec.find('.commentercomment').append("<i>" + element.comments +
                            "</i>");


                    });
                }
            });
        }


    }

    // function commento($id) {

    //     $(this).on('change', function() {
    //         $(this).on('keypress', function(e) {
    //             if (e.which == 13) {
    //                 alert('You pressed enter!');
    //             }
    //         });
    //     });

    // }
</script>
