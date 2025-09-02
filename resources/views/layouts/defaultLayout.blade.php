<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Order Matters Here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite('resources/scss/app.scss')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="container px-0">
    
    <header id="banner-container">
        <img id='banner' src="{{ asset('images/banner.png') }}" class="img-fluid" alt="Image Did not load properly"></img>        
        @include('navigationBar')
        @yield('header')
    </header>
    <!-- Below we say hello to the user  -->
        @php
            $user = auth()->user();
        @endphp
        @if ($user)
            @if ($user->role === 'admin')
                <p>Hello {{ $user->name }}, you are now an {{ $user->role }}!</p>
            @else
                <p>Welcome back {{ $user->name }}!</p>
            @endif
        @else
            <!-- If visitor don't show -->
        @endif
    <!-- Now we put errors here -->
     @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <main class="container-fluid px-5">
        @yield('mainContent')
        @yield('secondaryContent')
    </main>

    @include('footer')

    </div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- TODO: Replace this Bootstrap CDN with Vite-managed assets for better bundling and version control -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.navbar-collapse .nav-link');
    const navbarToggler = document.querySelector('.navbar-toggler');
    const bsCollapse = new bootstrap.Collapse(document.getElementById('main-nav'), { toggle: false });

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarToggler.offsetParent !== null) { // only close on small screens
                bsCollapse.hide();
            }
        });
    });
});
</script> -->
</body>
</html>
