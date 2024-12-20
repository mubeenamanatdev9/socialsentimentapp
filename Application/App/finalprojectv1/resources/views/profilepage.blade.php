<x-headbody title="profile" backgroundimage="" >
    <x-header :profileimage="$pdata['imagepath']" />
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-3 d-flex flex-column justify-content-center align-items-start p-1 profileimagecontainer"
                style="background-color:white; height: 300px;" onclick="uploadfile()">

                <img src="{{ asset($pdata['imagepath']) }}" alt="" id="profileimg" class="profileimage">
                <img src="./images/uploadimage.svg" alt="" id="addimage" class="add_image"
                    style="width: 100px; height:100px; display:none;">
            </div>

            <div class="col-9 d-flex flex-column justify-content-around text-white"
                style="background-color: black; opacity:1;">
                <p class="fontstyle">@isset($pdata['fname']){{ $pdata['fname'] }}@endisset</p>
                    <p class="fontstyle text-lowercase">@isset($pdata['email']){{ $pdata['email'] }}@endisset</p>
                        <p class="fontstyle">@isset($pdata['occupation']){{ $pdata['occupation'] }}@endisset</p>
                            <p class="fontstyle">@isset($pdata['phonenumber']){{ $pdata['phonenumber'] }} @endisset</p>
                            <p class="fontstyle">@isset($pdata['dataofbirth']){{ $pdata['dataofbirth'] }} years Old @endisset
                            </p>
                        </div>

                    </div>

                    <div class="row activitysection text-white  text-center">
                        <div class="col-4 bg-info d-flex justify-content-center align-items-center flex-column">
                            <div>Total Post made</div>
                            <div class="mr-1">@isset($pdata['totalpost']){{ $pdata['totalpost'] }} @endisset</div>
                        </div>

                        <div class="col-4 bg-secondary d-flex justify-content-center align-items-center flex-column">
                            <div>Total status made</div>
                            <div class="mr-1">@isset($pdata['totalstatus']){{ $pdata['totalstatus'] }} @endisset</div>
                        </div>
                        <div class="col-4 bg-success d-flex justify-content-center align-items-center flex-column">
                            <div>Total Posts likes</div>
                            <div class="mr-1">@isset($pdata['totalpostslike']){{ $pdata['totalpostslike'] }} @endisset
                            </div>
                        </div>
                    </div>


                    <div class="updateprofile mt-3">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4">Update Your Profile</h1>
                                <p class="lead">You can update your profile from here</p>
                            </div>
                        </div>
                        <form class="row mt-3 p-md-5" action="" id="updateform" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Full Name</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="FULL NAME"
                                        value="{{ $pdata['fname'] }}">

                                </div>
                                <div class="form-group">
                                    <label for="useremail">Email address</label>
                                    <input type="email" class="form-control" id="useremail" name="emailaddress"
                                    placeholder="Email Must contain @"  aria-describedby="emailHelp" placeholder="Enter email" value="{{ $pdata['email'] }}">

                                </div>

                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="userpassword" placeholder="Password"
                                    placeholder="Password must between 4 - 10"  value="{{ $pdata['password'] }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userage">Date of birth</label>
                                    <input type="date" class="form-control" name="dateofbirth" id="userage" placeholder="Age"
                                        value="{{ $pdata['dob'] }}">
                                </div>

                                <div class="form-group">
                                    <label for="usernumber">Contact Number</label>
                                    <input type="number" class="form-control" id="usernumber" placeholder="Contact Number" min="7"
                                    placeholder="Contact Number e.g. 0300-1234567"  maxlength="11" name="contactnumber" value="{{ $pdata['phonenumber'] }}">
                                </div>
                                <div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary w-50">Update</button>

                        </form>

                        <form action="{{ url('store') }}" method="POST" class="imageforms bg-info" id="imageform"
                            enctype="multipart/form-data">
                            <div class="form-group d-flex" style="height:400px">
                                <div class="bg-success col-sm-4">
                                    <div for="user_profile_image" class="text-center bg-dark text-white mt-3  p-1">Update Image</div>
                                    <input type="file" class="form-control-file mt-3" name="image" id="user_profile_image"
                                        placeholder="My profile Image" accept="image/*" onchange="validateImage(event)">
                                    <button class="btn btn-danger align-self-center mt-3" type="submit" id="uploadimagenow">Upload Profile
                                        Image</button>
                                </div>

                                <div class="container bg-dark col-sm-8 d-flex justify-content-center align-items-center p-3">
                                    <div id="result" class="align-center ">

                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>

                <script>
                    $(function() {

                        $('#user_profile_image').on('change', function() {
                            var imgpath = this.value;
                            $("#imgpreview").attr('src', imgpath);
                        });


                        $('.profileimagecontainer').hover(function() {
                            $("#addimage").css({
                                "display": "initial",
                                "width": "200px",
                                "height": "200px",
                                "transition": "width 1s",
                                "transition": "height 1s",


                            });
                            $("#profileimg").css({
                                opacity: 0.3,
                            });
                        }, function() {
                            $("#addimage").css({

                                "width": "initial",
                                "height": "initial",
                                "display": 'none'
                            });
                            $("#profileimg").css({
                                    "opacity": "1",

                                }

                            );
                        })


                    });
                </script>

                <script>
                    var x = 1;

                    function validateImage(event) {
                        document.getElementById('result').innerHTML = '';
                        if (x == 2) {
                            document.getElementById('output').remove();
                            x = 1;
                        }
                        var image = document.getElementById('user_profile_image');
                        var filename = image.value;
                        if (filename != '') {
                            var extdot = filename.lastIndexOf(".") + 1;
                            var ext = filename.substr(extdot, filename.lenght).toLowerCase();
                            if (ext == "jpg" || ext == "png") {
                                x = 2;
                                var output = document.createElement('img');
                                var result = document.getElementById('result');
                                output.id = 'outputimagexy';
                                output.name = 'outputimage';
                                output.style = 'max-width:1000px; max-height:400px;';
                                output.src = URL.createObjectURL(event.target.files[0]);
                                result.after(output);
                            } else {
                                document.getElementById('result').innerHTML = 'Please select only jpg and png file';
                            }
                        }
                    }
                </script>

                <script>
                    function uploadfile() {
                        var elementToView = document.getElementById("imageform");
                        elementToView.scrollIntoView();
                    }
                </script>
            </x-headbody>
