<?php
/*
Plugin Name: WooMinecraft
Plugin URI: http://woominecraft.com
Description: A WooCommerce plugin which allows donations and commands to be sent to your Minecraft server.
Author: Jerry Wood
Version: 1.4.6
License: GPLv2
Text Domain: woominecraft
Domain Path: /languages
Author URI: http://plugish.com
WC requires at least: 6.5.2
WC tested up to: 6.5.2
*/

namespace WooMinecraft;

add_action('before_woocommerce_init', function() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
});

define( 'WMC_INCLUDES', plugin_dir_path( __FILE__ ) . 'includes/' );
define( 'WMC_URL', plugin_dir_url( __FILE__ ) );
define( 'WMC_VERSION', '1.4.5' );

// Require the helpers file, for use in :allthethings:
require_once WMC_INCLUDES . 'helpers.php';
Helpers\setup();

// Handle everything order-related.
require_once WMC_INCLUDES . 'order-manager.php';
Orders\Manager\setup();

// Handle everything order-cache related.
require_once WMC_INCLUDES . 'order-cache-controller.php';
Orders\Cache\setup();

// Load the REST API
require_once WMC_INCLUDES . 'rest-api.php';
REST\setup();

require_once WMC_INCLUDES . 'woocommerce-admin.php';
WooCommerce\setup();

use Automattic\WooCommerce\Utilities\OrderUtil;

// Fire an action after all is done.
do_action( 'woominecraft_setup' );
