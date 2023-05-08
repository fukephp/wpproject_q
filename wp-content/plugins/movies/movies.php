<?php

/**
 * @package Movies
 */
/*
Plugin Name: Movies
Plugin URI: movies
Description: This plugin creates a custom post type for movies.
Version: 1.0
Author: Faruk Hopic
Author URI: 
*/
function create_movies_post_type()
{
    register_post_type(
        'movies',
        array(
            'labels' => array(
                'name' => __('Movies'),
                'singular_name' => __('Movie')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        )
    );
}
add_action('init', 'create_movies_post_type');

function movie_title_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'movie_title_nonce');
    $movie_title = get_post_meta($post->ID, 'movie_title', true);
?>
    <p>
        <label for="movie_title"><?php _e('Title', 'textdomain'); ?></label>
        <br />
        <input type="text" name="movie_title" id="movie_title" value="<?php echo esc_attr($movie_title); ?>" class="widefat" />
    </p>
<?php
}

function add_movie_meta_box()
{
    add_meta_box(
        'movie_meta_box',
        __('Movie Details', 'textdomain'),
        'movie_meta_box_callback',
        'movies',
        'normal',
        'default'
    );
}

add_action('add_meta_boxes', 'add_movie_meta_box');

function movie_meta_box_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'movie_meta_box_nonce');
    $movie_title = get_post_meta($post->ID, 'movie_title', true);
?>
    <p>
        <label for="movie_title"><?php _e('Movie Title', 'textdomain'); ?></label>
        <br />
        <input type="text" name="movie_title" id="movie_title" value="<?php echo esc_attr($movie_title); ?>" class="widefat" />
    </p>
<?php
}

function save_movie_meta($post_id)
{
    if (!isset($_POST['movie_meta_box_nonce']) || !wp_verify_nonce($_POST['movie_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    $movie_title = sanitize_text_field($_POST['movie_title']);
    update_post_meta($post_id, 'movie_title', $movie_title);
}

add_action('save_post', 'save_movie_meta');
