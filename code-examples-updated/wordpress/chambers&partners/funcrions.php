<?php

/* 4. GC list display */

function gclists_categories_for_post_type($post_type = 'gc_influencers', $taxonomy = '') {
    $exclude = array();
    $args = array(
        "taxonomy" => $taxonomy,
    );
    $categories = get_categories($args);

    // Check ALL categories for posts of given post type
    foreach ($categories as $category) {
        $posts = get_posts(array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $category->term_id
                )
            )
        ));

        // If no posts in category, add to exclude list
        if (empty($posts)) {
            $exclude[] = $category->term_id;
        }
    }

    // If exclude list, add to args
    if (!empty($exclude)) {
        $args['exclude'] = implode(',', $exclude);
    }

    // List categories
    return get_categories($args);
}



