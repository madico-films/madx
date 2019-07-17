<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

//  Allows you to write shortcodes in ACF text inputs
add_filter('acf/format_value/type=text', 'do_shortcode');

// Fix pagination 404 errors on blog category pages
function bamboo_request($query_string ){
  	if( isset( $query_string['page'] ) ) {
  	  if( ''!=$query_string['page'] ) {
  	    if( isset( $query_string['name'] ) ) {
  	        unset( $query_string['name'] );
  	    }
  	  }
  	}
  	return $query_string;
}
add_filter('request', 'bamboo_request');

add_action('pre_get_posts','bamboo_pre_get_posts');
function bamboo_pre_get_posts( $query ) {
	// Only for pagination on category pages
  if (is_category()) {
   	if( $query->is_main_query() && !$query->is_feed() && !is_admin() ) { 
   	  $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) ); 
   	}
  } 
}

function list_distributors($country_array){
	$count = 0;
  foreach ($country_array as $country => $country_post) {
    echo "<div class='small-12 cell'>";
    echo "<h4 class='blue'>{$country}</h4>";
    echo "</div>";

    // Loop through each country's distributor posts
    foreach ($country_post as $distributor_post) {
      $count++;
      $dist_company   = get_post_meta($distributor_post->ID,'company_name',true);
      $dist_street    = get_post_meta($distributor_post->ID,'street',true);
      $dist_zip       = get_post_meta($distributor_post->ID,'zip',true);
      $dist_city      = get_post_meta($distributor_post->ID,'city',true);
      $dist_state     = get_post_meta($distributor_post->ID,'state',true);
      $dist_country   = get_post_meta($distributor_post->ID,'country',true);
      $dist_phone     = get_post_meta($distributor_post->ID,'phone_number',true);
      $dist_altphone  = get_post_meta($distributor_post->ID,'alt_phone_number',true);
      $dist_fax       = get_post_meta($distributor_post->ID,'fax',true);
      $dist_email     = get_post_meta($distributor_post->ID,'email',true);
      $dist_website   = get_post_meta($distributor_post->ID,'website',true);
      $dist_markets   = get_post_meta($distributor_post->ID,'markets',true);
      $dist_name      = $distributor_post->post_title;
      $comp_name      = get_post_meta($distributor_post->ID,'compnay_name',true);
      $website_nohttp = preg_replace('/(http:\/\/|https:\/\/|www.)/', '', $dist_website);

      echo "<div class='medium-6 large-3 cell module auto-height'>";
      echo "<h5 class='blue'>{$dist_name}</h5>";
      echo "<ul class='dealer-meta'>";

      if ($dist_company || $dist_street || $dist_city) {
      
        echo "<li><address><i class='fas fa-map-marker-alt'></i> &nbsp;";
        if($dist_company) {
          echo "{$dist_company}<br>";
        }
        if($dist_street) {
          echo "{$dist_street}<br> {$dist_city}, {$dist_state} {$dist_zip}<br> {$dist_country} </address></li>";
        }

      }

      if($dist_phone) {
        echo "<li><address><i class='fas fa-phone'></i> &nbsp;{$dist_phone}";
        if($dist_altphone) {
          echo "<br>{$dist_altphone}";
        }
        echo "</address></li>";
      }
      if($dist_fax) {
        echo "<li><address><i class='fas fa-fax'></i> &nbsp;{$dist_fax}</address></li>";
      }
      if($dist_email) {
        echo "<li class='email'><address><i class='fas fa-envelope'></i> &nbsp;{$dist_email}</address></li>";
      }
      if($dist_website) {
        echo "<li class='email website'><address><i class='fas fa-globe'></i> &nbsp;<a href='{$dist_website}' target='_blank'>{$website_nohttp}</a></address></li>";
      }
      echo "</ul>";
      if($dist_markets) {
        echo "<a href='#!' class='info-icon' v-tooltip tabindex='{$count}' title='{$dist_markets}'><i class='fal fa-info-circle'></i></a>";
      }
      echo "</div>";
      }
    
	}
}

/** Lanugage switcher functions  */
require_once( 'library/languages.php' );

/** Various URL rewrite functions to add taxonomies to url */
require_once( 'library/url-rewrites.php' );

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Add custom shortcodes */
require_once( 'library/shortcodes.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );

add_filter( 'language_attributes', 'language_attributes_x' );
function language_attributes_x( $output ) {
    $output = str_replace( 'dir="rtl" ', '', $output);
    return $output;
}
 
add_filter( 'body_class', 'body_class_x' );
function body_class_x( $classes ) {
     
    $key = array_search( 'rtl', $classes );
 
    if( $key !== false ) {
        unset($classes[$key]);
    }
 
    return $classes;
}
 
add_action( 'madico_scripts', 'madico_scripts_x' );
function madico_scripts_x( $classes ) {
	echo '<script src="'.get_template_directory_uri().'/dist/assets/js/pardot.js?ver='.filemtime(get_template_directory().'/dist/assets/js/pardot.js').'"></script>';
}