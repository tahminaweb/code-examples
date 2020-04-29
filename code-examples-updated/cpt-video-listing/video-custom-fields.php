<?php
if ( !defined('ABSPATH') )
{
    echo 'Nice try!';
}

add_action( 'add_meta_boxes', 'add_video_metaboxes' );

if(!function_exists('add_video_metaboxes')) {
    function add_video_metaboxes() {
        add_meta_box(
            'wpt_video',
            'video Attribute',
            'wpt_video_attribute',
            'video',
            'normal',
            'default'
        );
    }
}



if(!function_exists('wpt_video_attribute')) {
    function wpt_video_attribute($post) {
        global $post;

        // Nonce field to validate form request came from current site
        wp_nonce_field( basename( __FILE__ ), 'video_fields' );
        // Get the location data if it's already been entered

        $custom_field_prefix = "video_";

        $title = get_post_meta( $post->ID, $custom_field_prefix.'title_v', true );
        $star_rating = get_post_meta( $post->ID, $custom_field_prefix.'star_rating', true );
        $location = get_post_meta( $post->ID, $custom_field_prefix.'location', true );

        $title_s = get_post_meta( $post->ID, $custom_field_prefix.'title_s', true );
        $url = get_post_meta( $post->ID, $custom_field_prefix.'my_url', true );
        // Output the field
        ?>
        <p>
            <label style="width: 80px;float:left;" for="title_v _meta_box">  <?php echo _e('Video Title', 'video-text-domain'); ?></label>
            <input type="text" name="title_v" id="title_v _meta_box" value="<?php echo esc_textarea($title ); ?>" />
        </p>
		
		  <p>
            <label style="width: 80px;float:left;" for="title_s _meta_box"> <?php echo _e('Sub Title', 'video-text-domain'); ?>  </label>
            <input type="text" name="title_s" id="title_s _meta_box" value="<?php echo esc_textarea($title_s ); ?>" />
        </p>
      <!--  <p>
            <label style="width: 80px;float:left;" for="location_meta_box"> Location </label>
            <input type="text" name="location" id="location_meta_box" value="<?php echo esc_textarea($location); ?>" />
        </p> -->
		
		  <p>
            <label style="width: 80px;float:left;" for="star_rating_box"><?php echo _e('Video Type', 'video-text-domain'); ?></label>
            <select name="star_rating" id="star_rating_box">
                <option value="Youtube" <?php selected($star_rating, 'Youtube'); ?>><?php echo _e('Youtube', 'video-text-domain'); ?></option>
                <option value="Vimeo" <?php selected($star_rating, 'Vimeo'); ?>><?php echo _e('Vimeo', 'video-text-domain'); ?></option>
                <option value="Dailymotion" <?php selected($star_rating, 'Dailymotion'); ?>><?php echo _e('Dailymotion', 'video-text-domain'); ?></option>
              </select>
        </p>
       
		  <p>
         <label style="width: 80px;float:left;"><?php echo _e('Video URL', 'video-text-domain'); ?> </label><input style="width: 20em;" type="text" name="my_url" value="<?php echo esc_url( $url ); ?>" size="30" class="regular-text" />
      </p>
        <?php
    }
}




/**
 * Save the metabox data
 */
function wpt_save_video_meta( $post_id, $post ) {
    // Return if the user doesn't have edit permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }
    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( !isset( $_POST['video_fields'] ) || ! wp_verify_nonce( $_POST['video_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }
/*
    if(!isset($_POST['title_v']) || !isset($_POST['star_rating']) || !isset($_POST['location']) ) {
        return $post_id;
    }
*/
    $custom_field_prefix = "video_";
    $url = esc_url_raw( $_POST['my_url'] );
    // Now that we're authenticated, time to save the data.
    // This sanitizes the data from the field and saves it into an array $events_meta.
    $video_meta[$custom_field_prefix.'title_v'] =  esc_textarea( $_POST['title_v'] );
    $video_meta[$custom_field_prefix.'star_rating'] =  esc_textarea( $_POST['star_rating'] );
    $video_meta[$custom_field_prefix.'location'] = esc_textarea( $_POST['location'] );
    $video_meta[$custom_field_prefix.'my_url'] = esc_textarea( $url );
	 $video_meta[$custom_field_prefix.'title_s'] = esc_textarea( $_POST['title_s'] );
	
    // Cycle through the $events_meta array.
    // Note, in this example we just have one item, but this is helpful if you have multiple.
    foreach ( $video_meta as $key => $value ) :
        // Don't store custom data twice
        if ( 'revision' === $post->post_type ) {
            return;
        }
        if ( get_post_meta( $post_id, $key, false ) ) {
            // If the custom field already has a value, update it.
            update_post_meta( $post_id, $key, $value );
        } else {
            // If the custom field doesn't have a value, add it.
            add_post_meta( $post_id, $key, $value);
        }
        if ( ! $value ) {
            // Delete the meta key if there's no value
            delete_post_meta( $post_id, $key );
        }
    endforeach;
}

add_action( 'save_post', 'wpt_save_video_meta', 1, 2 );

function my_display_custom_field( $atts ) {
	 $custom_field_prefix = "video_";
 
          
          
	$atts = extract( shortcode_atts( array(
		'id' => '','border_color' => '', 'width' => '','height' => ''
	), $atts ) );
	if ( ! $id ) return;
	
	$videoid=$id;
	$videoid   = 'wpex_'. $videoid; // prefix the id
	$border_color;  
$border_color;  
$width;  
$height;  
if($height!='' && is_numeric($height))
	 $height =$height;
else
	 $height ='349';
 
 if($width!='' && is_numeric($width))
	 $width =$width;
else
	 $width ='349';

  $args = array(
        'post_type' => 'video',
		 'post_id' => $videoid
       
    );
// The Query
$the_query = new WP_Query( $args );
 
// The Loop
if ( $the_query->have_posts() ) {
 
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
     //  echo get_post_meta( get_the_ID(), 'Mood', true);
		
	  $thumb = wp_get_attachment_thumb_url( get_post_thumbnail_id( get_the_ID()));
          if(empty($thumb)) {
                $thumb =    'http://placehold.it/500x300';
            }
			
			 $my_urls =  get_post_meta(get_the_ID(), "{$custom_field_prefix}my_url", true);
            $image = '<img style="" class="image-url"  src="'.$thumb.'">';
			$videoss = '<iframe width="'.$width.'"  height="'.$height.'"  class="video-url"   src="'.$my_urls.'"></iframe>';
			if($my_urls) {
                return '<span style="border:8px solid '.$border_color.'" class="thumbnail wpex-custom-field id-'. $videoid .'">'. $videoss .'</span>';
            }
			else
			{
				
				return '<span style="border:8px solid '.$border_color.'" class="thumbnail wpex-custom-field id-'. $videoid .'">'. $image .'</span>';
			}
        }
 
     }
    /* Restore original Post Data */
    wp_reset_postdata();
	
	
}
add_shortcode( 'prefix_video', 'my_display_custom_field' );




add_action( 'after_setup_theme', 'mytheme_theme_setup' );
 
if ( ! function_exists( 'mytheme_theme_setup' ) ) {
    function mytheme_theme_setup() {
 
        add_action( 'init', 'mytheme_buttons' );
 
    }
}
 
/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'mytheme_buttons' ) ) {
    function mytheme_buttons() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }
 
        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }
 
        add_filter( 'mce_external_plugins', 'mytheme_add_buttons' );
        add_filter( 'mce_buttons', 'mytheme_register_buttons' );
    }
}
 
if ( ! function_exists( 'mytheme_add_buttons' ) ) {
    function mytheme_add_buttons( $plugin_array ) {
        $plugin_array['mybutton'] = plugin_dir_url( __FILE__ ) .'js/tinymce_buttons.js';
        return $plugin_array;
    }
}
 
if ( ! function_exists( 'mytheme_register_buttons' ) ) {
    function mytheme_register_buttons( $buttons ) {
        array_push( $buttons, 'mybutton' );
        return $buttons;
    }
}
 
add_action ( 'after_wp_tiny_mce', 'mytheme_tinymce_extra_vars' );
 
if ( !function_exists( 'mytheme_tinymce_extra_vars' ) ) {




	function mytheme_tinymce_extra_vars() {

  $arg = array(
        'post_type' => 'video',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
	$output=array();
 $query = new WP_Query($arg);
  if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            global $post;
            $tmp = [];
            $tmp['text'] = $post->post_title;
            $tmp['value'] = $post->ID;
            
            $output[] = $tmp;
        endwhile;
    endif;
	header('Content-Type: application/json');
	$oust=json_encode($output);

	?>
		<script type="text/javascript">
			var tinyMCE_object = <?php echo json_encode(
				array(
					'button_name' => esc_html__('Video', 'video-text-domain'),
					'button_title' => esc_html__('Video Sort Code', 'video-text-domain'),
					'image_title' => esc_html__('Image', 'video-text-domain'),
					'image_button_title' => esc_html__('Upload image', 'video-text-domain'),
					'dropdownvideo' => $oust,
				)
				);
			?>;
		</script><?php
	}
}
