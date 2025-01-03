<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li> <a class="waves-effect waves-dark" href="{{ url('dashboard')}}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard </span></a></li>
                @if(Auth::user()->is_admin == '1')
                <li> <a class="waves-effect waves-dark" href="{{ url('users')}}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Users </span></a></li>
                @endif
                <li> <a class="waves-effect waves-dark" href="{{ url('repairing')}}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Repairing</span></a></li>
                    <li> <a class="waves-effect waves-dark" href="{{ url('mobiles')}}" aria-expanded="false"><i class="fa fa-phone"></i><span class="hide-menu">Mobiles</span></a></li>
                    <!-- <li> <a class="waves-effect waves-dark" href="{{ url('products')}}" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Products </span></a></li> -->
                    <li> <a class="waves-effect waves-dark" href="{{ url('companies')}}" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">Companies </span></a></li>
                    <li> <a class="waves-effect waves-dark" href="{{ url('issues')}}" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">Issues </span></a></li>
                    <!-- <li> <a class="waves-effect waves-dark" href="{{ url('settings')}}" aria-expanded="false"><i class="fa fa-cog"></i><span class="hide-menu">Settings </span></a></li>             -->
            </ul>
        </nav>
    </div>
</aside>