<nav class="navbar navbar-dark bg-dark d-md-flex justify-content-center w-100 ">
    <!-- Navbar content -->
    
        <a class="applogo d-md-flex mr-auto w-25" href="{{url('/index')}}" >
            Social App 
        </a>
    
    
    <form class="form-inline  w-50" method="GET" action="{{url('searchpost')}}">
        <!-- <input class="form-control ml-auto mr-auto mr-sm-2 brzero searchbar" list="categorysearch" name="postcategoryname" type="search" id="ftsearch" placeholder="Search" aria-label="Search"
            style="width: 75%;"> -->
            <!-- <datalist id="categorysearch" class="w-100" style="width:100%"></datalist> -->
            <select class="js-example-basic-multiple " style="width:75%;" name="states[]" multiple="multiple" id="categorysearch">
  <!-- <option value="AL">Alabama</option>
    ...
  <option value="WY">Wyoming</option> -->
    </select>
        <button class="btn btn-outline-success my-2 my-sm-0 brzero" id="searchbtn" type="submit">Search</button>
        
    </form>

   <!-- <form class="form-inline  w-50" method="GET" action="{{url('searchpost')}}">
    <select class="js-example-basic-multiple " style="width:75%;" name="states[]" multiple="multiple" id="categorysearch">
  <!-- <option value="AL">Alabama</option>
    ...
  <option value="WY">Wyoming</option> -->
    <!-- </select>
    </form> -->

    <div class="d-flex ml-auto justify-content-end align-items-center w-25" >
        <div class="dropdown">
            
          <a href="{{url('./profile')}}"><img src="{{asset($profileimage)}}"  class="lgpimage" alt=""></a>  
          <a href="{{url('./profile')}}"><span class="lgpname text-capitalize">{{session('name')}}</span></a>  
            <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 50%">

            </button>
            <div class="dropdown-menu dropleft wifdrop w-100 mt-2 " aria-labelledby="dropdownMenuButton">
              @if (session('isadmin')=="admin")
              <a class='dropdown-item settings' href="{{url('./dashboard')}}">Dasboard</a>
              @endif
                    
                <a class="dropdown-item profile" href="{{url('./profile')}}">Profile</a>
                <a class="dropdown-item logout" href="{{url('/logout')}}">Logout</a>
            </div>
        </div>
    </div>


</nav>


<script>


document.getElementById('categorysearch').onkeyup = async function nana() {
console.log("hello");
var element = await document.getElementById('categorysearch').value;
console.log(`${'searchbycate/'+ element}`);
if (element != '') {
    let url = "searchbycate/" + element;
    async function fetchText() {

        let response = await fetch(url, {
            method: 'GET'
        });
        let data = await response.text();

        document.getElementById('categorysearch').innerHTML = data;

    }

    fetchText();
}

}
   
</script>


<script>
    // alert('jsworking');
    $(document).ready(
        // alert("dd");
       async function searchbardata(params) {
            // alert('dd');
            let url = 'fetchdata';
            let response = await  fetch(url,{method:'get'});
            let data = await response.text();
            // console.log(data);
            document.getElementById('categorysearch').innerHTML = data;
        }
    )
</script>

