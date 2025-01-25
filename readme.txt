=== Plain Formatted Billing Address for WooCommerce ===
Version: 1.0.0
Stable tag: 1.0.0
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.2
Tags: woocommerce, billing address, formatted billing address, plain text, formatting
Plugin URI: https://wordpress.org/plugins/plain-formatted-billing-address-for-woocommerce/
Author: Maximum.Software
Author URI: https://maximum.software
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a plain-text formatted billing address placeholder to WooCommerce.

== Description ==

The 'Plain Formatted Billing Address for WooCommerce' plugin adds a custom email placeholder `{formatted_billing_address_plain}` that works just like the built-in `{formatted_billing_address}`, but outputs the billing address in plain text format (joined by new line characters) instead of using HTML formatting.

This is particularly useful when you need to use addresses in contexts where HTML is not supported or desired.

= Usage =

Simply use the `{formatted_billing_address_plain}` placeholder in your WooCommerce email templates wherever you need a plain-text formatted billing address.

= Requirements =

* WordPress 5.0 or higher
* WooCommerce 3.0.0 or higher
* PHP 7.2 or higher

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plain-formatted-billing-address-for-woocommerce` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the placeholder `{formatted_billing_address_plain}` in your WooCommerce email templates

== Changelog ==

= 1.0.0 =
* Initial release
