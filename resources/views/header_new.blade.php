<header id="header" class="header bg-white">
    <div class="container-fluid">
        <div class="row">
            <div class="header_enner_mn w-100">
                <div class="header_logo">
                    <a href="/"><img src="public/assets/images/site-logo.png" alt=""></a>
                </div>
                <div class="login_btn">
                    <div class="mobile_menu">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                    <ul>
                    @if(Auth::user())
                        @if(Auth::user()->is_admin != 0)
                        <li class="mobile_menu_close"><i class="fa fa-times" aria-hidden="true"></i></li>
                        @if(Auth::user()->is_admin == 1)
                        <li><a href="/dashboard">Dashboard</a></li>
                        <li><a href="/users">Users</a></li>
                        @endif
                        <li><a href="/products">Products</a></li>
                        <li><a href="/companies">Company</a></li>
                        <li><a href="/settings">Settings</a></li>
                        @endif
                        
                    @else
                    <li><button type="button" class="btn" data-toggle="modal" data-target="#login">Log in</button></li>
                    @endif
                    </ul>
                    @if(Auth::user())
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->profileimage != "")
                                <img src="public/assets/images/profileimage/{{ Auth::user()->profileimage }}" class="img-circle" width="30" height="30">
                            @else
                                <img src="{{ url('public/assets/images/profileimage/user2.png')}}" alt="user" class="" width="30" height="30">
                            @endif
                            <span class="hidden-md-down"> {{ Auth::user()->username }} &nbsp;<i class="fa fa-angle-down"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated flipInY">
                            <a href="/users/profile" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <a href="logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </li>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>