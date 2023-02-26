<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentStripeController extends Controller
{

// initiate the payment functionality using Stripe

public function stripePost(Request $request)
{

    Stripe/Stripe::setApiKey(env('STRIPE_SECRET'));



    Stripe/Charge::create ([
        "amount" => 100 * 100,
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "Test payment from itsolutionstuff.com." 
]);

Session::flash('success', 'Payment successful!');
              
return back();
}
}
