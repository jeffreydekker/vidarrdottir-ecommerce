<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $products = Product::all();
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
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|unique:categories,name',
        ]);

        // Ensure at least one category is provided
        if (!$request->filled('category_id') && !$request->filled('new_category')) {
            return back()->withErrors(['category' => 'Please select an existing category or create a new one.'])->withInput();
        }

        // If a new category was entered, create it
        if ($request->filled('new_category')) {
            $category = Category::create(['name' => $request->new_category]);
            $category_id = $category->id;
        } else {
            $category_id = $request->category_id;
        }

        $slug = Str::slug($request->name);
        // Ensure the slug is unique

        Product::create([
            'name' => $request->name,
            'category_id' => $category_id,
            'slug' => $slug, // Ensure the slug is set
        ]);

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
}
