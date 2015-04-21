<?php
require('../../../../wp-load.php');
$response = new StdClass();
$response->cartData = WC()->cart;
$response->currency = get_woocommerce_currency();
$response->total = WC()->cart->get_cart_total();
$response->subtotal = WC()->cart->get_cart_subtotal();
$response->taxes = WC()->cart->get_cart_tax();
$response->discount = WC()->cart->get_total_discount();
$response->shipping = WC()->shipping();
header('Content-Type: application/json');

echo json_encode($response);