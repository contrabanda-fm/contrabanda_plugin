<?php
/**
 * Plugin Name:       Contrabanda
 * Plugin URI:        https://github.com/contrabanda-fm/contrabanda_plugin
 * Description:       A wp plugin to handle the radio schedule and programs.
 * Version:           1.0.0
 * Author:            Bacterio
 * Text Domain:       contrabanda
 * Domain Path:       /languages
 */

function contrabanda_plugin_styles() {
    wp_register_style( 'contrabanda-plugin-styles', plugin_dir_url(__FILE__).'build/css/style.css' );
    wp_enqueue_style( 'contrabanda-plugin-styles' );
}
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'contrabanda_plugin_styles' );
//Helper functions
require_once('lib/helpers.php');
//Registrar programes cpt
require_once('lib/programes_cpt.php');
//Registrar custom fields de programes
require_once('lib/programes_cfs.php');
//Add program metas
require_once('lib/programes_filters.php');
//Registrar custom fields de la graella
require_once('lib/graella_cfs.php');
//Display graella
require_once('lib/graella_display.php');
//Display programes


 ?>