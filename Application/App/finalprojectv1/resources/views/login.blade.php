<x-headbody title="login" backgroundimage="{{asset('/images/logbackground.jpg')}}" >

    <div class="container vh-100  d-flex align-items-center justify-content-center">
        <div class="border border-danger w-50 p-3" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 5px;">
            <div class="col-sm-12 text-white">
                <form action="" method="POST">
                    @csrf
                    <h2 class="text-center" style="border-bottom:1px solid white; padding: 10px;"> <span
                            class="text-danger">Log</span><span style="color: orange;">In</span></h2>

                    <div class="form-group mt-4">
                        <span style="font-size: 1.2em; color:orange">
                            <i class="far fa-envelope" aria-hidden="true"></i>
                        </span>
                        <label for="email" class="text-white  " style="letter-spacing: 2px; font-size: 1.2em;">Email
                            Address:</label>
                        <input type="email" required class="form-control border-zero" placeholder="Email (must include @ sign)" id="email" name="email">
                    </div>
                    <div class="form-group mt-4">
                        <span style="font-size: 1.2em; color: orange">
                            <i class="fas fa-key" aria-hidden="true"></i>
                        </span>
                        <label for="pwd" class="text-white" style="letter-spacing: 2px; font-size: 1.2em;"">Password:</label>
                        <input type="password" required class="form-control border-zero" id="pwd" placeholder="Minimum 4 Characters" min="4" name="password">
                    </div>
                    <div class="d-flex flex-direction-row justify-content-between mt-4">

                        <button type="submit" class="btn btn-default text-danger bg-dark w-50 "
                            style="border-radius: 0;">Login</button>
                            
                      
                           <a href="{{url('signup')}}" class="btn btn-default text-white bg-success w-50"
                           style="border-radius: 0;">Sign up</a>
                      
                            

                    </div>
                </form>
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
    </div>

</x-headbody>