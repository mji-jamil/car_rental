<nav class="navbar sticky-top shadow-sm navbar-expand-lg navbar-light py-2">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
            <img class="img-fluid" src="{{asset('/images/car-logo.jpg')}}" alt="" width="96px">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header01"
                aria-controls="header01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="header01">
            <ul class="navbar-nav ms-auto">
                @if(Cookie::has('token'))
                    <li class="nav-item me-4"><a class="btn btn-outline-danger" href="{{ url('/logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item me-4"><a class="btn btn-outline-primary" href="{{url('/userLogin')}}">Login</a>
                    </li>
                @endif
                <li class="nav-item"><a class="btn btn-outline-primary" href="{{url('/rentals')}}">Rentals</a></li>
            </ul>
        </div>
    </div>
</nav>
