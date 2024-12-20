
    <x-headbody title="dashboard" backgroundimage="">
   
    <body>
        <div>
        <div class="container-fluid w-100 bg-dark p-4 text-white text-center">
            <h3 class="text-white">Dashboard</h3>
        </div>
    
        <br>
    
        <div class="" style="height: 400px">
    
    
            <div class="container-fluid ">
                <table class="table p-2 mt-4 ">
                    <thead class="bg-secondary text-white">
                        
                        <td>Category</td>
                        <td>Rating</td>
                        <td>Analysiss</td>
                    </thead>
                    <tbody>
                        @foreach ($allpostlistdata as $values)
    
                            <tr id="dashboardanalysisvalues">
    
    
                                <td>{{ $values->category }}</td>
                                <td>{{ $values->scored }}</td>
                                <td>{{ $values->sentiment }}</td>  
                                
    
    
                            </tr>
    
    
                        @endforeach
    
    
    
                    </tbody>
    
    
                </table>
                {{ $allpostlistdata->links() }}
            </div>
        </div>

        {{-- Add post analysis --}}
        {{-- <div style="height: 400px">
    
            <div class="d-flex justify-content-around mx-auto p-2 " style="background-color:#cc99ff">
                <div> <strong>Analysis Status: </strong>
                    <span id="analysisfunStatus">
    
                    </span>
                </div>
                <div> <strong>Date: </strong>
                    <span id="postdate">
    
                    </span>
    
                </div>
                <div> <strong>Category: </strong>
                    <span id="postcategory">
    
                    </span>
    
                </div>
            </div>
            <div class="container-fluid bg-primary h-100 d-flex p-3 row">
                <div class="col-sm-6">
    
                    <div class="postcontent text-justify p-3" id="postdetails">
    
                    </div>
    
                </div>
    
                <div class="col-sm-6 table">
                    <table class="w-100">
                        <thead>
                            <td class="bg-dark text-white" id="posScorehead">Positive</td>
                            <td class="bg-dark text-white" id="negScorehead">Negative</td>
                            <td class="bg-dark text-white" id="avgScorehead">Average</td>
                            <td class="bg-dark text-white" id="Sentimenthead">Sentiment</td>
                        </thead>
                        <tbody>
                            <td id="posScore">
    
                            </td>
                            <td id="negScore">
    
                            </td>
                            <td id="avgScore">
    
                            </td>
                            <td id="Sentiment">
    
                            </td>
                        </tbody>
                    </table>
                </div>
    
            </div>
        </div>
    
    
        <div class="bg-grey" style="background-color:#dbdbff">
    
            <table class="table">
                <thead class="bg-dark text-white">
                    <td>No.</td>
                    <td>Comments</td>
                    <td>Comment Actions</td>
                    <td>Score</td>
                </thead>
                <tbody id="postanalysisdetails">
    
                </tbody>
            </table>
            
        </div> --}}
    
    
    
        {{-- add keyword module --}}
        
       
        <div class="container-fluid bg-success p-5" >
            <form action="{{ url('addkeywords') }}" method="GET">
                @csrf
                <div class="d-flex justify-content-around">
                    <div class="form-group">
                        <label for="keyword">Keyword</label>
                        <input type="text" placeholder="keyword" class="form-control w-100" name="keyword" id="keyword"
                            required>
                        <small>Please Avoid wrong words</small>
                    </div>
                    <div class="form-group">
                        <label for="positivescore">Positive Score</label>
                        <input type="number" placeholder="0.01" class="form-control" name="positivevalue"
                            id="positivescore" required max="1" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="negativescore">Negative Score</label>
                        <input type="number" placeholder="0.01" class="form-control" name="negativevalue"
                            id="negativescore" required max="1" min="0" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="pos">POS(Noun/Verb/Adjective)</label>
                        <input type="text" placeholder="n/v/a" class="form-control" name="pos"
                            id="pos" required  >
                    </div>
                    <div class="form-group">
                        <label for="glossary">Glossary</label>
                        <input type="text" placeholder="Gloss" class="form-control w-100" name="glossary"
                            id="glossary" required >
                    </div>
    
                </div>
    
                <div class="form-group d-flex justify-content-center ">
                    <button class="btn btn-dark w-25">Add Keyword</button>
                </div>
                <?php $message = null; ?>
                <div class="<?php if ($message == 'success') {
                        echo 'alert alert-success';
                    } elseif ($message == 'notsuccess') {
                    echo 'alert alert-danger';
                    } ?>">
                    <?php
                    
                    if ($message == 'success') {
                        echo '<strong>Success!</strong> Record has been added successfully.';
                    } elseif ($message == 'notsuccess') {
                        echo '<strong>Error!</strong> Some error has occurred.';
                    }
                    
                    ?>
                </div>
    
            </form>
        </div>
    
        <script>
            async function analyizerone(id) {
    
                await fetchpostdata(id);
                await selectedpostcomments(id);
    
                document.getElementById('analysisfunStatus').innerHTML = "Pending... ! Please Wait";
                document.getElementById('posScore').innerHTML = "Pending...";
                document.getElementById('negScore').innerHTML = "Pending...";
                document.getElementById('avgScore').innerHTML = "Pending...";
                document.getElementById("Sentiment").innerHTML = "Pending...";
    
                let url = 'getanalysis';
    
                let posting = await fetch(url, {
    
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        //  "X-CSRF-TOKEN": token
                    },
                    method: 'POST',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        postid: id,
                    })
                });
    
    
    
    
                let responsePost = await posting.text();
                let data = await JSON.parse(responsePost);
    
    
                document.getElementById('posScore').innerHTML = data.positivescore;
                document.getElementById('negScore').innerHTML = data.negativescore;
                document.getElementById('avgScore').innerHTML = data.compound;
                let sentimenttag = document.getElementById("Sentimenthead");
    
                if (data.compound >= 0.125) {
                    sentimenttag.className = "bg-success";
                    document.getElementById("Sentiment").innerHTML = "Good";
                } else if (data.compound <= 0.01) {
                    sentimenttag.className = "bg-danger";
                    document.getElementById("Sentiment").innerHTML = "BAD";
                } else {
                    sentimenttag.className = "bg-info";
                    document.getElementById("Sentiment").innerHTML = "Neutral";
                }
    
                if (posting.ok == true) {
                    document.getElementById('analysisfunStatus').innerHTML = "Success! Thank You For Bearing With Us";
                    document.getElementById('analysisfunStatus').className = "bg-success text-white";
                }
    
    
            }
    
            async function fetchpostdata(id) {
                let url = 'fetchspecificpost/' + id;
                let posting = await fetch(url, {
    
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                       },
                    method: 'GET',
                    credentials: "same-origin",
                });
    
                let responsePost = await posting.text();
                data = JSON.parse(responsePost);
    
                document.getElementById('postdate').innerHTML = data.date;
                document.getElementById('postcategory').innerHTML = data.category;
                document.getElementById('postdetails').innerHTML = data.topic_details;
    
            }
    
            async function selectedpostcomments(id) {
    
                let url = 'commentsofselectedpost/' + id;
        
                let comments = await fetch(url, {
    
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                      
                    },
                    method: 'GET',
                    credentials: "same-origin",
                });
    
                let commentsresponse = await comments.json();
                let elements = "";
                let index = 0;
                let idassigner = 0;
         
                commentsresponse.data.forEach(element => {
                   
                    index++;
                    idassigner = index;
                    elements +=
                        "<tr>" +
                        "<td>" + index + "</td>" +
                        "<td>" + element + "</td>" +
                        "<td><button class='btn btn-info' id='" + --idassigner +"' onclick='analyizertwo(this.id," + id +")'>Analyze</button>" + "</td>" +
                        "<td class='d-flex justify-content-between' id='="+index+"'>" +
                        "<div class='d-flex justify-content-center flex-column align-items-center'>Neg <strong id='negativescore_"+index+"'></strong>  </div>" +
                        " <div class='d-flex justify-content-center flex-column align-items-center'>Pos <strong id='positivescore_"+index+"'></strong> </div>" +
                        " <div class='d-flex justify-content-center flex-column align-items-center'>Avg <strong id='averagescore_"+index+"'></strong> </div>" +
                        " <div class='d-flex justify-content-center flex-column align-items-center'>sentiment <strong id='sentiment_"+index+"'></strong> </div>" +
                        " </td>" +
                        "</tr>";
    
                });
                document.getElementById('postanalysisdetails').innerHTML = elements;
            }
    
            async function analyizertwo(commentid, postid) {
                
                let indexid = commentid;
                indexid++;
               
                let url = 'getindividualcommentanalysis/' + commentid + "/" + postid;
    
                let comments = await fetch(url, {
    
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    method: 'GET',
                    credentials: "same-origin",
                });
    
                let commentsresponse = await comments.json();
    
                document.getElementById('negativescore_'+indexid).innerHTML = commentsresponse.positivescore;
                document.getElementById('positivescore_'+indexid).innerHTML = commentsresponse.negativescore;
                document.getElementById('averagescore_'+indexid).innerHTML = commentsresponse.compound;
            
    
                if (data.compound >= 0.125) {
                    
                    document.getElementById("sentiment_" + indexid).innerHTML = "Good";
                } else if (data.compound <= 0.01) {
                    
                    document.getElementById("sentiment_" + indexid).innerHTML = "BAD";
                } else {
                   
                    document.getElementById("sentiment_" + indexid).innerHTML = "Neutral";
                }
                
    
            }
        </script>

             
    </x-headbody>
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    
    </body>
    
    </html> --}}



