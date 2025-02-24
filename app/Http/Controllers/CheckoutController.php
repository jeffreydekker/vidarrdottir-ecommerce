<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Stripe\Stripe;
    use Stripe\PaymentIntent;

    class CheckoutController extends Controller
    {
        public function showCheckoutPage()
        {
            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }

            // Calculate total
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            try {
                Stripe::setApiKey(config('services.stripe.secret'));

                $paymentIntent = PaymentIntent::create([
                    'amount' => $total * 100, // Amount in cents
                    'currency' => 'usd',
                ]);

                $clientSecret = $paymentIntent->client_secret;

                return view('checkout', compact('cart', 'total', 'clientSecret'))
                    ->with('stripeKey', config('services.stripe.key'));
            } catch (\Exception $e) {
                return redirect()->route('cart')->with('error', $e->getMessage());
            }
        }

        public function processCheckout(Request $request)
        {
            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return redirect()->route('checkout')->with('error', 'Your cart is empty.');
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'address' => 'required|string|max:500',
            ]);

            $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            try {
                Stripe::setApiKey(config('services.stripe.secret'));

                $paymentIntent = PaymentIntent::create([
                    'amount' => $totalPrice * 100, // Amount in cents
                    'currency' => 'usd',
                    'metadata' => [
                        'customer_name' => $request->name,
                        'customer_email' => $request->email,
                    ],
                ]);

                DB::transaction(function () use ($cart, $request, $totalPrice, $paymentIntent) {
                    $order = \App\Models\Order::create([
                        'customer_name' => $request->name,
                        'customer_email' => $request->email,
                        'customer_address' => $request->address,
                        'total_price' => $totalPrice,
                        'stripe_payment_id' => $paymentIntent->id,
                    ]);

                    foreach ($cart as $item) {
                        $order->orderItems()->create([
                            'product_id' => $item['id'],
                            'name' => $item['name'],
                            'price' => $item['price'],
                            'quantity' => $item['quantity'],
                        ]);
                    }
                });

                session()->forget('cart');

                return redirect()->route('checkout')->with('success', 'Payment successful!');
            } catch (\Exception $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            }
        }


        public function success() {
            return view('checkoutSuccess');
        }
    }
