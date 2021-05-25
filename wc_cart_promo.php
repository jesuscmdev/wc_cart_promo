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

add_filter('woocommerce_get_price', 'aplica_precio_especial', 10, 2);

function aplica_precio_especial($price, $product)
{
    if (!is_user_logged_in()) return $price;
    $pedidos = numPedidos();
    if ($pedidos > 0) {
        $price = 0;
    }
    return $price;
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
