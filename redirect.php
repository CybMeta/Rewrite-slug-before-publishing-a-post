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

// initial hook
add_action( 'save_post', 'rewrite_post_name' );

function rewrite_post_name( $post_id ) {

    // verify post is not a revision
    if ( ! wp_is_post_revision( $post_id ) ) {

        $post_name = get_post_field ( $post_id, 'post_name', 'raw' );
        // If post_name start with post_id
        if( $post_name == substr( $post_name, 0, strlen( $post_id ) ) ) {
            // update the post slug
            wp_update_post( array(
                'ID' => $post_id,
                'post_name' => '' // Rewrite based on Post Title
            ));
        }

    }
}
?>
