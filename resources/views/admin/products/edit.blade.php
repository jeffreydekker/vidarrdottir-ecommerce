<x-layout-admin>

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Edit Product</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Price</label>
                <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" class="w-full p-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Category</label>
                <select name="category_id" class="w-full p-2 border rounded">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Description</label>
                <textarea name="description" class="w-full p-2 border rounded">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
        </form>
    </div>

</x-layout-admin>
