<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::with('images')->find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        $imagePath = $product->images->first()?->image_path ?? null;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $imagePath,
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Product added to cart!']);

    }

    // Show the cart to the user
    public function showCart()
    {
        // Define the cart array key value pair and link it to session storage
        $cart = session()->get('cart', []);

        // Calculate the total price
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('showCart', compact('cart', 'total'));
    }

    // Clear the cart if the user wants to
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
