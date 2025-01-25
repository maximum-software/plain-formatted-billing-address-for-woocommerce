<?php
/**
 * Plugin Name: Plain Formatted Billing Address for WooCommerce
 * Plugin URI: https://wordpress.org/plugins/plain-formatted-billing-address-for-woocommerce/
 * Description: Adds a plain-text formatted billing address placeholder to WooCommerce.
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: Maximum.Software
 * Author URI: https://maximum.software/
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: plain-formatted-billing-address-for-woocommerce
 * WC requires at least: 3.0.0
 * WC tested up to: 9.6
 */

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) )
	exit;

class Plain_Formatted_Billing_Address_for_WooCommerce
{
	/**
	 * Constructor for setting up the hooks
	 */
	public function __construct()
	{
		// Add hooks after WooCommerce is fully loaded
		add_action( 'woocommerce_init', array( $this, 'setup_hooks' ) );
	}

	/**
	 * Set up hooks
	 */
	public function setup_hooks()
	{
		add_filter( 'woocommerce_email_format_string', array( $this, 'process_formatted_billing_address_plain_placeholder' ), 10, 2 );
	}
	
	/**
	 * Build the billing address in plain-text format
	 * 
	 * @param WC_Order $order The WooCommerce order object.
	 * @return string A plain-text address with new line separators.
	 */
	private function get_plaintext_billing_address( $order )
	{
		// Compose the plain text billing address
		$lines = array_filter( array(
			trim( $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() ),
			$order->get_billing_company(),
			$order->get_billing_address_1(),
			$order->get_billing_address_2(),
			trim( $order->get_billing_city() . ', ' . $order->get_billing_state() . ' ' . $order->get_billing_postcode() ),
			$order->get_billing_country(),
		) );
		
		// Join with new line characters
		return implode( "\n", $lines );
	}
	
	/**
	 * Replace our custom placeholder `{formatted_billing_address_plain}` with a plain-text billing address.
	 * 
	 * Hooked into 'woocommerce_email_format_string'.
	 * 
	 * @param  string $string The email string (subject/body/heading/etc.).
	 * @param  mixed  $email  The email object (or some data) from WooCommerce.
	 * @return string
	 */ 
	public function process_formatted_billing_address_plain_placeholder( $string, $email )
	{
		// Bail if the placeholder is not found
		if( false === strpos( $string, '{formatted_billing_address_plain}' ) )
			return $string;
		
		// Safely detect the order object from $email
		$order = ( is_object( $email ) && property_exists( $email, 'object' ) ) ? $email->object : null;
		
		// If an order is found, replace the placeholder
		if( $order && is_a( $order, 'WC_Order' ) )
		{
			// Build a plain-text billing address
			$address_string_plaintext = $this->get_plaintext_billing_address( $order );
			
			// Replace our custom placeholder
			$string = str_replace(
				'{formatted_billing_address_plain}',
				$address_string_plaintext,
				$string
			);
		}
		
		return $string;
	}
}

$plain_formatted_billing_address_for_woocommerce = new Plain_Formatted_Billing_Address_for_WooCommerce();
