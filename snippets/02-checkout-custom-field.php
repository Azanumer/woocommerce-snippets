<?php
/**
 * Add a custom field to WooCommerce checkout and save it to the order.
 *
 * Drop into your child theme's functions.php or a code-snippets plugin.
 * Requires WooCommerce.
 *
 * Adds a "Delivery instructions" textarea after the order notes, saves it as
 * order meta (_delivery_instructions), and shows it in the admin order screen.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Add the field after the order notes.
add_filter( 'woocommerce_checkout_fields', function ( $fields ) {
    $fields['order']['delivery_instructions'] = array(
        'type'        => 'textarea',
        'label'       => __( 'Delivery instructions', 'your-textdomain' ),
        'placeholder' => __( 'e.g. Leave the parcel with the neighbour…', 'your-textdomain' ),
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'priority'    => 130, // Right after order_comments (120).
        'clear'       => true,
    );
    return $fields;
} );

// 2. Save it when the order is created (WooCommerce 3.0+ / HPOS-safe).
add_action( 'woocommerce_checkout_create_order', function ( $order, $data ) {
    if ( ! empty( $data['delivery_instructions'] ) ) {
        $order->update_meta_data( '_delivery_instructions', sanitize_textarea_field( $data['delivery_instructions'] ) );
    }
}, 10, 2 );

// 3. Show it in the admin order screen.
add_action( 'woocommerce_admin_order_data_after_billing_address', function ( $order ) {
    $instructions = $order->get_meta( '_delivery_instructions' );
    if ( '' !== $instructions ) {
        echo '<p><strong>' . esc_html__( 'Delivery instructions:', 'your-textdomain' ) . '</strong><br>' . esc_html( $instructions ) . '</p>';
    }
} );
