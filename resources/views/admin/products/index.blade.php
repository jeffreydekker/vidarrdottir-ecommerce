<x-layout-admin>
    <h1>Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
    <a href="#" class="btn btn-secondary">Edit categories</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Images</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @php
                            $images = $product->images; // Get all images for the product from the relationship defined in the Product model
                        @endphp

                        @if($images->isNotEmpty())
                            @foreach ($images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" width="100">
                            @endforeach
                        @else
                            <img src="{{ asset('storage/products/istockphoto-1147544807-612x612.jpg') }}" alt="Default Image" width="100">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout-admin>
