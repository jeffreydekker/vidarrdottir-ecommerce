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
            <header class="fixed top-0 left-0 w-full z-50 bg-black bg-opacity-60 backdrop-blur-md shadow">
                <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                        <div>
                        <a href="/" class="text-2xl font-extrabold text-white tracking-widest hover:text-gray-300 transition">
                            Vidarr
                        </a>

                        <!-- Nav links -->
                        <ul class="hidden md:flex items-center space-x-6 text-white font-medium">
                            <li><a href="/" class="hover:text-gray-300 transition">Homepage</a></li>
                            <li><a href="/shop" class="hover:text-gray-300 transition">Shop</a></li>
                            <li><a href="#reviews" class="hover:text-gray-300 transition">Reviews</a></li>
                            <li><a href="/about" class="hover:text-gray-300 transition">About</a></li>
                            <li><a href="/cart" class="hover:text-gray-300 transition">Cart</a></li>
                            <li><a href="/contact" class="hover:text-gray-300 transition">Contact</a></li>
                        </ul>

                        <!-- Mobile Menu Button -->
                        <div class="md:hidden">
                            <button id="menu-toggle" class="text-white focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            </button>
                        </div>
                    </div>
                </nav>

                    <!-- Mobile nav -->
                    <div id="mobile-menu" class="md:hidden px-6 pb-4 hidden">
                    <ul class="flex flex-col space-y-2 text-white text-center font-medium">
                        <li><a href="/" class="block hover:text-gray-300">Homepage</a></li>
                        <li><a href="/shop" class="block hover:text-gray-300">Shop</a></li>
                        <li><a href="#reviews" class="block hover:text-gray-300">Reviews</a></li>
                        <li><a href="/about" class="block hover:text-gray-300">About</a></li>
                        <li><a href="/cart" class="block hover:text-gray-300">Cart</a></li>
                        <li><a href="/contact" class="block hover:text-gray-300">Contact</a></li>
                    </ul>
                    </div>
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
