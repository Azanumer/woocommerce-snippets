<?php
/**
 * "You're $X away from free shipping" notice on the cart page.
 *
 * Drop into your child theme's functions.php or a code-snippets plugin.
 * Requires WooCommerce.
 *
 * Reads the free-shipping threshold from your shipping zone's "Free
 * shipping" method (minimum order amount), so it stays in sync with the
 * setting — no hardcoded amount. When the threshold is reached it shows a
 * green "You've unlocked FREE shipping" message instead.
 *
 * Set FREE_SHIPPING_METHOD_ID below if your method ID differs (default:
 * 'free_shipping').
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WCS_FREE_SHIPPING_METHOD_ID', 'free_shipping' );

add_action( 'woocommerce_before_cart', function () {
    if ( WC()->cart->is_empty() ) {
        return;
    }

    // Find the free-shipping threshold from the shipping zones.
    $threshold = 0;
    $zones     = WC_Shipping_Zones::get_zones();
    $zones[]   = array( 'zone_id' => 0 ); // "Rest of the world" zone.
    foreach ( $zones as $zone_data ) {
        $zone = new WC_Shipping_Zone( $zone_data['zone_id'] );
        foreach ( $zone->get_shipping_methods() as $method ) {
            if ( WCS_FREE_SHIPPING_METHOD_ID === $method->id && 'yes' === $method->enabled ) {
                $min = (float) $method->get_option( 'min_amount', 0 );
                if ( $min > 0 ) {
                    $threshold = $min;
                    break 2;
                }
            }
        }
    }

    if ( $threshold <= 0 ) {
        return; // No free-shipping method with a minimum amount configured.
    }

    $cart_total = (float) WC()->cart->get_subtotal();
    $remaining  = $threshold - $cart_total;

    if ( $remaining > 0 ) {
        wc_print_notice(
            sprintf(
                /* translators: %s: remaining amount, e.g. $12.50. */
                __( 'Add %s more to unlock FREE shipping!', 'your-textdomain' ),
                wc_price( $remaining )
            ),
            'notice'
        );
    } else {
        wc_print_notice(
            __( 'You have unlocked FREE shipping!', 'your-textdomain' ),
            'success'
        );
    }
} );
