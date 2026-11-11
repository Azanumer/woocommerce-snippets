<?php
/**
 * Hide prices and the add-to-cart button for logged-out visitors.
 *
 * Drop into your child theme's functions.php or a code-snippets plugin.
 * Requires WooCommerce.
 *
 * Useful for wholesale / members-only stores: guests see "Login to see
 * prices" instead of the price, and the add-to-cart button is removed.
 * Logged-in customers see everything normally.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Replace the price with a login prompt for guests.
add_filter( 'woocommerce_get_price_html', function ( $price_html, $product ) {
    if ( is_user_logged_in() ) {
        return $price_html;
    }
    $login_url = wp_login_url( get_permalink( $product->get_id() ) );
    return sprintf(
        '<a href="%s">%s</a>',
        esc_url( $login_url ),
        esc_html__( 'Login to see prices', 'your-textdomain' )
    );
}, 10, 2 );

// Remove the add-to-cart button for guests (single product + loops).
add_action( 'woocommerce_single_product_summary', function () {
    if ( ! is_user_logged_in() ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
}, 1 );
add_filter( 'woocommerce_loop_add_to_cart_link', function ( $link, $product ) {
    if ( is_user_logged_in() ) {
        return $link;
    }
    return '';
}, 10, 2 );
