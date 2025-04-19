<x-layout-user>
    <div class="container mt-12 mb-12 mx-auto p-6" style="margin-top: 10rem;">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4" style="color: white">Welcome to Our Shop</h1>
            <p class="text-gray-700 mb-6" style="color: white">Explore our wide range of products and find what you love!</p>
        </div>


        <!-- Category Filter -->
        <form method="GET" action="{{ route('shop.index') }}" class="mb-4">
            <label for="category" class="font-semibold">Filter by Category:</label>
            <select name="category" onchange="this.form.submit()">
                <option value="all">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ ucfirst($category->name) }}
                    </option>
                @endforeach
            </select>
        </form>

<!-- Product Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse ($products as $product)
        <div class="border rounded-lg shadow p-4">
            <div class="relative group w-full h-48 overflow-hidden rounded">
                @if ($product->first_image)
                    <img src="{{ asset('storage/' . $product->first_image->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded
                                {{ $product->second_image ? 'transition-opacity duration-300 group-hover:opacity-0' : '' }}">
                @else
                    <img src="{{ asset('storage/products/istockphoto-1147544807-612x612.jpg') }}" alt="Default Image" class="w-full h-full object-cover rounded">
                @endif

                @if ($product->second_image)
                    <img src="{{ asset('storage/' . $product->second_image->image_path) }}" alt="{{ $product->name }} Alt" class="absolute top-0 left-0 w-full h-full object-cover opacity-0 transition-opacity duration-300 group-hover:opacity-100 rounded">
                @endif
            </div>

            <h2 class="text-lg font-bold mt-2">{{ $product->name }}</h2>
            <p class="text-gray-600">{{ $product->description }}</p>
            <p class="text-white font-semibold mt-1">${{ number_format($product->price, 2) }}</p>
            <a href="#" class="mt-2 inline-block bg-blue-500 text-white px-4 py-2 rounded">View Product</a>
        </div>
    @empty
        <p class="col-span-4 text-gray-500">No products found.</p>
    @endforelse
</div>
    </div>
</x-layout-user>
