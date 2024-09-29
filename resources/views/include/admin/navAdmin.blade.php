<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="" class="logo d-flex align-items-center">
        <img src="adminAssets/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block"><span class="text-danger">PMS</span> Dashboard</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a href="{{ route('logout') }}" type='button' class='btn btn-sm btn-outline-danger'> <i class='bx bx-log-out'></i> LogOut</a>
          {{-- <a href="{{ route('register') }}" type='button' class='btn btn-sm btn-outline-danger'> <i class='bx bx-log-out'></i> reg</a> --}}
          {{-- <a href="{{ route('login') }}" type='button' class='btn btn-sm btn-outline-danger'> <i class='bx bx-log-out'></i> login</a> --}}
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->