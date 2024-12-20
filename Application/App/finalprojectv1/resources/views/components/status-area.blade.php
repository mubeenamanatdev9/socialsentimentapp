
<div class="container-fluid pt-2 pb-4">
    
    
    @foreach ($statuslatest as $items)
        <div class="card w-100 h-100 p-1 mb-3 mt-1 " style="background-color: rgb(197, 183, 183)">
            <img class="card-img-top align-self-center" src="{{ asset($items->image) }}" alt="Card image"
                style="width:100%; max-height:250px">
            <div class="card-body d-flex flex-column justify-content-end">
                <div class="p-2 text-center text-capitalize" style="background-color: #e4e4fa; border-radius: 5px;">
                    <h4 class="card-title">{{ $items->name }}</h4>
                    {{-- <p class="card-text ">At: <i> {{ $items->updated_at }} </i></p> --}}

                </div>
                <p class="card-text p-2 mt-1 text-capitalize" style="background-color: #fceaea; border-radius: 5px;">
                    {{ $items->description }}</p>

            </div>
        </div>
    @endforeach

    <a href="{{url('status')}}" class="text-center align-self-center pb-4">See More Status</a>

</div>
