<?php

namespace TRNewsletter;

/**
* Generate newsletter feeds
*/
class Newsletter
{
	
	function __construct()
	{
	}

	/**
	 * Register new RSS feed with given template
	 * @param  string $feed_name name of the feed
	 */
	public function registerFeed($feed_name)
	{
		$this->feed_name = $feed_name;
		add_feed($this->feed_name, function() {
			$rss_template = __DIR__ . '/templates/feed-' . $this->feed_name . '-rss2.php';
			load_template( $rss_template );
		});
	}

	/**
	 * get active newsletter post
	 * @return int id of the newsletter post
	 */
	public function getActiveNewsletter()
	{
		$args = [
			'post_type' => 'newsletter',
			'posts_per_page' => '1',
			'order' => 'DESC',
			'orderby' => 'date'
		];
		$query = new \WP_Query($args);
		if ($query->have_posts()) {
			$posts = $query->get_posts();
			return $posts[0]->ID;
		}
	}
}