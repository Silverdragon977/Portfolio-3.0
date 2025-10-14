<nav class="navbar navbar-expand-md navbar-light">
      <div class="container-fluid">
        <a href='{{ route('homePage') }}' class="navbar-brand">
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
                <li><a class="dropdown-item" href="{{ route('homePage') }}">Homepage</a></li>
                <li><a class="dropdown-item" href="{{ route('projectsPage') }}">Projects</a></li>
                <li><a class="dropdown-item" href="{{ route('resumePage') }}">Resume</a></li>
                <li><a class="dropdown-item" href="{{ route('contactPage') }}">Contact</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.index') }}">Admin</a></li>

            </ul>
          </li>
          <li class="nav-item dropdown me-1">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                 Games
              </a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('clickHero') }}">Click Hero</a></li>
              </ul>
          </li>
          <li class='nav-item'>
              <a class='btn btn-secondary' href='{{ route('login') }}'>Login</a>
          </li>
          <li class='nav-item'>
               <a class='btn btn-secondary' href='{{ route('register') }}'>Register</a>
          </li>
          @php
              $user = auth()->user();
          @endphp
          @if ($user)
              @if ($user->role === 'admin' || $user->role === 'user')
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
              @else
                  <!-- Do not render logout button -->
              @endif
          @else
              <!-- Do not render logout button -->
          @endif
        </ul>
      </div>
    </div>
</nav>