<?php

/*
Plugin Name: Cambiar Malsonantes
Plugin URI: http://wordpress.org/plugins/malsonantes/
Description: Busca palabras mal sonantes y las cambia por otras más cool.
Author: Juan Carlos
Version: 1.0
Author URI: https://realmadrid.com
*/

/*
 * Remplaza palabras malsonantes por *
 */
function cambiar_malsonantes ($text) {
    $palabraMalsonantes = array('joder', 'mierda', 'caca', 'tonto', 'cabron');
    $palabra = str_replace($palabraMalsonantes, '*****', $text);

    return $palabra;

}
add_filter('the_content', 'cambiar_malsonantes');
