<x-layout-admin>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <label class="block mb-2 font-semibold">Category Name</label>
            <input type="text" name="name" class="border p-2 w-full" required>

            <button type="submit" class="mt-3 bg-green-500 text-white px-4 py-2 rounded">Create Category</button>
        </form>
    </div>
</x-layout-admin>
