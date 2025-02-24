<x-layout-user>

    <h1 style="color:white">Checkout</h1>
    @if(session('error'))
        <p style="color:white">{{ session('error') }}</p>
    @endif
    @if(session('success'))
        <p style="color:white">{{ session('success') }}</p>
    @endif

    <h1 style="color:white">Your Cart</h1>
    <table style="color:white; margin-bottom:20px">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cart as $id => $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/images/' . $item['image']) }}" alt="{{ $item['name'] }}" width="50">
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>${{ $item['price'] * $item['quantity'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Your cart is empty.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p style="color:white"><strong>Total: </strong>${{ $total }}</p>

    <script src="https://js.stripe.com/v3/"></script>

    <form id="payment-form" method="POST" action="{{ route('checkout.process') }}" style="max-width: 400px; margin: 0 auto; background-color: #222; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="name" style="color: white; display: block; margin-bottom: 5px; font-weight: bold;">Name:</label>
            <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; border: 1px solid #444; border-radius: 4px; background-color: #333; color: white;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="email" style="color: white; display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; border: 1px solid #444; border-radius: 4px; background-color: #333; color: white;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="address" style="color: white; display: block; margin-bottom: 5px; font-weight: bold;">Address:</label>
            <textarea id="address" name="address" rows="3" required style="width: 100%; padding: 10px; border: 1px solid #444; border-radius: 4px; background-color: #333; color: white; resize: none;"></textarea>
        </div>
        <div id="payment-element" style="margin-bottom: 15px;">
            <!-- Stripe Payment Element will be inserted here -->
        </div>
        <button id="submit" class="checkout-button" style="width: 100%; padding: 12px; background-color: #007bff; border: none; border-radius: 4px; color: white; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
            Submit Payment
        </button>
        <div id="error-message" style="color: red; margin-top: 10px; text-align: center;"></div>
    </form>

    @if(!isset($clientSecret))
    <p style="color:red">Error: Client Secret not set.</p>
    @endif

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        // Stripe public and client secrets
        const stripeKey = "{{ $stripeKey }}";
        const clientSecret = "{{ $clientSecret }}";

        if (!clientSecret) {
            document.getElementById('error-message').textContent = "Payment processing issue. Please try again.";
        }

        // Initialize Stripe with the public key
        const stripe = Stripe(stripeKey);

        // Create an instance of Elements with the client secret
        const elements = stripe.elements({ clientSecret });

        // Create and mount the payment element
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        // Handle the form submission
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
