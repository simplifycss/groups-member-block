<?php
/**
<<<<<<< HEAD
=======
 *
 * @link              https://author.url
 * @since             1.0.0
 * @package           Groups_Member_Block
 *
 * @wordpress-plugin
 * Plugin Name:       Groups Member Block
 * Plugin URI:        https://plugin.site
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Denitsa Slavcheva
 * Author URI:        https://author.url
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       groups-member-block
 * Domain Path:       /languages
 */

/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
>>>>>>> 457352e82631dab0123a92215a02d58ecced46e4
 *
 * @link              https://author.url
 * @since             1.0.0
 * @package           Groups_Member_Block
 *
 * @wordpress-plugin
 * Plugin Name:       Groups Member Block
 * Plugin URI:        https://plugin.site
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Denitsa Slavcheva
 * Author URI:        https://author.url
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       groups-member-block
 * Domain Path:       /languages
 */

 if ( !defined( 'ABSPATH' ) ) {
	exit;
}

<<<<<<< HEAD
add_action( 'plugins_loaded', 'gmb_plugins_loaded' );

function gmb_plugins_loaded() {
	if ( class_exists( 'Groups_Access_Shortcodes' ) ) {
		require_once 'class-groups-member-block.php';}
;}
=======
Groups_Member_Block::init();
>>>>>>> 457352e82631dab0123a92215a02d58ecced46e4
