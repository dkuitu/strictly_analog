<?php
require_once('./config.php');
require 'view/header.php';

$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
$amount = $_POST['amount'];

$customer = \Stripe\Customer::create(array(
    'email' => $email,
    'source' => $token
));

$charge = \Stripe\Charge::create(array(
    'customer' => $customer->id,
    'amount' => $amount,
    'currency' => 'cad'
));?>
<div class="flex items-center justify-center pa2 bg-gold hover-bg-green white ">
    <p class="f5 fw9 ttu tracked lh-title mt0 mb3 avenir">Thanks for shopping with Strictly Analog!</p>
</div>
<?php
echo '<h1>Successfully charged $' . $amount / 100 . ' CAD</h1>';
require 'view/footer.php';
