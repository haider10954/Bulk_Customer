<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('index')  }}" class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                                    </span>
                        <span class="logo-lg">
                                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="25">
                                    </span>
                    </a>

                    <a href="{{ route('index')  }}" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                                    </span>
                        <span class="logo-lg">
                                        <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="25">
                                    </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                        id="topnav-hamburger-icon">
                                <span class="hamburger-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                </button>
            </div>

            <div class="d-flex align-items-center">

                <div class="d-md-none topbar-head-dropdown header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle"
                            id="page-header-search-dropdown" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="bi bi-search fs-16"></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle"
                            data-toggle="fullscreen">
                        <i class='bi bi-arrows-fullscreen fs-16'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-dark rounded-circle mode-layout"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-sun align-middle fs-20"></i>
                    </button>
                    <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                        <a href="#!" class="dropdown-item" data-mode="light"><i class="bi bi-sun align-middle me-2"></i>
                            Defualt (light mode)</a>
                        <a href="#!" class="dropdown-item" data-mode="dark"><i class="bi bi-moon align-middle me-2"></i>
                            Dark</a>
                        <a href="#!" class="dropdown-item" data-mode="auto"><i
                                class="bi bi-moon-stars align-middle me-2"></i> Auto (system defualt)</a>
                    </div>
                </div>


                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                                    <span class="d-flex align-items-center">
                                        <span class="text-start ms-xl-2">
                                            <span
                                                class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth('admin')->user()->name }}</span>
                                            <span class="d-none d-xl-block ms-1 fs-13 text-reset user-name-sub-text">Admin</span>
                                        </span>
                                    </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ auth('admin')->user()->name }}!</h6>

                         <a class="dropdown-item" href="{{ route('auth_logout') }}"><i
                                class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
