<?php
/*
 * Plugin Name: bbPress Advanced Statistics
 * Version: 1.4.4.1
 * Plugin URI: http://www.thegeek.info
 * Description: Advanced Statistics Available for bbPress users, introducing a familiar looking online and statistics section to your forums!
 * Author: Jake Hall
 * Author URI: http://www.thegeek.info
 * Requires at least: 3.9
 * Tested up to: 4.7
 * Text Domain: bbpress-improved-statistics-users-online
 * Domain Path: /includes/lang
 *
 * @package WordPress
 * @author Jake Hall
 * @since 1.0.0
 */

if ( !defined( 'ABSPATH' ) ) exit;

// Load admin side of the plugin
if( is_admin() ) {
    require_once( 'includes/admin/lib/admin.api.php' );
    require_once( 'includes/admin/class.settings.php' );
}

// Load plugin class files
require_once( 'includes/core/class.statistics.php' );
require_once( 'includes/public/class.online.php' );
require_once( 'includes/public/class.extras.php' );
require_once( 'includes/core/class.widget.php' );

// Define our core plugin variables. 
DEFINE("BBPAS_VERS", "1.4.4.1");
DEFINE("BBPAS_DBVERS", "1.1.1");

/**
 * Returns the main instance of bbPress_Advanced_Statistics. 
 *
 * @since  1.0.0
 * @return object bbPress_Advanced_Statistics
 */

function bbPress_Advanced_Statistics() {
    
    $instance = bbPress_Advanced_Statistics::instance( __FILE__, BBPAS_VERS );
    
    // Create the settings instance if necessary
    if ( is_null( $instance->settings ) && is_admin() ) {
        $instance->settings = bbPress_Advanced_Statistics_Settings::instance( $instance, BBPAS_VERS );
    }
    
    // Create the online instance if necessary
    if ( is_null( $instance->online ) ) {
        $instance->online = bbPress_Advanced_Statistics_Online::instance( $instance, BBPAS_VERS );
    }
    
    // Create the extras  instance if necessary
    if ( is_null( $instance->extras ) ) {
        $instance->extras = bbPress_Advanced_Statistics_Extras::instance( $instance, BBPAS_VERS );
    }    
}

bbPress_Advanced_Statistics();