<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
        // Display all categories
        public function index()
        {
            $categories = Category::all();
            return view('admin.products.categories.index', compact('categories'));
        }

        // Show edit form
        public function edit(Category $category)
        {
            return view('admin.categories.edit', compact('category'));
        }

        // Update category
        public function update(Request $request, Category $category)
        {
            $request->validate([
                'name' => 'required|string|unique:categories,name,' . $category->id,
            ]);

            // Update category name
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);

            return redirect()->route('admin.products.categories.index')->with('success', 'Category updated successfully!');
        }

        // Delete category and associated products
        public function destroy(Category $category)
        {
            // Delete all products related to this category
            $category->products()->delete();

            // Delete the category
            $category->delete();

            return redirect()->route('admin.products.categories.index')->with('success', 'Category and its products deleted successfully!');
        }
}
