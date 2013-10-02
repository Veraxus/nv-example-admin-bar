<?php
/*
Plugin Name: NOUVEAU Admin Bar Tweaks
Plugin URI: http://nouveauframework.com/plugins/
Description: Tweak the WordPress admin bar.
Version: 0.1
Author: Veraxus
Author URI: http://nouveauframework.com/
License: GPLv2 or later
*/

NV_Admin_Bar::init();

class NV_Admin_Bar {


    public static function init() {
        add_action( 'admin_bar_menu'            , array( __CLASS__, 'howdy' ) );
        add_action('wp_before_admin_bar_render' , array( __CLASS__, 'menus' ) );
    }

    /**
     * Allows quick customization of the admin bar "Account" box. This is especially helpful for replacing the "Howdy" with
     * something more appropriate to the site.
     *
     * Used by the hook: admin_bar_menu
     *
     * @see add_action('admin_bar_menu',$func,20)
     *
     * @param \WP_Admin_Bar $wp_admin_bar
     *
     * @since Nouveau 1.0
     */
    public static function howdy( $wp_admin_bar ) {

        $message      = __( 'Hello, %1$s', 'nvLangScope' ); //Change this to change your message
        $user_id      = get_current_user_id();
        $current_user = wp_get_current_user();
        $profile_url  = get_edit_profile_url( $user_id );

        if ( !empty( $user_id ) ) {
            /* Add the "My Account" menu */
            $avatar = get_avatar( $user_id, 28 );
            $howdy  = sprintf( $message, $current_user->display_name );
            $class  = empty( $avatar ) ? '' : 'with-avatar';

            $wp_admin_bar->add_menu( array(
                  'id'     => 'my-account',
                  'parent' => 'top-secondary',
                  'title'  => $howdy . $avatar,
                  'href'   => $profile_url,
                  'meta'   => array(
                      'class' => $class,
                  ),
             ) );

        }
    }



    /**
     * Customizes the admin bar.
     *
     * Used by the hook: wp_before_admin_bar_render
     *
     * @global WP_Admin_Bar $wp_admin_bar
     * @since Nouveau 1.0
     */
    public static function menus() {
        global $wp_admin_bar;

        // Add a top-level item...
        /*
        $wp_admin_bar->add_menu(array(
             'id'        => 'theme-customize',          // slug/unique id for the menu item
             'title'     => __('Customize Theme', 'nvLangScope'), // visible text for the menu item
             'href'      => admin_url('customize.php'), // the link/url for the menu item
             'meta'      => false,                      // assoc array of extra html attributes: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
        ));
        */

        // Add an item under the + New menu...
        /*
        $wp_admin_bar->add_menu(array(
            'parent'    => 'new-content',               // false for a main item, or parents id for a submenu item
            'id'        => 'new-plugin',                // slug/unique id for the menu item
            'title'     => __('Plugin', 'nvLangScope'), // visible text for the menu item
            'href'      => admin_url('plugin-install.php'), // the link/url for the menu item
            'meta'      => false,                       // assoc array of extra html attributes: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
        ));
        */

        // Remove items from the admin bar
        $wp_admin_bar->remove_menu( 'wp-logo' );        // WordPress logo
        //$wp_admin_bar->remove_menu( 'site-name' );    // The name of your site
        //$wp_admin_bar->remove_menu( 'comments' );     // Comments button
        //$wp_admin_bar->remove_menu( 'new-content' );  // The + New button
        //$wp_admin_bar->remove_menu( 'my-account' );   // The "My Account" dropdown
        //$wp_admin_bar->remove_menu( 'search' );       // The search icon


        if ( is_admin() ) {
            //Admin-only admin bar changes go here
        }
        else {
            //Front-end only admin bar changes go here
        }

    }


}