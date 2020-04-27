<?php

require_once "includes/paypalConfig.php";
require_once "billingPlan.php";

$id = $plan->getId();

use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;

// Create new agreement
$agreement = new Agreement();
$agreement->setName('Subscription to Damianflix')
    ->setDescription('$1 setup fee and then Recurring payments of $9.99 to Damianflix')
    ->setStartDate(gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 month", time())));

// Set plan id
$plan = new Plan();
$plan->setId($id);
$agreement->setPlan($plan);

// Add payer type
$payer = new Payer();
$payer->setPaymentMethod('paypal');
$agreement->setPayer($payer);

// Adding shipping details
// $shippingAddress = new ShippingAddress();
// $shippingAddress->setLine1('111 First Street')
//     ->setCity('Saratoga')
//     ->setState('CA')
//     ->setPostalCode('95070')
//     ->setCountryCode('US');
// $agreement->setShippingAddress($shippingAddress);

try {
    // Create agreement
    $agreement = $agreement->create($apiContext);

    // Extract approval URL to redirect user
    $approvalUrl = $agreement->getApprovalLink();
    header("Location: $approvalUrl");
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}
