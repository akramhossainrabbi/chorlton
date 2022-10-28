
<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a class="navbar-brand" href="{{url('home')}}"><img src="{{url('upload/logo/'.$Seo->site_logo)}}" /></a><br>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('home')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item {{ Request::path() == 'order-item' ? 'selected' : '' }}">
                <a class="nav-link" href="{{url('order-item')}}">Online Order (Chorlton)</a>
            </li>
            <li class="nav-item {{ Request::path() == 'table-booking' ? 'selected' : '' }}">
                <a class="nav-link" href="{{url('table-booking')}}">Reservation</a>
            </li>
            <li class="nav-item {{ Request::path() == 'contact-us' ? 'selected' : '' }}">
              <a class="nav-link" href="{{url('contact-us')}}">Contact Us</a>
            </li>
            @if(Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{url('user/dashboard')}}"><i class="fa fa-user"></i> Profile</a></li>
                <li><a class="logoutFront nav-link" href="javascript:void(0);">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                </li>
                <div style=" height: 0px; width: 0px; opacity: 0px;">
                    <form method="post" style="opacity: 0px;" id="logoutFront" action="{{url('logout')}}" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" style="height: 0px; width: 0px; background: none; opacity: 0px;" class="btn"></button>
                    </form> 
                </div>
            @else
                <li class="nav-item"><a class="nav-link" href="{{url('new-account')}}"><i class="fa fa-user"></i> Register</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('user-login')}}"><i class="fa fa-unlock-alt"></i> Login</a></li>
            @endif
        </ul>
</div>
      
      
      
      
      
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('home')}}"><img src="{{url('upload/logo/'.$Seo->site_logo)}}" /></a><br>
            
        <span style="font-size:30px;cursor:pointer" onclick="openNav()" class="mobile-men">&#9776;</span>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('home')}}">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item {{ Request::path() == 'order-item' ? 'selected' : '' }}">
              <a class="nav-link" href="{{url('order-item')}}">Online Order (Chorlton)</a>
            </li>
            <li class="nav-item {{ Request::path() == 'table-booking' ? 'selected' : '' }}">
                <a class="nav-link" href="{{url('table-booking')}}">Reservation</a>
            </li>
            <li class="nav-item {{ Request::path() == 'contact-us' ? 'selected' : '' }}">
                <a class="nav-link" href="{{url('contact-us')}}">Contact Us</a>
            </li>
            @if(Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{url('user/dashboard')}}"><i class="fa fa-user"></i> Profile</a></li>
                <li><a class="logoutFront nav-link" href="javascript:void(0);">
                        <i class="fa fa-lock"></i> Logout
                    </a>
                </li>
                <div style=" height: 0px; width: 0px; opacity: 0px;">
                    <form method="post" style="opacity: 0px;" id="logoutFront" action="{{url('logout')}}" >
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" style="height: 0px; width: 0px; background: none; opacity: 0px;" class="btn"></button>
                    </form> 
                </div>
            @else
                <li class="nav-item"><a class="nav-link" href="{{url('new-account')}}"><i class="fa fa-user"></i> Register</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('user-login')}}"><i class="fa fa-unlock-alt"></i> Login</a></li>
            @endif
                    
        </ul>   
    </div>
</nav>