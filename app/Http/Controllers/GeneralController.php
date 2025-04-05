<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function userHomepage()
    {
        // Get the first 20 featured products with their images
        $products = Product::with('images')->where('featured', true)->limit(20)->get();
        // Get the first and second images for each product
        $products->each(function ($product) {
            $product->first_image = $product->images->get(0) ?? null;
            $product->second_image = $product->images->get(1) ?? null;
        });

        return view('homepage', compact('products'));
    }

    // Contact Page
    public function showContactPage()
    {
        return view('user.contact');
    }

    public function sendContactForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Send the email
        // Mail::to(config('mail.from.address'))->send(new ContactFormMail($request));

        // Redirect to the contact page with a success message
        return redirect()->back()->with('message', 'Thanks for your message. We\'ll be in touch. 😊');
    }

    // Footer // Policies
    public function showPrivacyPolicyPage(){
        return view('user.footer.policies.privacy-policy');
    }
    public function showRefundPolicyPage() {
        return view('user.footer.policies.refund-policy');
    }
    public function showShippingPolicyPage() {
        return view('user.footer.policies.shipping-policy');
    }
    public function showTermsofServicePage() {
        return view('user.footer.policies.terms-of-service');
    }
    public function showFaqPage() {
        return view('user.footer.policies.faq');
    }

}
