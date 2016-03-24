<?php
/**
 * Template Name: Custom RSS Template - Transparency Newsletter Feed
 */
require_once( plugin_dir_path(__DIR__) . 'Newsletter.php' );
$newsletter = new TRNewsletter\Newsletter();
$id = $newsletter->getActiveNewsletter();

$type = 'lead';


// query_posts( $args );
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        <?php do_action('rss2_ns'); ?>>
<channel>
        <title><?php bloginfo_rss('name'); ?> - Newsletter Feed</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?php bloginfo_rss('url') ?></link>
        <description>RSS feed for newsletter <?php echo $type; ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language><?php echo get_option('rss_language'); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php $post = get_post($id) ?>
        <?php setup_postdata($post); ?>
        <item>
                <title><?php the_title_rss(); ?></title>
                <link><?php the_permalink_rss(); ?></link>
                <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                <dc:creator><?php the_author(); ?></dc:creator>
                <guid isPermaLink="false"><?php the_guid(); ?></guid>
                <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
                <content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
                <thumbnail><?php the_post_thumbnail_url('gallery-field-thumb'); ?></thumbnail>
                <?php rss_enclosure(); ?>
                <?php do_action('rss2_item'); ?>
        </item>
        <?php wp_reset_postdata(); ?>
</channel>
</rss>
