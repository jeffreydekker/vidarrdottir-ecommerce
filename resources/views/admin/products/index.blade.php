<x-layout-admin>
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Products</h2>
            <div class="space-x-2">
                <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add New Product</a>
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Edit Categories</a>
            </div>
        </div>

        @if(session('error'))
            <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Product</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Category</th>
                    <th class="border p-2">Price</th>
                    <th class="border p-2">Stock</th>
                    <th class="border p-2">Show on Frontend</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="text-center">
                        <td class="border p-2">{{ $product->id }}</td>
                        <td class="border p-2">
                            @if ($product->images->isNotEmpty())
                                <div class="flex space-x-2 justify-center">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                                    @endforeach
                                </div>
                            @else
                                <img src="{{ asset('storage/products/istockphoto-1147544807-612x612.jpg') }}" alt="Default Image" class="w-16 h-16 object-cover rounded">
                            @endif
                        </td>
                        <td class="border p-2">{{ $product->name }}</td>
                        <td class="border p-2">{{ $product->category->name }}</td>
                        <td class="border p-2">€{{ number_format($product->price, 2) }}</td>
                        <td class="border p-2">{{ $product->stock }}</td>
                        <td class="border p-2">
                            <form method="POST" action="{{ route('admin.products.toggleFeatured', $product) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="featured" value="{{ $product->featured ? 0 : 1 }}">
                                <button type="submit" class="px-3 py-1 rounded {{ $product->featured ? 'bg-green-500' : 'bg-gray-400' }} text-white">
                                    {{ $product->featured ? 'Yes' : 'No' }}
                                </button>
                            </form>
                        </td>
                        <td class="border p-2 space-x-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout-admin>
