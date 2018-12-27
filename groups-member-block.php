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
 * @package groups
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
class Groups_Member_Block extends Groups_Access_Shortcodes {
    public static function init() {
        add_action( 'init', array( __CLASS__, 'groups_member_block_block_init' ) );
        
    }
    
    public static function groups_member_block_block_init() {
        
        // Skip block registration if Gutenberg is not enabled/merged.
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }
        $dir = dirname( __FILE__ );
        
        $index_js = 'groups-member-block/index.js';
        wp_register_script(
            'groups-member-block-block-editor',
            plugins_url( $index_js, __FILE__ ),
            array(
                'wp-blocks',
                'wp-i18n',
                'wp-element',
            ),
            filemtime( "$dir/$index_js" )
            );
        
        $editor_css = 'groups-member-block/editor.css';
        wp_register_style(
            'groups-member-block-block-editor',
            plugins_url( $editor_css, __FILE__ ),
            array(),
            filemtime( "$dir/$editor_css" )
            );
        
        $style_css = 'groups-member-block/style.css';
        wp_register_style(
            'groups-member-block-block',
            plugins_url( $style_css, __FILE__ ),
            array(),
            filemtime( "$dir/$style_css" )
            );
        
        register_block_type( 'groups/groups-member-block', array(
            'editor_script' => 'groups-member-block-block-editor',
            'editor_style'  => 'groups-member-block-block-editor',
            'style'         => 'groups-member-block-block',
            'attributes' => array(
                'group'             => array(
                    'type' => 'string',
                    'default' => 'Registered'
                ),
                'content' => array(
                    'type' => 'string',
                    'default' => ''
                )
            ),
            'render_callback' => array( __CLASS__, 'groups_member')
        ) );
    }
}

Groups_Member_Block::init();
