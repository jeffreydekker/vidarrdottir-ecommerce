<x-layout-admin> {{-- Edit Product --}}
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

            {{-- Upload New Images --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Add Images</label>
                <input type="file" name="images[]" multiple class="w-full p-2 border rounded">
                <p class="text-sm text-gray-500">You can select multiple images.</p>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
        </form>
    </div>

    {{-- Existing Images --}}
    @if ($product->images->count())
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold">Existing Images</label>
        <div class="flex flex-wrap gap-4">
            @foreach ($product->images as $image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $image->filename) }}" class="w-32 h-32 object-cover rounded">
                    <form action="{{ route('admin.products.images.destroy', $image->id) }}" method="POST" class="absolute top-0 right-0">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 text-xs rounded hover:bg-red-600" onclick="return confirm('Delete this image?')">
                            ✕
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</x-layout-admin>
