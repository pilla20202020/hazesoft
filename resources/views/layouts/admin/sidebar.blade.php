<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('user.index')}}" class="waves-effect">
                        <i class="fas fa-user"></i></i> User
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="fa fa-map-marker"></i>
                        <span>Location</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('state.index')}}" aria-expanded="false"><i class=" fas fa-hand-point-right"></i></i> State</a></li>
                        <li><a href="{{ route('district.index')}}" aria-expanded="false"><i class=" fas fa-hand-point-right"></i></i> District</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="fas fa-car"></i>
                        <span>Car & Models</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('car.index')}}" aria-expanded="false"><i class=" fas fa-hand-point-right"></i></i> Car</a></li>
                        <li><a href="{{ route('carmodel.index')}}" aria-expanded="false"><i class=" fas fa-hand-point-right"></i></i> Car Model</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('recieve-car.index')}}" class="waves-effect">
                        <i class=" fas fa-infinity"></i></i> Recieve A Car
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
