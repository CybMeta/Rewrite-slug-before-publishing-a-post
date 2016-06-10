<?php
/*
   Plugin Name: Rewrite slug before publishing a post
   Plugin URI: https://www.dariobf.com
   Description: Rewrite post_name (slug) before publishing a post using the native WordPress function.
   Version: 1.0
   Author: Dario BF
   Author URI: https://www.dariobf.com
   License: GPL2
   */

add_filter( 'wp_insert_post_data', 'rewrite_post_name', 10, 2 );
function rewrite_post_name( $data, $postarr ) {
   
   if( ! empty( $postarr['ID'] )
       && ! empty( $postarr['post_title'] )
	    && $postarr['post_type'] != 'revision'
	) {
         // If post_name starts with post_id
         if( $postarr['post_name'] == substr( $postarr['post_name'], 0, strlen( $postarr['ID'] ) ) ) {
            // Create post_name from post_title
            $data['post_name'] = sanitize_title( $postarr['post_title'] );
         }
	}
	
	return $data;
	
}
