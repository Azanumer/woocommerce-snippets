<?php
/**
 * Change the add-to-cart button text per product type.
 *
 * Drop into your child theme's functions.php or a code-snippets plugin.
 * Requires WooCommerce.
 *
 * Simple products:  "Add to cart"  -> "Add to bag"
 * Variable products: "Select options" -> "Choose options"
 * Grouped products:  "View products"  -> "View the set"
 * External products: "Buy product"    -> "Buy from partner"
 *
 * The filter passes the product object, so you can branch on anything else
 * (category, stock status, price) the same way.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'woocommerce_product_add_to_cart_text', function ( $text, $product ) {
    switch ( $product->get_type() ) {
        case 'simple':
            return __( 'Add to bag', 'your-textdomain' );
        case 'variable':
            return __( 'Choose options', 'your-textdomain' );
        case 'grouped':
            return __( 'View the set', 'your-textdomain' );
        case 'external':
            return __( 'Buy from partner', 'your-textdomain' );
        default:
            return $text;
    }
}, 10, 2 );

// Same labels on the single-product page (the loop filter above only
// covers shop/archive pages).
add_filter( 'woocommerce_product_single_add_to_cart_text', function ( $text, $product ) {
    if ( $product->is_type( 'simple' ) ) {
        return __( 'Add to bag', 'your-textdomain' );
    }
    return $text;
}, 10, 2 );
