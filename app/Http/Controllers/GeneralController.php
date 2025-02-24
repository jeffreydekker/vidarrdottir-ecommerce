<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function userHomepage()
    {
        // Fetch all products from the database
        $products = Product::all();

        // Pass the products to the view
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
    public function showPrivacyPolicyPage()
    {
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
