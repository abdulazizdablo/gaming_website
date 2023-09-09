<?php

namespace App\Http\Controllers;

use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\Game;


class CheckOutController extends Controller
{
    public function createSession(Request $request)
    {
        $userEmail = $request->useremail;
        $gameName = $request->game_name;

        // Set your Stripe API key here
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $userEmail,
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $gameName,
                        ],
                        'unit_amount' => $this->calculateAmount($gameName),

                        'currency' => 'USD',
                    ],
                    'quantity' => 1,
                    'description' => '',
                ],
            ],
            'client_reference_id' => '1234',
            'mode' => 'payment',
            'success_url' => route('payment-success'), // Update route name
            'cancel_url' => route('failed-payment'), // Update route name
        ]);

        $result = [
            'sessionId' => $session['id'],
        ];

        return $this->sendResponse($result, 'Session created successfully.');
    }

    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->get('session_id');

        // Implement logic for handling successful payment here
    }

    public function handleFailedPayment()
    {
        // Implement logic for handling failed payments here
    }
    public function calculateAmount($gameName)
    {
        // Retrieve the game's price from the database based on its name
        $game = Game::where('name', $gameName)->first();

        if (!$game) {
            // Handle the case where the game is not found
            return 0; // Or an appropriate default value
        }

        // Calculate the amount in cents (multiply by 100 to convert to cents)
        $amount = $game->price * 100;

        return $amount;
    }
}
