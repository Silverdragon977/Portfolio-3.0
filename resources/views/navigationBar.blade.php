<nav class="navbar navbar-expand-md navbar-light navbar-custom-rounded">
      <div class="container-fluid">
        <a href='{{ route('homePage') }}' class="navbar-brand">
         <span class="fw-bold text-secondary">MichaelHoward977</span>
        </a>

        <button class="navbar-toggler" type='button' data-bs-toggle="collapse"
        data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false"
        aria-label="Toggle navigation">
            <span class='navbar-toggler-icon'></span>
        </button>

      <div class='collapse navbar-collapse justify-content-end align-center' id='main-nav'>
        <ul id='collapseNav' class='navbar-nav gap-2'> 
          <li class="nav-item dropdown me-1">
            <a class="nav-link dropdown-toggle" href="{{ route('homePage') }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Portfolio
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('homePage') }}">Homepage</a></li>
                <li><a class="dropdown-item" href="{{ route('projectsPage') }}">Projects</a></li>
                <li><a class="dropdown-item" href="{{ route('resumePage') }}">Resume</a></li>
                <li><a class="dropdown-item" href="{{ route('contactPage') }}">Contact</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown me-1">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Games
                </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Click Hero</a></li>
          </ul>
        </li>
           <li class='nav-item d-none d-md-inline'>
                <a class='btn btn-secondary' href='{{ route('homePage') }}'>Login/SignUp</a>
            </li>
        </ul>
      </div>
    </div>
</nav>