<?php

require '../config.php';

$mode = 'subscription';
$price_token = '';
$coupon_token = null;
$success_url = 'https://example.com/payment/success';
$cancel_url = 'https://example.com/payment/failed';

require '../api/session.php';

$action = SetSession($mode, $price_token, $coupon_token, $success_url, $cancel_url);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
</head>
<body>

<p>Taking you to the checkout page... please wait a moment</p>

<script src="https://js.stripe.com/v3"></script>
<script>
//  console.log(<?php echo $STRIPE_PUBLISHABLE_KEY; ?>);

 var stripe = Stripe('<?php echo $STRIPE_PUBLISHABLE_KEY; ?>');

  /*
     * When the customer clicks on the button, redirect
     * them to Checkout.
     */
    stripe.redirectToCheckout({
      lineItems: [{price: '<?php echo $price_token; ?>', quantity: 1}],
      mode: '<?php echo $mode; ?>',
      /*
       * Do not rely on the redirect to the successUrl for fulfilling
       * purchases, customers may not always reach the success_url after
       * a successful payment.
       * Instead use one of the strategies described in
       * https://stripe.com/docs/payments/checkout/fulfill-orders
       */
      successUrl: '<?php echo $success_url; ?>',
      cancelUrl: '<?php echo $success_url; ?>',
    })
    .then(function (result) {
      if (result.error) {
        /*
         * If `redirectToCheckout` fails due to a browser or network
         * error, display the localized error message to your customer.
         */
        var displayError = document.getElementById('error-message');
        displayError.textContent = result.error.message;
      }
    });

</script>

</body>
</html>
