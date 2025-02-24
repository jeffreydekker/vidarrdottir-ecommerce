<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Vidarr&Sage</title>
            <link rel="stylesheet" href="{{ asset('main.css') }}">

            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>

        <body>
            <!-- Header -->
            <header>
                <nav>
                    <div class="logo">Vidarr</div>
                    <ul class="nav-links">
                        <li><a href="/">Homepage</a></li>
                        <li><a href="/shop">Shop</a></li>
                        <li><a href="#reviews">Reviews</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/cart">Cart</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </nav>
            </header>

            @if (session('success'))
                <div class="alert alert-success" style="color:white">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
            <div class="alert alert-success" style="color:red">
                {{ session('error') }}
            </div>
            @endif

            {{$slot}}


        <!-- Footer Section -->
        <footer>
            <div class="footer-links">
                <a href="{{route('privacy-policy')}}">Privacy Policy</a>
                <a href="{{route('faq')}}">FAQ</a>
                <a href="{{route('refund-policy')}}">Refund Policy</a>
                <a href="{{route('shipping-policy')}}">Shipping Policy</a>
                <a href="{{route('terms-of-service')}}">Terms of Service</a>
                <a href="{{route('privacy-policy')}}">Payment Options</a>
            </div>

            <!-- Social Media Icons -->
            <div class="social-icons">
                <a href="#">📘</a>  <!-- Facebook -->
                <a href="#">🐦</a>  <!-- Twitter -->
                <a href="#">📷</a>  <!-- Instagram -->
                <a href="#">🎥</a>  <!-- YouTube -->
                <a href="#">💼</a>  <!-- LinkedIn -->
            </div>

            <div class="footer-bottom">
                <p class="m-0">Copyright &copy; {{ date('Y') }} <a href="dekkerweb.com" class="text-muted">Dekkerweb.com</a> - All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
