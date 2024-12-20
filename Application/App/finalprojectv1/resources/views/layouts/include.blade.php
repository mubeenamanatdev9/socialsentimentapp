<x-headbody title="Social App" backgroundimage="">

    <div class="container-fluid" >

        <div class="row" style="position: sticky; top:0; z-index:1">
            <x-header :profileimage="$userdetails[0]->profileimage" />
        </div>

        <div class="row mt-4 pl-1 pr-1">

            <div class="col-sm-3">
                <x-sidebar />
            </div>

            <div class="col-sm-6">

                <x-posting-panel 
                    :name="$userdetails[0]->name" 
                    :profileimage="$userdetails[0]->profileimage" 
                />

                <div class="row postingArea p-3">

                    @foreach ($postsdata as $details)

                        <x-postbody 
                            :username="$details->name" 
                            :createdat="$details->created_at"
                            :category="$details->category" 
                            :subject="$details->subject"
                            :postcontent="$details->postcontent" 
                            :totallikes="$details->likes"
                            :totalcomments="$details->comments" 
                            :isliked="$details->isliked"
                            :postid="$details->postid" 
                            :currentuserimage="$userdetails[0]->profileimage"
                            :imgofuserwhosepost="$details->postuserimage"
                            :ratings="$details->scores"
                            :sentiment="$details->sentiment"
                        />

                    @endforeach

                    {{--   {{$postsdata->links()}} --}}

                </div>
            </div>


            <div class="col-sm-3 bg-dark" style="height: 100%">
                <x-status-area :statuslatest="$statuslatest" />
            </div>
        </div>
    </div>

    <div class="container-fluid bg-dark d-flex justify-content-center align-items-center" style="height: 80px">
        <p class="text-center text-white">Copy Right Reserved</p>
    </div>
</x-headbody>
