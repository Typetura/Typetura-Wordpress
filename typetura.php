<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://typetura.com
 * @since             1.0.5
 * @package           Typetura
 *
 * @wordpress-plugin
 * Plugin Name:       Typetura
 * Plugin URI:        typetura.com/
 * Description:       We typeset your website! Typography that works on your website regardless of layout or device.
 * Version:           1.0.5
 * Author:            Typetura
 * Author URI:        https://typetura.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       typetura
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined("WPINC")) {
  die();
}

define("TYPETURA_VERSION", "1.0.5");

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-typetura-activator.php
 */
function activate_typetura()
{
  require_once plugin_dir_path(__FILE__) .
    "includes/class-typetura-activator.php";
  Typetura_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-typetura-deactivator.php
 */
function deactivate_typetura()
{
  require_once plugin_dir_path(__FILE__) .
    "includes/class-typetura-deactivator.php";
  Typetura_Deactivator::deactivate();
}

register_activation_hook(__FILE__, "activate_typetura");
register_deactivation_hook(__FILE__, "deactivate_typetura");

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . "includes/class-typetura.php";

function run_typetura()
{
  $plugin = new Typetura();
  $plugin->run();
}
run_typetura();
