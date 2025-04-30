<?php

/**
 * Plugin Name:         Hide Titles
 * Plugin URI:          https://wordpress.org/plugins/hide-titles/
 * Description:         Remove Titles from Posts and Single Pages on WordPress.
 * Version:             1.8.2
 * Requires at least:   4.4
 * Requires PHP:        7.0
 * Tested up to:        6.8
 * Author:              Mehraz Morshed
 * Author URI:          https://profiles.wordpress.org/mehrazmorshed/
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         hide-titles
 * Domain Path:         /languages
 */

/**
 * Hide Titles is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 
 * of the License, or (at your option) any later version.
 * 
 * Hide Titles is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License 
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Load the text-domain
function hide_titles_load_textdomain() {
    load_plugin_textdomain( 'hide-titles', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action( 'init', 'hide_titles_load_textdomain' );

function hide_titles_option_page() {

    add_menu_page( 'Hide Titles', 'Hide Titles', 'manage_options', 'hide-titles', 'hide_titles_create_page', 'dashicons-admin-plugins', 101 );
}
add_action( 'admin_menu', 'hide_titles_option_page' );

function hide_titles_style_settings() {

    wp_enqueue_style( 'hide-titles-settings', plugins_url( 'css/hide-titles-settings.css', __FILE__ ), false, "1.0.0" );
}
add_action( 'admin_enqueue_scripts', 'hide_titles_style_settings' );

function hide_titles_create_page() {
    ?>
    <div class="hide_titles_main">
        <div class="hide_titles_body hide_titles_common">
            <h1 id="page-title"><?php esc_attr_e( 'Settings', 'hide-titles' ); ?></h1>
            <form action="options.php" method="post">
                <?php wp_nonce_field( 'update-options' ); ?>

                <!-- Hide Titles -->
                <label for="hide-titles-option"><?php esc_attr_e( 'Hide Titles Option:', 'hide-titles' ); ?></label>

                <label class="radios">
                    <input type="radio" name="hide-titles-option" id="hide-titles-option-nothing" value="nothing" <?php if( get_option( 'hide-titles-option' ) == 'nothing' ) { echo 'checked="checked"'; } ?>>
                    <span><?php _e( 'Show All Titles', 'hide-titles' ); ?></span>
                </label>

                <label class="radios">
                    <input type="radio" name="hide-titles-option" id="hide-titles-option-all" value="all" <?php if( get_option( 'hide-titles-option' ) == 'all' ) { echo 'checked="checked"'; } ?>>
                    <span><?php _e( 'Hide All Titles', 'hide-titles' ); ?></span>
                </label>

                <!--  -->
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="page_options" value="hide-titles-option">

                <input class="button button-primary" type="submit" name="submit" value="<?php _e( 'Save Changes', 'hide-titles' ) ?>">
            </form>

            <br>
            <hr>
            <br>
                <label class="">
                    <span>
                        <?php _e( '🎉 New Feature 🎉 Hide Title From Single Post / Page:', 'hide-titles' ); ?>
                    </span>
                </label>
                    <img class="screenshot" src="<?php print plugin_dir_url( __FILE__ ) . '/img/single.png'; ?>">
        </div>
        <div class="hide_titles_aside hide_titles_common">
            <!-- about plugin author -->
            <h2 class="aside-title"><?php esc_attr_e( 'About Plugin Author', 'hide-titles' ); ?></h2>
            <div class="author-card">
                <a class="link" href="https://profiles.wordpress.org/mehrazmorshed/" target="_blank">
                    <img class="center" src="<?php print plugin_dir_url( __FILE__ ) . '/img/author.png'; ?>" width="128px">
                    <h3 class="author-title"><?php esc_attr_e( 'Mehraz Morshed', 'hide-titles' ); ?></h3>
                    <h4 class="author-title"><?php esc_attr_e( 'WordPress Developer', 'hide-titles' ); ?></h4>
                </a>
                <h1 class="author-title">
                    <a class="link" href="https://www.facebook.com/mehrazmorshed" target="_blank"><span class="dashicons dashicons-facebook"></span></a>
                    <a class="link" href="https://twitter.com/mehrazmorshed" target="_blank"><span class="dashicons dashicons-twitter"></span></a>
                    <a class="link" href="https://www.linkedin.com/in/mehrazmorshed" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>
                    <a class="link" href="https://www.youtube.com/@mehrazmorshed" target="_blank"><span class="dashicons dashicons-youtube"></span></a>
                </h1>
            </div>
            <!-- other useful plugins -->
            <h3 class="aside-title"><?php esc_attr_e( 'Other Useful Plugins', 'hide-titles' ); ?></h3>
            <div class="author-card">
                <a class="link" href="https://wordpress.org/plugins/turn-off-comments/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Disable Comments', 'hide-titles' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/hide-admin-navbar/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Hide Admin Toolbar', 'hide-titles' ) ?></b>
                </a>
                <hr>
                <a class="link" href="https://wordpress.org/plugins/about-post-author/" target="_blank">
                    <span class="dashicons dashicons-admin-plugins"></span> <b><?php _e( 'Simple Author Box', 'hide-titles' ) ?></b>
                </a>
            </div>
            <!-- donate to this plugin -->
            <h3 class="aside-title"><?php esc_attr_e( 'Hide Titles', 'hide-titles' ); ?></h3>
            <a class="link" href="https://www.buymeacoffee.com/mehrazmorshed" target="_blank">
                <button class="button button-primary btn"><?php esc_attr_e( 'Donate To This Plugin', 'hide-titles' ); ?></button>
            </a>
            <p style="text-align: center;"><b>OR</b></p>
            <a class="link" href="https://wordpress.org/support/plugin/hide-titles/reviews/?filter=5#new-post" target="_blank">
                <button class="button button-primary btn"><?php esc_attr_e( 'Leave a Review', 'hide-titles' ); ?></button>
            </a>
        </div>
    </div>
    
    <?php
}

if( get_option( 'hide-titles-option' ) == 'all' ) {

    function hide_titles() {

        return false;
    }
    add_filter('the_title', 'hide_titles');
}

function hide_titles_plugin_activation() {

    add_option( 'hide_titles_plugin_do_activation_redirect', true );
}
register_activation_hook( __FILE__, 'hide_titles_plugin_activation' );

function hide_titles_plugin_redirect() {

    if( get_option( 'hide_titles_plugin_do_activation_redirect', false ) ) {

        delete_option( 'hide_titles_plugin_do_activation_redirect' );

        if ( !isset( $_GET['active-multi'] ) ) {

            wp_safe_redirect( admin_url( 'admin.php?page=hide-titles' ) );
            exit;
        }
    }
}
add_action( 'admin_init', 'hide_titles_plugin_redirect' );
/*********************************************************************/
add_action('add_meta_boxes', 'hide_titles_meta_box');
add_action('save_post', 'hide_titles_save_meta');
add_filter('the_title', 'hide_titles_filter_title', 10, 2);

// Add meta box to hide title
function hide_titles_meta_box() {
    add_meta_box('hide-title-meta-box', 'Hide Titles', 'hide_titles_meta_box_callback', ['post', 'page'], 'side', 'default');
}

// Meta box callback function
function hide_titles_meta_box_callback($post) {
    $value = get_post_meta($post->ID, '_hide_title', true);
    ?>
    <label for="hide-titles-checkbox">
        <input type="checkbox" id="hide-titles-checkbox" name="hide_titles_checkbox" <?php checked($value, 'on'); ?> />
        Hide The Title
    </label>
    <br><br>
    <p><small>This option comes from the <b>Hide Titles</b> plugin. <a href="https://wordpress.org/support/plugin/hide-titles/reviews/?filter=5#new-post"><strong>Please consider leaving a review</strong></a> to share your experience with us.</small></p>
    <?php
}

// Save meta box data
function hide_titles_save_meta($post_id) {
    if (array_key_exists('hide_titles_checkbox', $_POST)) {
        update_post_meta($post_id, '_hide_title', 'on');
    } else {
        delete_post_meta($post_id, '_hide_title');
    }
}

// Filter the title to hide it
function hide_titles_filter_title($title, $id = null) {
    if (is_admin() || !$id) {
        return $title;
    }

    $hide_title = get_post_meta($id, '_hide_title', true);
    if ($hide_title === 'on') {
        return '';
    }

    return $title;
}





/**
 * Save installation datetime on plugin activation
 */
function hide_titles_activate() {
    // Check if the installation time is already saved
    $installed = get_option('hide_titles_installed');
    
    if (!$installed) {
        // Save current datetime if not already set
        update_option('hide_titles_installed', current_time('mysql'));
    }
}
register_activation_hook(__FILE__, 'hide_titles_activate');

/**
 * Clean up options on plugin uninstallation
 */
function hide_titles_uninstall() {
    delete_option('hide_titles_installed');
}
register_uninstall_hook(__FILE__, 'hide_titles_uninstall');

/**
 * Show migration notice for installations before May 1, 2025
 */
function ht_show_migration_notice() {
    // Only show if new plugin is not active
    if (is_plugin_active('daisy-titles/daisy-titles.php')) {
        return;
    }
    
    // Get installation date
    $install_date = get_option('hide_titles_installed');
    
    // Only show notice if:
    // 1. There is NO install date (new installation) OR
    // 2. Installation date is BEFORE May 1, 2025
    if ($install_date && strtotime($install_date) >= strtotime('2025-05-01')) {
        return;
    }
    
    // Get install/activate URLs
    $install_url = wp_nonce_url(
        add_query_arg([
            'action' => 'install-plugin',
            'plugin' => 'daisy-titles'
        ], admin_url('update.php')),
        'install-plugin_daisy-titles'
    );
    
    $activate_url = '';
    if (file_exists(WP_PLUGIN_DIR . '/daisy-titles/daisy-titles.php')) {
        $activate_url = wp_nonce_url(
            add_query_arg([
                'action' => 'activate',
                'plugin' => 'daisy-titles/daisy-titles.php'
            ], admin_url('plugins.php')),
            'activate-plugin_daisy-titles/daisy-titles.php'
        );
    }
    ?>
    <div class="notice notice-error">
        <h4><?php esc_html_e('Important Notice About Hide Titles', 'hide-titles'); ?></h4>
        <p>
            <?php _e('This plugin is no longer maintained. Please migrate to our new improved plugin <b style="color: blue;">"Daisy Titles"</b> for continued support, new features, and future updates.', 'hide-titles'); ?>
        </p>
        <p>
            <?php if ($activate_url) : ?>
                <a href="<?php echo esc_url($activate_url); ?>" class="button button-primary">
                    <?php esc_html_e('Activate Daisy Titles Now', 'hide-titles'); ?>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url($install_url); ?>" class="button button-primary">
                    <?php esc_html_e('Migrate to Daisy Titles Now', 'hide-titles'); ?>
                </a>
            <?php endif; ?>
        </p>
    </div>
    <?php
}
add_action('admin_notices', 'ht_show_migration_notice');