<x-layout-user>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" style="margin-top: 10%">
        @if (session('success'))
            <div class="bg-green-600 text-white px-6 py-3 rounded-lg shadow mb-6">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-4xl font-bold text-white mb-8 border-b border-gray-700 pb-2">🛒 Your Cart</h1>

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="min-w-full bg-gray-800 text-white rounded-lg overflow-hidden">
                <thead class="bg-gray-700 text-sm uppercase tracking-wider text-gray-300">
                    <tr>
                        <th class="px-6 py-4 text-left">Product</th>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-left">Price</th>
                        <th class="px-6 py-4 text-left">Quantity</th>
                        <th class="px-6 py-4 text-left">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cart as $id => $item)
                        <tr class="border-t border-gray-700 hover:bg-gray-750 transition">
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded shadow-md border border-gray-600">
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ $item['name'] }}</td>
                            <td class="px-6 py-4">${{ number_format($item['price'], 2) }}</td>
                            <td class="px-6 py-4">{{ $item['quantity'] }}</td>
                            <td class="px-6 py-4 font-semibold">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">Your cart is empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center text-white">
            <p class="text-2xl font-bold mb-6 sm:mb-0">
                Total: ${{ number_format($total, 2) }}
            </p>

            <div class="flex space-x-4">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-200">
                        🧹 Clear Cart
                    </button>
                </form>

                <a href="{{ route('checkout') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-200">
                    💳 Proceed to Checkout
                </a>
            </div>
        </div>
    </div>
</x-layout-user>
