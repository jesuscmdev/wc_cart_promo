<?php
/* 
Plugin Name: wc_cart_promo
Plugin URI: https://alpha.jesuscm.dev
Description: Agregar una promoción en base al número de pedidos de un usuario WC
Version: 1.0 
Author: Jesus Cortes
Author URI: https://jesuscm.dev
License: GPLv2 
*/

// param 1: hook, param 2: function, param 3: prioridad, param 4: parametros de la funcion



add_action('woocommerce_add_to_cart', 'woocustom_add_product_to_cart', 10, 2);

function woocustom_add_product_to_cart()
{
    global $woocommerce;
    // if (!is_user_logged_in()) return false;

    $pedidos = numPedidos();

    if ($pedidos >= 4) {
        $product_id = 48;
        $found = false;

        //check if product already in cart
        if (sizeof(WC()->cart->get_cart()) > 0) {
            foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
                $_product = $values['data'];
                if ($_product->id == $product_id)
                    $found = true;
            }
            // if product not found, add it
            if (!$found)
                WC()->cart->add_to_cart($product_id);
        } else {
            // if no products in cart, add it
            WC()->cart->add_to_cart($product_id);
        }
    }
}

function numPedidos($user_id = null)
{
    $orders = get_posts(apply_filters('woocommerce_my_account_my_orders_query', array(
        'numberposts' => -1,
        'meta_key' => '_customer_user',
        'meta_value' => get_current_user_id(),
        'post_type' => wc_get_order_types('view-orders'),
        'post_status' => array_keys(wc_get_order_statuses())
    )));
    return count($orders);
}
