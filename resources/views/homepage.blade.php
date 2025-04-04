<x-layout-user>

    <!-- Hero Section -->
    <section class="hero bg-black text-white py-16 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold tracking-wider uppercase">Explore the Essence of Nature</h1>
            <p class="text-lg mt-4">Discover a curated selection of nature-inspired items.</p>
            <a href="#products" class="mt-6 inline-block bg-white text-black px-6 py-3 rounded-full uppercase font-semibold tracking-wide hover:bg-gray-200 transition">Shop Now</a>
        </div>
    </section>

    <!-- New Content Section -->
    <section class="bg-black text-white text-center py-10">
        <h2 class="text-3xl font-semibold uppercase tracking-wide">New Seasonal Offers!</h2>
        <p class="text-lg mt-2">Don't miss out on our exclusive promotions and offers. Limited time only!</p>
        <a href="#" class="mt-4 inline-block bg-white text-black px-6 py-3 rounded-full uppercase font-semibold tracking-wide hover:bg-gray-200 transition">Check It Out</a>
    </section>

    <!-- Shop Section -->
    <section class="bg-black py-16" id="products">
        <h2 class="text-3xl font-semibold uppercase text-center text-white tracking-wide mb-10">Featured Ritually Crafted Offerings</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
            @foreach ($products as $product)
                <div class="product-card bg-black text-white rounded-lg overflow-hidden flex flex-col items-center text-center p-4 shadow-lg border border-gray-700 w-full">

                    <div class="h-64 w-full flex items-center justify-center">
                        @if($product->images->isEmpty())
                            <img src="{{ asset('storage/products/istockphoto-1147544807-612x612.jpg') }}" alt="Default Image" class="h-full w-full object-cover rounded">
                        @else
                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover rounded">
                        @endif
                    </div>

                    <div class="mt-4 flex-1 flex flex-col justify-between">
                        <h3 class="text-lg font-semibold uppercase leading-tight">{{ $product->name }}</h3>
                        <p class="text-gray-400 text-sm italic">{{ $product->description ?? 'Handcrafted with care' }}</p>
                        <p class="text-lg font-medium text-gold mt-2">${{ number_format($product->price, 2) }}</p>

                        <form action="{{ route('cart.add') }}" method="POST" class="mt-auto w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="mt-3 bg-gray-800 text-white px-6 py-2 w-full rounded hover:bg-gray-600 transition uppercase font-medium tracking-wide">Add to Cart</button>
                        </form>
                    </div>

                </div>
            @endforeach
        </div>
    </section>


</x-layout-user>
