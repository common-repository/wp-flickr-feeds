=== WP Flickr Feeds ===
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=afroz92@gmail.com&item_name=WP+Flickr+Feeds
Tags: Flickr, Flickr group, Flickr Page, Flickr posts, Flickr wall, Flickr feed
Contributors: NetAttingo Technologies
Author: NetAttingo Technologies
Tested up to: 4.6
License: GPLv2
Requires at least: 3.5.0
Stable tag: 1.0

== Description ==
This plugin helps to display latest feeds from your Flickr on your site.


<strong>Features</strong>

* Backend settings to put App Id and User Id
* Grid view mode to display flickr feeds.
* List view mode to display flickr feeds.
* Easy to customize
* Clicking on feed will take you to the feed details.

== Screenshots ==

1. WP-admin setting Page.
2. Grid view mode of posts
3. List view mode of posts

== Frequently Asked Questions ==
1. No technical skills needed.

== Changelog ==
This is first version and no known errors found

== Upgrade Notice == 
This is first version and no known notices yet

== Installation ==
1. Upload the folder "wp-flickr-feeds" to "/wp-content/plugins/"
2. Activate the plugin through the "Plugins" menu in WordPress back end.
3. Go to "Flickr Wall Post" and put 'Flickr App Id' and 'Flickr user id'.
4. use below shortcode to display flickr feeds in your page or post editor.

For grid view mode:
`
[flickr-feeds-grid] 
`

For list view mode:
`
[flickr-feeds-list] 
`

4. use below shortcode to display flickr feeds in your template file.

For grid view mode:
`
<?php  echo do_shortcode('[flickr-feeds-grid]'); ?>
`

For list view mode:
` 
<?php echo do_shortcode('[flickr-feeds-list]'); ?>
`

