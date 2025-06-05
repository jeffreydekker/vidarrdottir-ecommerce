<x-layout-user>
    <div class="max-w-6xl mx-auto py-10 px-4 text-white min-h-screen grid grid-cols-1 lg:grid-cols-3 gap-8" style="margin-top: 5%">

        <!-- Checkout Form -->
        <div class="bg-gray-900 p-6 rounded-lg shadow h-fit">
            <form id="payment-form" method="POST" action="{{ route('checkout.process') }}" class="flex flex-col gap-4">
                @csrf

                <h2 class="text-2xl font-semibold mb-2">Billing Info</h2>

                <div>
                    <label for="name" class="block text-sm font-bold mb-1">Name</label>
                    <input type="text" id="name" name="name" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold mb-1">Email</label>
                    <input type="email" id="email" name="email" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="address" class="block text-sm font-bold mb-1">Address</label>
                    <textarea id="address" name="address" rows="3" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded text-white resize-none focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div id="payment-element" class="mb-4"></div>

                <button id="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition duration-200 text-white font-semibold rounded">
                    Submit Payment
                </button>

                <div id="error-message" class="text-red-400 text-sm mt-2 text-center"></div>

                @if(!isset($clientSecret))
                    <p class="text-red-400 text-center mt-2">Error: Client Secret not set.</p>
                @endif
            </form>
        </div>

        <!-- Cart Section -->
        <div class="lg:col-span-2 bg-gray-800 p-6 rounded-lg shadow h-fit">
            <h1 class="text-3xl font-bold mb-6 border-b pb-4">Your Cart</h1>

            @if(session('error'))
                <div class="bg-red-500 text-white p-4 mb-4 rounded shadow">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($cart) > 0)
                <div class="space-y-4">
                    @foreach ($cart as $id => $item)
                        <div class="bg-gray-700 rounded-lg p-4 flex items-center gap-4 shadow">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                            <div class="flex-1">
                                <h2 class="text-lg font-semibold">{{ $item['name'] }}</h2>
                                <p class="text-sm text-gray-400">Quantity: {{ $item['quantity'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-300">Price: ${{ number_format($item['price'], 2) }}</p>
                                <p class="text-sm text-gray-300">Subtotal: ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-right text-xl font-semibold mt-6 text-white">
                    Total: ${{ number_format($total, 2) }}
                </div>
            @else
                <p class="text-gray-300">Your cart is empty.</p>
            @endif
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ $stripeKey }}";
        const clientSecret = "{{ $clientSecret }}";

        if (!clientSecret) {
            document.getElementById('error-message').textContent = "Payment processing issue. Please try again.";
        }

        const stripe = Stripe(stripeKey);
        const elements = stripe.elements({ clientSecret });
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "{{ route('checkout.success') }}",
                },
            });

            if (error) {
                document.getElementById('error-message').textContent = error.message;
            }
        });
    </script>
</x-layout-user>
