<?php
/**
 * Plugin Name:       Siddhi Appointments
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Appointments booking plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Raghavendra N
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-appointments-plugin
 * Domain Path:       /languages
 */

require_once 'vendor/autoload.php';
require_once __DIR__ . '/src/constants.php';

global $sa_appointments_wp;
$sa_appointments_wp = new SiddhiAppointments\WP;
$plugin = new SiddhiAppointments\Plugin;

register_activation_hook( __FILE__, array( $plugin, 'activate' ) );
// register_deactivation_hook( __FILE__, array( $plugin, 'deactive' ) );

add_action( 'init', array( $plugin, 'init' ) );