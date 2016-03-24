<?php
/*
Plugin Name: Transparency Newsletter Generator
Plugin URI: https://github.com/dokker/tr-newsletter
Description: Generates rss feed for Mailchimp templates
Version: 1.0
Author: docker
Author URI: https://hu.linkedin.com/in/docker
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Autoloading classes
spl_autoload_register(function ($class) {
	$segments = array_filter(explode("\\", $class));

	if (array_shift($segments) === "TRNewsletter") {
		$path = __DIR__ . "/" . implode("/", $segments) . ".php";
		if (file_exists($path)) {
			include $path;
		}
	}
});


add_action('init', function(){
	$newsletter = new TRNewsletter\Newsletter();
	$newsletter->registerFeed('tr-news');
	$newsletter->registerFeed('tr-events');
	$newsletter->registerFeed('tr-lead');
});
