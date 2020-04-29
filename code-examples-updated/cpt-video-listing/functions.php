<?php
/**
 * Plugin Name: video
 * Description: Display all video list
 * Version: 1.0
 * Text Domain: video-text-domain
 * Domain Path: /languages
 * Author: Tahmina Akter Chowdhury
 */

if ( !defined('ABSPATH') )
{
    echo 'Nice try!';
}
//Nice to load vendor file
include_once "vendor/autoload.php";

//Load video custom post
include_once "video-custom-post.php";


//Load video custom fields
include_once "video-custom-fields.php";


// end fake video generation

add_action('wp_head', 'add_inline_js_script');

function add_inline_js_script () {
    ?>
        <script>
            window.ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
        </script>
    <?php
}

function wp_video_js_scripts()
{
    // Register the script like this for a plugin:
    wp_register_script( 'video-pagination', plugins_url( '/js/pagination.min.js', __FILE__), ['jquery'] , '2.1.0', true);
    wp_register_script( 'video-script', plugins_url( '/js/video.js', __FILE__), ['jquery', 'video-pagination'] , '1.0.0', true);

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'video-pagination');
    wp_enqueue_script( 'video-script');

    wp_enqueue_style('video-css', plugins_url( '/css/video.css', __FILE__), array(), '1.0');
    wp_enqueue_style('video-pagination-css', plugins_url( '/css/pagination.min.css', __FILE__), array(), '1.0');
}

add_action( 'wp_enqueue_scripts', 'wp_video_js_scripts' );


//video page template rendering.
function render_video_template( $atts ) {
    global $wpdb;
    ob_start();
    $locations = $wpdb->get_results('SELECT distinct meta_value FROM '.$wpdb->prefix.'postmeta WHERE meta_key = \'video_location\'');
    include_once 'template/video.php';
    $output = ob_get_clean();
    return $output;

}
add_shortcode( 'video', 'render_video_template' );


//ajax functionality to get lists of video
add_action('wp_ajax_video_lists', 'get_videos');
add_action('wp_ajax_nopriv_video_lists', 'get_videos');


function get_videos() {

    $custom_field_prefix = "video_";

    $arg = array(
        'post_type' => 'video',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );

    $meta_query = [];

    $filter = isset($_REQUEST['filter'])? $_REQUEST['filter'] : [];
	if(!empty($filter['title'])) {
        $filter['title'] =  esc_textarea($filter['title']);

        $meta_query[] = [
            'key'     => "{$custom_field_prefix}title_v",
            'value'   => $filter['title'],
            'compare' => 'LIKE',
        ];
    }

	if(!empty($filter['videotype'])) {
        $filter['videotype'] =  esc_textarea($filter['videotype']);

        $meta_query[] = [
            'key'     => "{$custom_field_prefix}star_rating",
            'value'   => $filter['videotype'],
            'compare' => '==',
        ];
    }

    if(count($meta_query) > 0) {
        $arg['meta_query'] =  $meta_query;
    }

    $query = new WP_Query($arg);
    $output['data'] = [];

    if(WP_DEBUG) {
        $output['query'] = $query->request;
        $output['filter'] = $filter;
    }

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            global $post;
            $tmp = [];
            $tmp['id'] = $post->ID;
            $tmp['title'] = $post->post_title;
            $tmp['description'] =  $post->post_content;
            //$tmp['price'] =  get_post_meta($post->ID, "{$custom_field_prefix}price", true);
            $tmp['type'] =  get_post_meta($post->ID, "{$custom_field_prefix}star_rating", true);
           // $tmp['location'] =  get_post_meta($post->ID, "{$custom_field_prefix}location", true);
            $tmp['title_v'] =  get_post_meta($post->ID, "{$custom_field_prefix}title_v", true);
            $tmp['title_s'] =  get_post_meta($post->ID, "{$custom_field_prefix}title_s", true);
            $tmp['my_url'] =  get_post_meta($post->ID, "{$custom_field_prefix}my_url", true);
            $tmp['url'] = get_permalink($post->ID);
            $tmp['thumb'] = wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID));
            $tmp['media'] = wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID));
			
			if(empty($tmp['thumb'])) {
                $tmp['thumb'] =   $tmp['thumb'] = 'http://placehold.it/500x300';
            }

            $output['data'][] = $tmp;
        endwhile;
    endif;
    header('Content-Type: application/json');
    echo json_encode($output);
    die();
}


// tiny mice button 


add_action( 'after_setup_theme', 'mytheme_theme_setup' );
 
if ( ! function_exists( 'mytheme_theme_setup' ) ) {
    function mytheme_theme_setup() {
 
        add_action( 'init', 'mytheme_buttons' );
 
    }
}

function video_plugin_init() {
    $plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
    load_plugin_textdomain( 'video-plugin', false, $plugin_rel_path );
}
add_action('plugins_loaded', 'video_plugin_init');