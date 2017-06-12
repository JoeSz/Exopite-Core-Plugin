<?php
/**
 * This is the core plugin for Exopite plugins and themes.
 * Purpose to load scripts and CodeStar option framework, make sure
 * it is not enqueued multiple times.
 *
 * @link              http://joe.szalai.org
 * @since             1.0.1
 * @package           Exopite_Core
 *
 * @wordpress-plugin
 * Plugin Name:       Exopite Core
 * Plugin URI:        http://joe.szalai.org/exopite/core
 * Description:       This is the core plugin for Exopite plugins and themes. Purpose to load scripts and CodeStar option framework enhanced version, make sure they are not enqueued multiple times.
 * Version:           1.0.0
 * Author:            Joe Szalai
 * Author URI:        http://joe.szalai.org
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       exopite-core
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) die;

define( 'EXOPITE_CORE_URL', plugin_dir_url( __FILE__ ) );
define( 'EXOPITE_CORE_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'ExopiteSettings' ) ) {
    class ExopiteSettings {

        public static $options = array();

        static public function setValue($key, $value) {
            ExopiteSettings::$options[$key] = $value;
        }

        static public function getValue($key) {
            if ( isset( ExopiteSettings::$options[$key] ) ) {
                return ExopiteSettings::$options[$key];
            } else {
                return null;
            }

        }

        static public function deleteValue($key) {
            unset( ExopiteSettings::$options[$key] );
        }

        static public function checkValue($key) {
            if ( array_key_exists( $key, ExopiteSettings::$options ) ) {
                return true;
            } else {
                return false;
            }
        }

    }
}

$exopite_settings = get_option( 'exopite_options' );
if ( ! isset( $exopite_settings['exopite-content-layout'] ) ) {
    delete_option( 'exopite_options' );
}

if ( ! function_exists( 'load_exopite_core_scripts' ) ) {
    function load_exopite_core_scripts() {

        if ( ! wp_script_is( 'exopite-core-js' ) ) {

            /*
             * Enqueue scripts and styles with automatic versioning
             *
             * https://www.doitwithwp.com/enqueue-scripts-styles-automatic-versioning/
             */
            $core_js_url  = EXOPITE_CORE_URL . 'js/exopite-core.min.js';
            $core_js_path =  join( DIRECTORY_SEPARATOR, array( EXOPITE_CORE_PATH, 'js', 'exopite-core.min.js' ) );

            // Exopite core scripts (debounce, throttle, filter & action hooks)
            wp_enqueue_script( 'exopite-core-js', $core_js_url, array(), filemtime( $core_js_path ), true );
        }

    }
}

if ( ! function_exists( 'load_exopite_core_scripts_frontend_only' ) ) {
    function load_exopite_core_scripts_frontend_only() {

        if ( ! wp_script_is( 'jquery-tether-133' ) ) {
            wp_enqueue_script( 'jquery-tether-133', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.3/js/tether.min.js', array( 'jquery' ), '1.3.3', true );
        }

        if ( ! wp_script_is( 'bootstrap-4-js' ) ) {
            wp_register_script( 'bootstrap-4-js', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js", array( 'jquery', 'jquery-tether-133' ), '4.0.0-alpha.6', true );
            wp_enqueue_script( 'bootstrap-4-js' );
        }

    }
}

if ( ! function_exists( 'load_exopite_core_styles_frontend_only' ) ) {
    function load_exopite_core_styles_frontend_only() {

        /**
         * CDNs
         *
         * Get Bootstrap 4
         */
        if ( ! wp_style_is( 'bootstrap-4' ) ) {
            wp_register_style( 'bootstrap-4', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css", false, '4.0.0-alpha6' );
            wp_enqueue_style( 'bootstrap-4' );
        }

    }
}

if ( ! function_exists( 'load_exopite_core_styles' ) ) {
    function load_exopite_core_styles() {

        if ( ! wp_style_is( 'font-awesome-470' ) ) {
            /* Get font awsome */
            wp_register_style( 'font-awesome-470', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css", false, '470' );
            wp_enqueue_style( 'font-awesome-470' );
        }

        load_exopite_core_scripts();

    }
}

if ( ! function_exists( 'exopite_core' ) ) {
    function exopite_core() {

        /**
         * Initialize custom templater
         */
        if( ! class_exists( 'Exopite_Template' ) ) {
            require_once join( DIRECTORY_SEPARATOR, array( EXOPITE_CORE_PATH, 'include', 'exopite-template.class.php' ) );
        }

        /**
         * Initialize minifier
         */
        if( ! class_exists( 'Exopite_Minifier' ) ) {
            require_once join( DIRECTORY_SEPARATOR, array( EXOPITE_CORE_PATH, 'include', 'exopite-minifier.class.php' ) );
        }

        add_action( 'wp_enqueue_scripts', 'load_exopite_core_scripts' );
        add_action( 'wp_enqueue_scripts', 'load_exopite_core_styles' );
        add_action( 'admin_enqueue_scripts', 'load_exopite_core_styles' );

        if ( is_admin() ) {

            /**
             * A custom update checker for WordPress plugins.
             *
             * Useful if you don't want to host your project
             * in the official WP repository, but would still like it to support automatic updates.
             * Despite the name, it also works with themes.
             *
             * @link http://w-shadow.com/blog/2011/06/02/automatic-updates-for-commercial-themes/
             * @link https://github.com/YahnisElsts/plugin-update-checker
             * @link https://github.com/YahnisElsts/wp-update-server
             */
            if( ! class_exists( 'Puc_v4_Autoloader' ) ) {
                require_once join( DIRECTORY_SEPARATOR, array( EXOPITE_CORE_PATH, 'vendor', 'plugin-update-checker', 'plugin-update-checker.php' ) );

                // Update
                $MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
                    'http://update.szalai.org/?action=get_metadata&slug=exopite-core', //Metadata URL.
                    __FILE__, //Full path to the main plugin file.
                    'exopite-core' //Plugin slug. Usually it's the same as the name of the directory.
                );
                // End Update

            }

            require_once( plugin_dir_path( __FILE__ ) . '/vendor/cs-framework/cs-framework-exopite.php' );
            require_once( plugin_dir_path( __FILE__ ) . '/vendor/duplicate-posts-pages.php' );
            require_once( plugin_dir_path( __FILE__ ) . '/vendor/nine3-clone-widgets.php' );

        } else {

            add_action( 'wp_enqueue_scripts', 'load_exopite_core_scripts_frontend_only' );
            add_action( 'wp_enqueue_scripts', 'load_exopite_core_styles_frontend_only' );

        }


    }
}

exopite_core();
