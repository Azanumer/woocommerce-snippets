<?php
/**
 * Rename & reorder WooCommerce product tabs.
 *
 * Drop into your child theme's functions.php or a code-snippets plugin.
 * Requires WooCommerce.
 *
 * Changes:
 *  - "Description" tab  -> "About this product"
 *  - "Additional information" tab -> "Details"
 *  - "Reviews" tab stays last, relabelled "Customer reviews"
 *  - Tab order: Description, Details, Reviews
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'woocommerce_product_tabs', function ( $tabs ) {
    // Rename.
    if ( isset( $tabs['description'] ) ) {
        $tabs['description']['title'] = __( 'About this product', 'your-textdomain' );
    }
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = __( 'Details', 'your-textdomain' );
    }
    if ( isset( $tabs['reviews'] ) ) {
        $tabs['reviews']['title'] = __( 'Customer reviews', 'your-textdomain' );
    }

    // Reorder (lower priority = earlier tab).
    $order = array(
        'description'            => 10,
        'additional_information' => 20,
        'reviews'                => 30,
    );
    foreach ( $order as $key => $priority ) {
        if ( isset( $tabs[ $key ] ) ) {
            $tabs[ $key ]['priority'] = $priority;
        }
    }

    return $tabs;
} );
