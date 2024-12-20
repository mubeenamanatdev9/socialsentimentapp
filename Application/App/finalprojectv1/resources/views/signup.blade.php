<x-headbody title="signup" backgroundimage="{{asset('/images/logbackground.jpg')}}">
    <style>
        .body {
            background-image: url(./images/loginPageBackground.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;

        }

        .border-zero {
            border-radius: 0;
        }

        input {
            opacity: 0.6;
            color: red;
            font-weight: 500;

        }

    </style>

        <div class="container vh-100  d-flex align-items-center justify-content-center ">
            <div class="border border-danger w-50 p-3" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 5px;">

                <div class="col text-white">
                    <form action="" method="POST">
                        @csrf
                        <h2 class="text-center" style="border-bottom:1px solid white; padding: 10px;"> <span
                                class="text-danger">Sign</span><span style="color: orange;">Up</span></h2>

                        <div class="form-group">
                            <span style="font-size: 1.2em; color:orange">
                                <i class="fas fa-users" aria-hidden="true"></i </span>
                                <label for="fname" class="text-white  " style="letter-spacing: 2px;">Full Name:</label>
                                <input type="text" required placeholder="Full Name Required"
                                    class="form-control border-zero inputbgcolor" onclick="fontprops(this)" id="fname"
                                    name="name">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 1.2em; color:orange">
                                <i class="far fa-envelope" aria-hidden="true"></i>
                            </span>
                            <label for="email" class="text-white  " style="letter-spacing: 2px;">Email
                                Address:</label>
                            <input type="email" required name="email" placeholder="Email Required"
                                class="form-control border-zero" onclick="fontprops(this)" id="email">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 1.2em; color:orange">
                                <i class="fas fa-key" aria-hidden="true"></i>
                            </span>
                            <label for="password" class="text-white" style="letter-spacing: 2px;">Password:</label>
                            <input type="password" required name="password"
                                placeholder="Password Must be 4-10 character long" class="form-control border-zero"
                                id="password">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 1.2em; color:orange">
                                <i class="fas fa-key" aria-hidden="true"></i>
                            </span>
                            <label for="cpassword" class="text-white" style="letter-spacing: 2px;"">Confirm Password:</label>
                            <input type="password" required name="confirmpassword"
                                placeholder="Password Must be 4-10 character long" class="form-control border-zero"
                                id="cpassword">
                        </div>
                        <div class="checkbox text-white">
                            <label><input type="checkbox" name="confirmation" required> You are hereby agree with our
                                all <a href="#" style="text-decoration: none;">Terms & Conditions</a></label>
                        </div>

                        <button type="submit" onclick="getvalue()"
                            class="btn btn-default text-white bg-success w-100 mt-3 mb-3" style="border-radius: 0;"
                            id="signupbtn">Sign up</button>


                    </form>
                </div>


                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul style="list-style-type: none">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
       
</x-headbody>
