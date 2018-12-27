<?php
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
            'render_callback' => array( __CLASS__, 'block')
        ) );
    }

 public static function block( $atts, $content = '' ) {
        $output = '';
        $defaults = array(
            'group'  => 'Registered',
            'content'     => ''
        );

        $options = shortcode_atts( $defaults, $atts );
        
        $show_content = false;
         if ( strlen( $options['content'] ) > 0 && strlen( $content ) === 0 ) {
            $content = $options['content'];
        }
        if ( $content !== null ) {
            $groups_user = new Groups_User( get_current_user_id() );
            $groups = explode( ',', $options['group'] );
            foreach ( $groups as $group ) {
                $group = trim( $group );
                $current_group = Groups_Group::read( $group );
                if ( !$current_group ) {
                    $current_group = Groups_Group::read_by_name( $group );
                }
                if ( $current_group ) {
                    if ( Groups_User_Group::read( $groups_user->user->ID , $current_group->group_id ) ) {
                        $show_content = true;
                        break;
                    }
                }
            }
            if ( $show_content ) {
                remove_shortcode( 'groups_member' );
                $content = do_shortcode( $content );
                add_shortcode( 'groups_member', array( __CLASS__, 'groups_member' ) );
                $output = $content;
            }
        }
        if (
            strlen( $output ) === 0 &&
            is_user_logged_in() &&
            defined( 'REST_REQUEST' ) && REST_REQUEST && isset( $_REQUEST['context'] ) && $_REQUEST['context'] === 'edit'
        ) {
            $output .= '<div style="display:none"></div>';
        }
        return $output;
    }
    
}

Groups_Member_Block::init();