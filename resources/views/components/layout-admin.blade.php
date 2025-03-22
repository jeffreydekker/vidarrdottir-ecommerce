<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VidarrCrafts Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <nav class="w-64 bg-gray-900 text-white min-h-screen p-5">
        <h2 class="text-lg font-bold mb-4">Admin Panel</h2>
        <ul class="space-y-3">
            <li class="p-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="block">Dashboard</a>
            </li>
            <li class="p-2 rounded {{ request()->routeIs('admin.products.index') ? 'bg-gray-700' : '' }}">
                <a href="{{ route('admin.products.index') }}" class="block">Products</a>
            </li>
            <li class="p-2 rounded {{ request()->routeIs('admin.orders') ? 'bg-gray-700' : '' }}">
                <a href="{{ route('admin.orders') }}" class="block">Orders</a>
            </li>
            <li class="p-2 rounded {{ request()->routeIs('admin.customers') ? 'bg-gray-700' : '' }}">
                <a href="{{ route('admin.customers') }}" class="block">Customers</a>
            </li>
            <li class="p-2 rounded {{ request()->routeIs('admin.reports') ? 'bg-gray-700' : '' }}">
                <a href="{{ route('admin.reports') }}" class="block">Reviews</a>
            </li>
        </ul>

        <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="w-full p-2 bg-red-600 hover:bg-red-700 text-white rounded">Logout</button>
        </form>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

</body>
</html>
