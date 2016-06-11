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
   
   // Only when post status is publish, future, private,
   // post title is not empty and post type is not revision
   // $data['ID'] is empty for new posts
   if( ! empty( $data['ID'] )
       && ! in_array( $data['post_status'], array( 'draft', 'pending', 'auto-draft' ) )
       && ! empty( $data['post_title'] )
       && $data['post_type'] != 'revision'
    ) {
        // If post_name starts with post_id
        if( $data['post_name'] == substr( $postarr['post_name'], 0, strlen( $data['ID'] ) ) ) {
            // Create post_name from post_title
            $data['post_name'] = sanitize_title( $data['post_title'] );
        }
    }
	
    return $data;
	
}
