<?php
/*
Plugin Name: افزونه مدیریت باشگاه مشتریان بهترین باش
Plugin URI: http://btop.ir/
Description: با اتصال وبسایت خود به سیستم بهترین باش - کاربران شما میتوانند در ازای خرید از وبسایت شما در قرعه کشی های هیجان انگیز شرکت نمایند. 
Author: Hoomaan Hormozdi
Version: 1.0.0
Author URI: https://hormozdi.github.io/
*/

require __DIR__ . '/woo-setting-tab.php';
require __DIR__ . '/global.php';

add_filter('woocommerce_get_sections_checkout', 'btop_customer_club_plugin_add_section');
add_filter('woocommerce_get_settings_checkout', 'btop_customer_club_plugin_all_settings', 10, 2);

add_action('woocommerce_order_status_completed', 'btop_customer_club_order_status_completed', 10, 1);
