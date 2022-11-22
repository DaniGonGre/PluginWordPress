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
 * Remplaza palabras misPlugins por *
 */
function cambiar_malsonantes ($text) {
    $palabraMalsonantes = array('joder', 'mierda', 'caca', 'tonto', 'cabron');
    $palabra = str_replace($palabraMalsonantes, '*****', $text);

    return $palabra;

}
add_filter('the_content', 'cambiar_malsonantes');

/*
 * Añade una tabla a la Base de datos
 */

function myplugin_update_db_check()
{
    // Objeto global del WordPress para trabajar con la BD
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    // le añado el prefijo a la tabla
    $tablaDam = $wpdb->prefix . 'dam';

    // creamos la sentencia sql
    $sql = "CREATE TABLE $tablaDam (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        name tinytext NOT NULL,
        text text NOT NULL,
        url varchar(55) DEFAULT '' NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // libreria que necesito para usar la funcion dbDelta
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // creamos variables para insertar valores

    $nombre = 'Dani';
    $texto = 'Buenas tardes';

    $resultado = $wpdb->insert(
        $tablaDam,
        array(
            'tiempo' => current_time('mysql'),
            'nombre' => $nombre,
            'texto' => $texto,
        )
    );

    error_log("Plugin DAM insert: " . $resultado);

    /**
     * Ejecuta 'myplugin_update_db_check', cuando el plugin se carga
     */
    add_action('plugins_loaded', 'myplugin_update_db_check');

}