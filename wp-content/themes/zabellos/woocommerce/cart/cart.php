<?php
global $wpdb;


//$results = $wpdb->get_results( 'SELECT * FROM  `wp_postmeta` WHERE  `post_id` =269 AND meta_key LIKE "_bulkdiscount_%"', OBJECT );
$results = $wpdb->get_results("SELECT * FROM `wp_options` WHERE `option_name` = 'woocommerce_t4m_discount_type'", OBJECT);

$discount_emabled = $results[0]->emabled;
$discount_type = $results[0]->option_value;

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
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('input[name="billing_shipping_boxes"]').change(function(){
            var checkoutBtn = $('#continue_checkout_button');
            var url = checkoutBtn.attr('href').split('billing_shipping_boxes=')[0];
            var newUrl = url + 'billing_shipping_boxes=' + $(this).val();
            checkoutBtn.attr('href', newUrl);
        });
    });


    
    function removeProduct(a, cartItemKey, productId){
        //change quantity
        changeFormQuantity(-1, cartItemKey);

        //submit form
        submitForm(function(){
            loadCartData(productId, function(cartData){
                updateCartForm(cartData);
                updatePrices(cartData.discount_price, a, removeProductBlock);
            });
        });

        return false;
    }

    function addProduct(a, cartItemKey, productId){
        //change quantity
        changeFormQuantity(1, cartItemKey);

        //submit form
        submitForm(function(){
            loadCartData(productId, function(cartData){
                updateCartForm(cartData);
                updatePrices(cartData.discount_price, null, addProductBlock);
                
            });
        });

        return false;
    }


    function changeFormQuantity(sub, productId){
//        var qtyFld = $('input[name="cart['+productId+'][qty]"]');
        var qtyFld = $('#product-qty-field');
        var oldNum = Number(qtyFld.val());
        var newNum = oldNum +sub;

        $(qtyFld).val(newNum);
    }

    function loadCartData(productId, callback){
        $.ajax({
            url: "http://"+document.location.hostname+"/wp-content/themes/zabellos/ajax/woocommerce.php?productId="+productId,
            context: document.body
        }).done(function(data) {

            if(typeof (callback) == 'function')
                callback(data);
        });
    }

    function updateCartForm(cart){


        $('#cart-subtotal').children('td').eq(1).html(cart.subtotal);
        $('#cart-tax-total').children('td').eq(1).html((cart.taxes)?cart.taxes:'$0.00');
        $('#cart-order-total').children('td').eq(1).html('<strong>'+cart.total+'</strong>');


        if(cart.discount_options){
            if(Number(cart.quantity) >= Number(cart.discount_options.quantity)){
                $('#get-discount-text').addClass('hide');
            }
            else{
                $('#get-discount-quantity').html(Number(cart.discount_options.quantity) - Number(cart.quantity));
                console.log($('#get-discount-text'));
                $('#get-discount-text').removeClass('hide');
            }
        }
        else{
            
        }


    }

    function submitForm(callback){
        var form = $('form');
        $.post($(form).attr('action'), $(form).serializeArray() , function(data){
            callback();
        });
    }

    function removeProductBlock(a){
        $(a).parent().parent('.block-1').remove();
    }

    function addProductBlock(){
        var block = $('.block-1').get(0).outerHTML;
        $(block).insertBefore($('.block-2'));
    }
    
    function updatePrices(newPrice, a, callback){
        $('div.pull-right.pair-glyph > p').html(newPrice);
        callback(a);
    }


</script>

<?php

/*$discountPlugin = new Woo_Bulk_Discount_Plugin_t4m();
var_dump($discountPlugin);
var_dump($discountPlugin->discount_coeffs);*/

/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
    <div class="your-cart-form">

        <div class="your-cart-form-header padding-right-40 back-c clearfix">
            <p class="pull-left">Item Description</p>
            <p class="pull-right">Price</p>
        </div>

		<?php
    
    $current_total = 0;
    $original_total = 0;
    
    
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      
      
      $current_total += $cart_item['line_total'];      
      
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );


			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>

                <input id="product-qty-field" name="cart[<?php echo $cart_item_key?>][qty]" value="<?php echo $cart_item['quantity'];?>" title="Qty" class="product-quantity input-text qty text" size="4" hidden="">


                <?php wp_nonce_field( 'woocommerce-cart' ); ?>
                <input type="hidden" class="button" name="update_cart" value="Update Cart">

                <?php
                //Products loop
                for($i = 1; $i <= $cart_item['quantity']; $i++){
                  $original_total += $_product->price;
                  
                  ?>
                    <div class="block-1 clearfix padding-top-bottom-25">
                        <div class="pull-left">
                            <p class="h4">1 pair</p>
                            <div class="form-group">
                                <textarea class="form-control" name="cart[<?php echo $cart_item_key?>][notes]" placeholder="your notes here (optional)"></textarea>
                            </div>
                        </div>
                        <div class="pull-right pair-glyph">
                            <p class="h3 pull-left"><?php
                                //Product Price
                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                ?></p>
                            <a href="#" onclick="return removeProduct(this, '<?php echo $cart_item_key?>', <?php echo $_product->id?>);" class="remove-item-btn color-c8 h3 " title="Remove this item"><span class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>
                    </div>
                <?php
                }
			}
      
		}

		?>


        <div class="block-2 padding-right-40 padding-top-bottom-25 clearfix">
            <button type="button" class="btn btn-primary pull-left" onclick="addProduct(this, null, <?php echo $_product->id?>);">Add another pair</button>
            
            <?php 
            
            
            $product_discount_options = product_discount_options($_product->id);
            
            if($product_discount_options){
              if($cart_item['quantity'] < $product_discount_options->quantity){

                  $disc_message_cls = '';
              } else {
                  $disc_message_cls = 'hide';
              }
            }
            ?>
            <p id="get-discount-text" class="pull-right <?php echo $disc_message_cls?>">Add another <span id="get-discount-quantity"><?php echo ($product_discount_options->quantity - $cart_item['quantity']) ?></span> pair to <span class="text-success">get discount!</span></p>

        </div>
        <?php
          //calculate discount
          if($original_total > $current_total){
            $discount = $original_total - $current_total;
            $discount_info_cls = '';
          }
          else{
            $discount = 0;
            $discount_info_cls = 'hide';
          }
        
        ?>
        
        <div class="block-3 padding-right-40 padding-top-bottom-25 clearfix h4 <?php echo $discount_info_cls?>">
            <p class="pull-left">You save with your order:</p>
            <p class="pull-right text-success">$<?php echo number_format($discount, 2);?></p>
        </div>

        <div class="block-4 padding-right-40 padding-top-bottom-25">
            <p class="h4">Would you like shipping boxes mailed to you?</p>
            <div class="radio">
                <label>
                    <input type="radio" name="billing_shipping_boxes" value="yes" checked>Yes, please send me FREE boxes
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="billing_shipping_boxes" value="no">No, I will use my own boxes
                </label>
            </div>
        </div>
        <div class="block-5 padding-right-40 padding-top-bottom-25 clearfix back-c">

            <div class="pull-left col-sm-6">
                <?php if ( WC()->cart->coupons_enabled() ) { ?>
                    <p class="h4">Have a promo code?</p>
                    <div class="form-group">

<!--                        <label class="sr-only"  for="coupon_code">Promo Code</label>-->
                        <label class="sr-only" for="Idpromokod">Promo Code</label>


<!--                        <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="--><?php //_e( 'Coupon code', 'woocommerce' ); ?><!--" />-->
                        <input type="text" class="form-control" id="Idpromokod" name="coupon_code"  placeholder="Promo Code"/>
                    </div>

<!--                    <input type="submit" class="button" name="apply_coupon" value="--><?php //_e( 'Apply Coupon', 'woocommerce' ); ?><!--" />-->
                    <input type="submit" value="Apply" class="btn  btn-primary" name="apply_coupon" />

                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                <?php } ?>



            </div>


            <div class="pull-right col-sm-6">
                <div class="row">
<!--                    --><?php //do_action( 'woocommerce_cart_collaterals' ); ?>

                    <?php woocommerce_cart_totals(); ?>
                </div>
            </div>



        </div>
    </div>

    <p>
        <a id="continue_checkout_button" href="<?php echo home_url()?>/checkout/?billing_shipping_boxes=yes" class="btn btn-danger pull-right">Continue checkout</a>
    </p>

</form>

<!--<div class="cart-collaterals">

	<?php /*do_action( 'woocommerce_cart_collaterals' ); */?>

	<?php /*woocommerce_cart_totals(); */?>

</div>-->


<?php do_action( 'woocommerce_after_cart' ); ?>
