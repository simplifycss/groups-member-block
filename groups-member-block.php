<?php
/**
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

add_action( 'plugins_loaded', 'gmb_plugins_loaded' );

function gmb_plugins_loaded() {
	if ( class_exists( 'Groups_Access_Shortcodes' ) ) {
		require_once 'class-groups-member-block.php';}
;}
