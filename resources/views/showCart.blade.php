<x-layout-user>
    @if (session('success'))
        <p style="color: white">{{ session('success') }}</p>
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
                        <img src="{{ asset('storage/images/' . $item['image']) }}"
                        alt="{{ $item['name'] }}" width="50">
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

    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button type="submit" style="color:white">Clear Cart</button>
    </form>
    <a href="{{ route('checkout') }}" class="checkout-button">Proceed to Checkout</a>


</x-layout-user>
