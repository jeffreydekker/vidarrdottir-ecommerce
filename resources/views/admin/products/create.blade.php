<x-layout-admin>

    <h1>Add New Product</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <input type="text" name="description" class="form-control">
        </div>

        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Product Images:</label>
            <input type="file" name="images[]" multiple class="form-control">
        </div>

        <select name="category_id" id="category-select">
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            <option value="new">+ Add New Category</option>
        </select>

        <input type="text" name="new_category" id="new-category" placeholder="Enter new category" style="display: none;">

        <button type="submit" class="btn btn-success">Save</button>

        <script>
            document.getElementById('category-select').addEventListener('change', function () {
                document.getElementById('new-category').style.display = this.value === 'new' ? 'block' : 'none';
            });
        </script>
    </form>

</x-layout-admin>
