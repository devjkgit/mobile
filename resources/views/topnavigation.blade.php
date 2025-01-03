 <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" style="text-align: center; width: 220px; padding-left: 0;">
                     <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/assets/images/mobile-data-logo.png" alt="">
                     </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        @if(Auth::user()->is_admin == 1)
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user()->profileimage != "")
                                        <img src="{{ url('assets/images/profileimage/'.Auth::user()->profileimage) }}" class="img-circle" width="30" height="30">
                                    @else
                                        <img src="{{ url('assets/images/profileimage/user2.png')}}" alt="user" class="" width="30" height="30">
                                    @endif

                                 <span class="hidden-md-down"> {{ Auth::user()->username }} &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <a href="{{ url('users/profile')}}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                <a href="{{ url('logout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>