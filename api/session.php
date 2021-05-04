<?php

require '../config.php';

\Stripe\Stripe::setApiKey($STRIPE_SECRET);


function SetSession($mode, $price_token, $coupon_token, $success_url, $cancel_url){

    
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price' => $price_token,
            'quantity' => 1,
        ]],
        'mode' => $mode,
        'discounts' => [[
            'coupon' => $coupon_token,
        ]],
        'success_url' => $success_url,
        'cancel_url' => $cancel_url,
    ]);
    

    return json_encode(['id' => $session->id]);


}


?>