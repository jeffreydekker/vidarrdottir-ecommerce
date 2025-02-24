<x-layout-user>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Explore the Essence of Nature</h1>
            <p>Discover a curated selection of nature-inspired items.</p>
            <a href="#products" class="btn-primary">Shop Now</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <h2>About</h2>
        <p>Brief introduction about your business or personal brand.</p>
    </section>

    <!-- New Content Section -->
    <section class="new-content">
        <h2>New Seasonal Offers!</h2>
        <p>Don't miss out on our exclusive promotions and offers. Limited time only!</p>
        <a href="#" class="cta-button">Check It Out</a>
    </section>

    {{-- Shop catagories section --}}
    <section class="product-section">
        @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ $product->image }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>${{ $product->price }}</p>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        @endforeach
    </section>

    <!-- Reviews Section -->
    <section class="reviews">
        <h2>Reviews</h2>
        <p>Customer or client testimonials will be displayed here.</p>
    </section>

    <!-- Contact Section -->
    <section class="contact">
        <h2>Contact</h2>
        <p>Provide contact details or a form for users to reach out.</p>
    </section>

</x-layout-user>
