<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    // USER
    public function showShopPage(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = Category::all();

        return view('user.shop.index', compact('products', 'categories'));
    }
    // ADMIN
    public function index()
    {
        $products = Product::with('images')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }
    // ADMIN PRODUCTS CRUD
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'category_id' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== 'new' && !Category::where('id', $value)->exists()) {
                        $fail('The selected category is invalid.');
                    }
                },
            ],
            'new_category' => 'nullable|string|unique:categories,name',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2000',
        ]);

        // Determine category ID
        if ($request->category_id === 'new' && $request->filled('new_category')) {
            $category = Category::create([
                'name' => $request->new_category,
                'slug' => Str::slug($request->new_category),
            ]);
            $category_id = $category->id;
        } elseif ($request->filled('category_id')) {
            $category_id = $request->category_id;
        } else {
            return back()->withErrors(['category' => 'Please select or create a category.'])->withInput();
        }

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $category_id,
            'slug' => Str::slug($request->name),
            'description' => $request->description ?? '',
            'short_description' => $request->short_description ?? '',
            'price' => number_format($request->price, 2, '.', ''),
            'discount_price' => $request->discount_price ?? 0,
            'stock' => $request->stock,
            'sku' => $request->sku ?? null,
            'tags' => $request->tags ?? '',
            'meta_title' => $request->meta_title ?? '',
            'meta_description' => $request->meta_description ?? '',
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('products', 'public');

                // Store each image path in the `product_images` table
                $productImage = ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
    public function toggleFeatured(Product $product) {
        // If enabling the feature and the limit is reached, prevent it
        if (!$product->featured && Product::where('featured', true)->count() >= 20) {
            return redirect()->route('admin.products.index')->with('error', 'Maximum of 20 featured products allowed.');
        }

        // Toggle the featured status
        $product->update(['featured' => !$product->featured]);

        return redirect()->route('admin.products.index')->with('success', 'Product visibility updated.');
    }
}
