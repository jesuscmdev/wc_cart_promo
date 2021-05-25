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

    // if (!is_user_logged_in()) return $price;

    // Listado de productos con precio especial
    $product_list = array();

    // % Descuento a aplicar
    $discount = 10;

    // Comprueba si el producto actual pertenece a la lista
    if (in_array($product->id, $product_list) || empty($product_list)) {

        // Comprueba si el usuario tiene precio especial
        // if (usuario_con_precio_especial('cliente_vip')) {
        //     $price = $price * (100 - $discount) / 100;
        // }


    }
    $price = 0;
    return $price;
}

function usuario_con_precio_especial($role = '', $user_id = null)
{

    if (is_numeric($user_id)) {
        $user = get_user_by('id', $user_id);
    } else {
        $user = wp_get_current_user();
    }

    if (empty($user)) {
        return false;
    }
    $args = array(
        'customer_id' => $user
    );
    $orders = wc_get_orders($args);


    // return in_array($role, (array) $user->roles);
    return $orders;
}
