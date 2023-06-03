<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('index')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="26">
                        </span>
            <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="35">
                        </span>
        </a>
        <a href="{{route('index')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="26">
                        </span>
            <span class="logo-lg">
                            <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="26">
                        </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="bi bi-sun"></i> <span data-key="t-authentication">User listing</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user_create') }}" class="nav-link" data-key="t-basic"> Create </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link" data-key="t-basic-2"> Listing </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#customer" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="bi bi-person-circle"></i> <span data-key="t-authentication">Customer</span>
                    </a>
                    <div class="collapse menu-dropdown" id="customer">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('create.customer') }}" class="nav-link" data-key="t-basic"> Create </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer') }}" class="nav-link" data-key="t-basic-2"> Listing </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
