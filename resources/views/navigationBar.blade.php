<nav class="navbar navbar-expand-md navbar-light">
      <div class="container-fluid">
        <a href='{{ route('home') }}' class="navbar-brand">
         <span class="fw-bold text-secondary">Homepage</span>
        </a>

        <button class="navbar-toggler" type='button' data-bs-toggle="collapse"
        data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false"
        aria-label="Toggle navigation">
            <span class='navbar-toggler-icon'></span>
        </button>

      <div class='collapse navbar-collapse' id='main-nav'>
        <ul class='navbar-nav ms-auto gap-2 align-items-center'> 
          <li class="nav-item dropdown me-1">
            <a id="portfolioDropdown"class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Portfolio
            </a>
            <ul class="dropdown-menu" aria-labelledby="portfolioDropdown">
                <li><a class="dropdown-item" href="{{ route('home') }}">Homepage</a></li>
                <li><a class="dropdown-item" href="{{ route('projects.index') }}">Projects</a></li>
                <li><a class="dropdown-item" href="{{ route('resume') }}">Resume</a></li>
                <li><a class="dropdown-item" href="{{ route('contact.create') }}">Contact</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a></li>

            </ul>
          </li>
          <li class="nav-item dropdown me-1">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 Games
              </a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('ClickHero') }}">Click Hero</a></li>
              </ul>
          </li>

        {{-- Rendering the login and register buttons for guests, and only the logout button for authenticated users --}}
        {{-- User === guest --}}
        @guest
            <li class='nav-item'>
              <a class='btn btn-secondary' href='{{ route('login') }}'>Login</a>
          </li>
          <li class='nav-item'>
               <a class='btn btn-secondary' href='{{ route('register') }}'>Register</a>
          </li>
        @endguest

        {{-- User === authenticated --}}
        @auth
            <li class='nav-item'>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            </li>
            <li class='nav-item'>
                <a class='btn btn-secondary' href='{{ route('profile.edit') }}'>Profile</a>
            </li>
        @endauth
        </ul>
      </div>
    </div>
</nav>