<?php
/*
Plugin Name: Top Buchneuheiten Widget
Plugin URI: http://www.buch-billig-kaufen.de/
Description: Adds an "Top Buchneuheiten" widget to your sidebar. 
Author: Martin Jansen
Version: 1.0
Author URI: http://www.buch-billig-kaufen.de
*/
//if(!current_user_can('manage_options'))
//    die (__("Verboten!"));
 
function widget_topbuchneuheiten_init() {
	if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
		return;	
	function widget_topbuchneuheiten_control() {
		$abdir= get_bloginfo( 'siteurl' ) . '/wp-content/plugins/top-buchneuheiten-widget/topbuchneuheiten.php';
		$extplugin = 'advimage' ;
		$getlocalcss = get_bloginfo('stylesheet_url');
		$admincss = $abdir . '/topbuchneuheitenadmin.css';

	}
	
/* Everything before this is setup and config. widget_aboutme($args) is what is actually called on each page load */
function widget_topbuchneuheiten($args) {
	extract($args);
	$options = get_option('widget_aboutme');
#	$title = $options['title'];
	$title = "Top Buchneuheiten";
#	$topbuchneuheitenhtml = $options['aboutmehtml'];
	$topbuchneuheitenhtml = file_get_contents("http://www.buch-billig-kaufen.de/get_top_buchneuheiten.html");
	
	echo "<!-- Start Top Buchneuheiten Widget -->\n";
	echo $before_widget . $before_title . $title . $after_title;
	echo "<ul id='topbuchneuheiten'>". $topbuchneuheitenhtml ."</ul>";
	echo $after_widget;
	echo "<!-- Stop Top Buchneuheiten Widget -->\n";
	}
	
if( ! function_exists(widget_topbuchneuheiten_header) ) {
	function widget_topbuchneuheiten_header($args) {	
		$blogroot = get_bloginfo('siteurl');
/*		$topbuchneuheitenhead = "\n\t<!-- Top Buchneuheiten widget -->\n\t<link rel=\"stylesheet\" href=\"".$blogroot."/wp-content/plugins/".basename(dirname(__FILE__))."/topbuchneuheiten.css\" type=\"text/css\" media=\"screen\" />\n";
		print($topbuchneuheitenhead);
*/
	}
}
register_sidebar_widget('Top Buchneuheiten', 'widget_topbuchneuheiten');
register_widget_control('Top Buchneuheiten', 'widget_topbuchneuheiten_control', 300, 450);
}
add_action('wp_head', 'widget_topbuchneuheiten_header');
add_action('plugins_loaded', 'widget_topbuchneuheiten_init');
?>