
<div>
    <ul class="nav flex-column border h-100 bg-dark pt-2 position-sticky" style="max-height: 700px">
        <li class="nav-item">
            <a class="nav-link active" href="{{url('index')}}">
                <i class="fas fa-rss-square"></i>
                <span class="pl-4 " >Feed</span>
                
            </a>
        </li>
        {{-- rough --}}
        <li class="nav-item">
            <a class="nav-link " href="{{url('./profile')}}"><i class="fas fa-users"></i> <span class="pl-4C">Profile</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{url('./status')}}"><i class="fas fa-th-large"></i> <span class="pl-4">Status</span> </a>
        </li>
    </ul>
</div>
