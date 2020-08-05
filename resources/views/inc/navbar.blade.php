  <div class="d-flex" id="wrapper">
    @if (request()->route()->getName() !== 'shared.orders')
      @include('inc.sidebar')
    @endif
    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        @if (request()->route()->getName() !== 'shared.orders')
          <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
        @elseif (request()->route()->getName() == 'shared.orders' && Auth::user()->hasRole('Admin'))
          <a class="btn btn-primary" href="/admin">Admin Access</a>
        @endif

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            @if(Auth::check() && (Auth::user()->hasRole('Owner') || Auth::user()->hasRole('Vendor') || Auth::user()->hasRole('Admin') || Auth::user()->hasRole('User') || Auth::user()->hasRole('Client')))
                    <li class="nav-item">
                      Hi, {{ Auth::user()->name }} ({!! App\Role::find(Auth::user()->roles->first()->id)->name !!})  
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="logout">
                        <i class="fal fa-power-off"></i> Logout
                      </a>
                    </li>

                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
              @endif
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>




  <style>
.logout {
  color: black;
}
.logout:hover {
  text-decoration: none;
  font-weight:bold;
  color: black;
}
.navbar-nav > li{
  padding-left:10px;
  padding-right:10px;
}

.list-group-flush .list-group-item {
  font-size: 1.2rem;
}

#sidebar-wrapper {
  min-height: 100vh;
  width: 15rem;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}
  </style>

<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
</script>