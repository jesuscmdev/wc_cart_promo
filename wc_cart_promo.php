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

add_action('wp_head', 'add_gsap', 10);

function add_gsap()
{
    echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js'></script>";
}
