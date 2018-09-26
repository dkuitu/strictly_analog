<?php
require_once('vendor/autoload.php');

$stripe = array(
    "secret_key" => "sk_test_DOafkVJZbcirz3YFW7YuBlSj",
    "publishable_key" => "pk_test_hOVKJKL8izzftk0D2CDcioSu"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);