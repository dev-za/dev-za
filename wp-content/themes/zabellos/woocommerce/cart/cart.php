<script type="text/javascript">
    function removeProduct(a, productId){
        //change quantity
        var qtyFld = $('input[name="cart['+productId+'][qty]"]');
        $(qtyFld).val(qtyFld.val() - 1);
        console.log('new val', qtyFld.val());
        //hide product block
        $(a).parent().parent('.block-1').hide();

        //submit form
        $('form')
            .append('<input type="submit" class="button" name="update_cart" value="Update Cart">' +
            '<input type="hidden" id="_wpnonce" name="_wpnonce" value="02c0f334bf">'

        );
        $('input[name="update_cart"]').click();

        return false;
    }


</script>

<?php
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

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
    <div class="your-cart-form">

        <div class="your-cart-form-header padding-right-40 back-c clearfix">
            <p class="pull-left">Item Description</p>
            <p class="pull-right">Price</p>
        </div>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>

                <input type="number" step="1" min="0" name="cart[<?php echo $cart_item_key?>][qty]" value="<?php echo $cart_item['quantity'];?>" title="Qty" class="product-quantity input-text qty text" size="4" hidden="">

                <?php
                //Products loop
                for($i = 1; $i <= $cart_item['quantity']; $i++){?>
                    <div class="block-1 clearfix padding-top-bottom-25">
                        <div class="pull-left">
                            <p class="h4">1 pair</p>
                            <div class="form-group">
                                <textarea class="form-control" name="pair" placeholder="your notes here (optional)"></textarea>
                            </div>
                        </div>
                        <div class="pull-right pair-glyph">
                            <p class="h3 pull-left"><?php
                                //Product Price
                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                ?></p>
                            <a href="#" onclick="return removeProduct(this, '<?php echo $cart_item_key?>');" class="remove-item-btn color-c8 h3 " title="Remove this item"><span class="glyphicon glyphicon-remove-circle"></span></a>
                        </div>
                    </div>
                <?php
                }
			}
		}

		?>


        <div class="block-2 padding-right-40 padding-top-bottom-25 clearfix">
            <button type="button" class="btn btn-primary pull-left">Add another pair</button>
            <p class="pull-right">Add another 2 pair to <span class="text-success">get discount!</span></p>
        </div>
        <div class="block-3 padding-right-40 padding-top-bottom-25 clearfix h4">
            <p class="pull-left">You save with your order:</p>
            <p class="pull-right text-success">-$19.00</p>
        </div>
        <div class="block-4 padding-right-40 padding-top-bottom-25">
            <p class="h4">Would you like shipping boxes mailed to you?</p>
            <div class="radio">
                <label>
                    <input type="radio" name="options" value="option1" checked>Yes, please send me FREE boxes
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="options" value="option2">No, I will use my own boxes
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
                    <table>
                        <tr>
                            <td class="text-muted ">Subtotal:</td>
                            <td>$138.00</td>
                        </tr>
                        <tr>
                            <td  class="text-muted">Shipping:</td>
                            <td>Grounf FREE</td>
                        </tr>
                        <tr>
                            <td  class="text-muted">Sales Tax (info):</td>
                            <td>$0.00</td>
                        </tr>
                        <tr>
                            <td  class="text-muted">Order Total:</td>
                            <td class="font-22"><strong>$138.00</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <p><a href="checkout.html" class="btn btn-danger pull-right">Continue checkout</a></p>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<?php woocommerce_cart_totals(); ?>

</div>


<?php do_action( 'woocommerce_after_cart' ); ?>
