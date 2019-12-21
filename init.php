<?php
/*
Plugin Name: Magyar kiegészítések Divi-hez
Plugin URI:  https://hellowp.io
Description: Magyar Divi beállítások (fordítás, megjelenés és egyéb fejlesztések)
=======
Version:     0.0.16as
Author:      HelloWP.io
Author URI:  https://hellowp.io/hu
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('MAGYAR_DIVI_DIR', trailingslashit(dirname(__FILE__)));
include_once ABSPATH . 'wp-admin/includes/plugin.php';


//// ** MODULOK BETÖLTÉSE

include ('modules/timeline.php');

// ** NYELVEK BETÖLTÉSE

if (wp_get_theme() == 'Divi' || wp_get_theme()->parent() == 'Divi' || strpos(@$theme->Name, 'Divi') !== false) {
// felülírjuk az eredeti magyar fordítáast

    add_action('plugins_loaded', 'load_magyar_nyelv_divi');
// szinkronizáljuk a WordPress dátumformátumával a Divi-t
    add_action('plugins_loaded', 'load_magyar_datum_divi');

    function load_magyar_nyelv_divi()
    {

        load_plugin_textdomain('Divi', false, dirname(plugin_basename(__FILE__)) . '/lang/');
        load_plugin_textdomain('et_builder', false, dirname(plugin_basename(__FILE__)) . '/lang/');
    }

    function load_magyar_datum_divi()
    {
        $get_divi_date_format                     = get_option('et_divi');
        $get_divi_date_format['divi_date_format'] = get_option('date_format');
        update_option('et_divi', $get_divi_date_format);
    }

//add_action('admin_menu', 'divi_magyarul_menu', 30);
    function divi_magyarul_menu()
    {
        global $page_options;
        add_submenu_page('et_divi_options', __('Divi magyarul', 'divi-magyarul'), __('Divi magyarul', 'divi-magyarul'), 'manage_options', 'divi_magyarul', 'divi_magyarul');
    }

}

if (wp_get_theme() == 'Extra' || wp_get_theme()->parent() == 'Extra' || strpos(@$theme->Name, 'Extra') !== false) {

    add_action('plugins_loaded', 'load_magyar_nyelv_extra');

    function load_magyar_nyelv_extra()
    {
        load_plugin_textdomain('extra', false, dirname(plugin_basename(__FILE__)) . '/lang/Extra-kicsi');
        load_plugin_textdomain('Extra', false, dirname(plugin_basename(__FILE__)) . '/lang/Extra-nagy/');
        load_plugin_textdomain('et_builder', false, dirname(plugin_basename(__FILE__)) . '/lang/');
        load_plugin_textdomain('et-core', false, dirname(plugin_basename(__FILE__)) . '/lang/');

    }
}

if (is_plugin_active('monarch/monarch.php')) {
    load_plugin_textdomain('Monarch', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}

if (is_plugin_active('bloom/bloom.php')) {
    load_plugin_textdomain('bloom', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}
