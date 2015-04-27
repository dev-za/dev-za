<?php
require('../../../../wp-load.php');
$response = new StdClass();
$cart = WC()->cart;
$response->currency = get_woocommerce_currency();
$response->total = $cart->get_cart_total();
$response->subtotal = $cart->get_cart_subtotal();
$response->taxes = $cart->get_cart_tax();
$response->discount = $cart->get_total_discount();
$response->quantity = $cart->cart_contents_count;
$response->shipping = WC()->shipping();
if(!empty($_REQUEST['productId']) && ($product_id = intval($_REQUEST['productId']))){
    $response->discount_options = product_discount_options($product_id );
}


foreach($cart->cart_contents as $cart_item_key => $cart_item){
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    $response->discount_price = apply_filters( 'woocommerce_cart_item_price', $cart->get_product_price( $_product ), $cart_item, $cart_item_key );
//    $response->quantity += $_product->


}

header('Content-Type: application/json');
echo json_encode($response);

function product_discount_options($product_id){
  if($product_id){
    
    global $wpdb;
    $query = "SELECT meta_key, meta_value FROM  `wp_postmeta` 
    WHERE  `post_id` = " . $product_id . " AND (meta_key = '_bulkdiscount_quantity_1' OR meta_key = '_bulkdiscount_discount_1' OR meta_key = '_bulkdiscount_enabled')";

    $results = $wpdb->get_results($query, OBJECT);
    
    $translate = Array('_bulkdiscount_quantity_1' => 'quantity', '_bulkdiscount_discount_1' => 'discount', '_bulkdiscount_enabled' => 'enabled');
    
    $options = new StdClass();
    
    $options->product_id = $product_id;

    foreach($results as $row){
      $options->{$translate[$row->meta_key]} = $row->meta_value;
    }
    
    if(strtolower($options->enabled) == 'yes'){
      return $options;
    } else {
      return false;
    }
    
  } else {
    return false;
  }
  
  
}
