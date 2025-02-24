<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Add a product to the cart
    public function addToCart(Request $request)
    {
        // get the product that's added to the cart
        $product = Product::find($request->product_id);

        // Throw an error if the product doesn't exist
        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        // Get the current cart from the session, or an empty array if no cart exists
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            // Increase the quantity if the product is already in the cart
            $cart[$product->id]['quantity']++;
        } else {
            // Add the product to the cart
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Redirect back to the cart page
        return back()->with('success', 'Product added to cart!');
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
