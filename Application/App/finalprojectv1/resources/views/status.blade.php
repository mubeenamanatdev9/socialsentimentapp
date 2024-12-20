<x-headbody title="status" backgroundimage="">
   
    <div class="container-fluid">
<a href="{{url('/')}}" class="btn  btn-primary br-zero mt-2 "> < Back to Home</a>
        <div class="row mt-4" style="height:500px">
            <div class="col-sm-6">
                <p class="text-center bg-dark p-3 text-white">Update Your Status</p>
                <form action="{{url('updatestatus')}}" method="POST"  class="imageforms bg-info" id="imageform"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group d-flex" style="height:400px">
                                <div  class="bg-success col-sm-8 p-4">
                                    <textarea id="w3review" name="statusdetails" class="w-100 h-75 p-1 br-zero" placeholder="Update Your status here! Type Anything You Desire" style="outline:none; border:none"></textarea>
                                       
                                        <div class="row d-flex justify-content-center">

                                            <input type="file" class="form-control-file mt-3 w-50" name="image" id="user_profile_image"
                                                placeholder="My profile Image" accept="image/*" onchange="validateImage(event)">
                                            <button class="btn btn-primary mt-3" type="submit" id="uploadimagenow">Update Status</button>
                                        </div>
                                </div> 
    
                                <div class="container bg-dark col-sm-4 d-flex justify-content-center align-items-center p-3" >
                                    <div id="result" class="align-center ">
    
                                    </div>
                                </div>
                    </div>
                            
    
                </form>
            </div>

            <div class="col-sm-6">
                <p class="text-center bg-dark text-white p-3">Your Current Status</p>
                <div class="card w-100 p-1 mb-3 mt-1" >
                    <img class="card-img-top" src="{{asset($currentstatus[0]->image)}}" alt="Card image" style="max-width:100%; max-height:250px;">
                    <div class="card-body">
                        <div class="p-2" style="background-color: #D7D7FF; border-radius: 5px;">
                        <h5 class="card-title text-capitalize text-center">{{$currentstatus[0]->name}}</h5>
                        <p class="card-text text-center small">{{$currentstatus[0]->updated_at}}</p>
                        </div>
                        <p class="card-text p-2 mt-1" style="background-color: #FFD7D7; border-radius: 5px;">{{$currentstatus[0]->description}}</p>
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-info p-5 text-center">All Status Are Shown Here </div>
        <div class="row container-fluid" style="height: 300px">

            @foreach ($allstatus as $items)
                
           
            <div class="col-sm-4 mt-3" style="height: 450px max-height:600px">
                <div class="card w-100 h-100 p-1 mb-3 mt-1" >
                    <img class="card-img-top align-self-center" src="{{asset($items->image)}}" alt="Card image" style="width:300px; max-height:300px">
                    <div class="card-body d-flex flex-column justify-content-end">
                        <div class="p-2" style="background-color: #D7D7FF; border-radius: 5px;">
                            <h5 class="card-title text-capitalize text-center" >{{ $items->name}}</h5>
                            <p class="card-text text-center small"> <i> {{$items->updated_at}} </i></p>

                        </div>
                        <p class="card-text p-2 mt-1" style="background-color: #FFD7D7; border-radius: 5px;">{{ $items->description}}</p>
                        
                    </div>
                </div>
            </div>

            @endforeach
        
            <div class="row align-self-end mt-4 mx-auto">
                {{$allstatus->links()}}
            </div>

        </div>
        
       
    </div>

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
                    output.style = 'max-width:100%; max-height:400px;';
                    output.src = URL.createObjectURL(event.target.files[0]);
                    result.after(output);
                } else {
                    document.getElementById('result').innerHTML = 'Please select only jpg and png file';
                }
            }
        }

         
    </script>


</x-headbody>