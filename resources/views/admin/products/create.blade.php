<x-layout-admin>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Add New Product</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold">Name:</label>
                <input type="text" name="name" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Price:</label>
                <input type="number" name="price" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" step="0.01" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Description:</label>
                <input type="text" name="description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Stock:</label>
                <input type="number" name="stock" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Image Upload Section -->
            <div>
                <label class="block text-gray-700 font-semibold">Product Images:</label>
                <input type="file" id="imageInput" name="images[]" multiple hidden>
                <button type="button" id="addImageBtn" class="p-2 bg-green-500 text-white rounded">Add Image</button>
                <div id="preview" class="mt-3 grid grid-cols-4 gap-2"></div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Category:</label>
                <select name="category_id" id="category-select" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    <option value="new">+ Add New Category</option>
                </select>
            </div>

            <div id="new-category-container" class="hidden">
                <label class="block text-gray-700 font-semibold">New Category:</label>
                <input type="text" name="new_category" id="new-category" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Enter new category">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition">Save</button>
        </form>
    </div>

    <!-- Load External JavaScript -->
    <script src="{{ asset('js/product-upload.js') }}" defer></script>
</x-layout-admin>

