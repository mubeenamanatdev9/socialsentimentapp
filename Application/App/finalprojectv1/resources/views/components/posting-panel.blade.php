<form action="/postnow/{{ session('id') }}" method="post">
    @csrf

    <div class="card border-transparent mb-3 p-3" style="width: 100%; ">
        <div class="card-header header-css  border-success d-md-flex justify-content-between">
            <div class="img">
                <img src="{{asset($profileimage)}}" alt="" class="imageby">
            </div>
            <div class="details">
                <div class="postimagestyle"></div>
                <div class="text-white text-capitalize"><b>{{$name}}</b></div>
                <div class="text-white"><?php 
                
                  echo date("d-m-Y") . " " . date('l');   
                 
                 ?></div>
                <hr class="bg-danger">

            </div>
        </div>
        <div class=" d-flex justify-content-around align-items-baseline">
            <input type="text" class="subjectarea w-75" placeholder="Subject" name="subject" required>
            <input type="text" class="subjectarea w-25 border-left" placeholder="Topic / Category" name="category" required>

        </div>
        <textarea name="userpost" id="user_post" class="postarea"
            placeholder="Type Your interset here. we will show to the world! Hurry" required></textarea>
        <input type="image" class="imgprew" src="" alt="" hidden>
        <div class=" d-flex justify-content-center align-items-center mt-2">


            <button class="btn btn-transparent btn-danger w-75 brzero" type="submit" data-toggle="collapse"
                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-comments"></i> Post Now </button>


           {{--roug --}}
        </div>


    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</form>


