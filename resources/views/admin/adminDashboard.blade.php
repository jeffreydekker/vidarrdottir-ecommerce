<x-layout-admin>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Orders Overview</h2>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Order ID</th>
                    <th class="border p-2">Customer</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($orders as $order) --}}
                    <tr class="text-center">
                        <td class="border p-2">order id</td>
                        <td class="border p-2">customer name</td>
                        <td class="border p-2">€price</td>
                        <td class="border p-2">
                            {{-- <span class="px-2 py-1 rounded {{ $order->status === 'Completed' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-black' }}"> --}}
                                order status
                            </span>
                        </td>
                        <td class="border p-2">
                            {{-- <a href="{{ route('admin.orders.show', 'order_id') }}" class="text-blue-500">View</a> --}}
                            view order
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</x-layout-admin>
