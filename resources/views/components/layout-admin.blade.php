<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>VidarrCrafts</title>
            <link rel="stylesheet" href="main.css">
            {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        </head>

        {{-- Nav bar --}}
        <body>
            <nav id="sidebar">
                <ul>
                    <li class="active"><a href="{{route('admin.dashboard')}}">
                        <span>Dashboard</span></a></li>
                    <li><a href="{{route('homepage')}}">
                        <span>Homepage</span></a></li>
                    <li><a href="{{route('admin.products.index')}}">
                        <span>Products</span></a></li>
                    <li><a href="{{route('admin.orders')}}">
                        <span>Orders</span></a></li>
                    <li><a href="{{route('admin.customers')}}">
                        <span>Customers</span></a></li>
                    <li><a href="{{route('admin.reports')}}">
                        <span>Reviews</span></a></li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                </ul>
            </nav>

            <main>
            {{$slot}}
            </main>

            <!-- Footer -->
            <footer>
                <div class="footer-content">
                    <p class="m-0">Copyright &copy; {{ date('Y') }} <a href="dekkerweb.com" class="text-muted">Dekkerweb.com</a> - All rights reserved.</p>
                    <ul class="social-links">
                        <li><a href="#"><i class="fab fa-facebook-f">Facebook</a></li>
                        <li><a href="#"><i class="fab fa-instagram">Instagram</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i>Twitter</a></li>
                    </ul>
                </div>
            </footer>

            <script src="script.js"></script>
    </body>
</html>
