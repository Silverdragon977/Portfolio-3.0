<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Order Matters Here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite('resources/sass/app.scss')
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

    <main class="container-fluid px-5">
        @yield('mainContent')
    </main>

    @include('footer')

    </div>

</body>
</html>