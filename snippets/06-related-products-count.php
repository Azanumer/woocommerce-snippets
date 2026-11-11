<?php
/**
 * Customise related products: change the count and columns.
 *
 * Drop into your child theme's functions.php or a code-snippets plugin.
 * Requires WooCommerce.
 *
 * Default WooCommerce shows 4 related products in 4 columns. This changes
 * it to 3 products in 3 columns — and shows how to remove the section
 * entirely (uncomment the last filter).
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Change how many related products are shown.
add_filter( 'woocommerce_output_related_products_args', function ( $args ) {
    $args['posts_per_page'] = 3;
    $args['columns']        = 3;
    return $args;
} );

// Uncomment to remove the related products section completely:
// add_action( 'woocommerce_after_single_product_summary', function () {
//     remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
// }, 1 );
