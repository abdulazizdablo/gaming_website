<?php

namespace App\Http\Controllers;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

class CheckOutController extends Controller{
public function createSession(Request $request)
{
    $userEmail = $request->useremail;
    $game_name = $request->game_name;

    setStripeApiKey();
    $session = Session::create([
        'payment_method_types' => ['card'],
        'customer_email'       => $userEmail,
        'line_items'           => [
            [
                'price_data'  => [
                    'product_data' => [
                        'name' => $game_name,
                    ],
                    'unit_amount'  => 100 * 100,
                    'currency'     => 'USD',
                ],
                'quantity'    => 1,
                'description' => '',
            ],
        ],
        'client_reference_id'  => '1234',
        'mode'                 => 'payment',
        'success_url'          => url('payment-success').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url'           => url('failed-payment?error=payment_cancelled'),
    ]);
    $result = [
        'sessionId' => $session['id'],
    ];
    return $this->sendResponse($result, 'Session created successfully.');
}
public function paymentSuccess(Request $request)
{
    $sessionId = $request->get('session_id');
    // 
}

public function handleFailedPayment()
{
    // 
}

}