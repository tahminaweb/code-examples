<?php
/*
 *  Author: Tahmina Chowdhury
 *  Custom functions, support, custom post types and more.
 */

/*-----------------------------------------------------------------------------------------------*\
	                                      *     Functions *
\*-----------------------------------------------------------------------------------------------*/


/*------------------------------------*\
   1. Oxo Thumbnails Size
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail );
    add_image_size('home-rbb', 565, 408, true);
    add_image_size('home-small', 330, 200, true);
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}


/*------------------------------------*\
  2.  Oxo Navigation
\*------------------------------------*/

// OXO Top  Navigation

function oxonav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'top-menu',
            'items_wrap'      => '<ul class="nav navbar-nav menu book-menu">%3$s</ul>',
            'menu_class' => 'collapse navbar-collapse' , 
            'depth'           => 0

        )
    );
}

// OXO Footer  Navigation
function oxofooternav()
{
    wp_nav_menu(
    array(
            'theme_location'  => 'footer-menu',
            'items_wrap'      => '<ul class="nav navbar-nav menu">%3$s</ul>',
            'menu_class' => 'collapse navbar-collapse' , 
            'depth'           => 0

        )
    );
}



// OXO Social  Navigation
function oxosocialnav()
{
    wp_nav_menu(
    array(
            'theme_location'  => 'social-menu',
            'items_wrap'      => '<ul class="nav social menu">%3$s</ul>',
            'menu_class' => 'collapse navbar-collapse' , 
            'depth'           => 0

        )
    );
}

/*------------------------------------*\
  -- End Oxo Navigation--
\*------------------------------------*/


/*------------------------------------*\
  3.  Accordion Menu Tab
\*------------------------------------*/
function accordion($atts) {
	
	$finalmainid=$atts['mainid'];
	
	$count=0;
	 
    if( have_rows('items') ):  ?>
    <?php while ( have_rows('items') ) : the_row();
   $menutitle = get_sub_field('menu_title'); 
$menulinkd = strtolower(str_replace(" ", "",$menutitle));
$collapsed='collapsed';
$collapse='collapse';
if($count==0)
{
	$collapsed='';
$collapse='';
	
}
?>
        <div class="accordion">
            <div class="card mb-0">
                <a class="card-header <?php echo $collapsed; ?>" data-toggle="collapse" href="#<?php echo $menulinkd."_". $finalmainid; ?>">
                    <span class="card-title">
                     <?php echo the_sub_field('menu_title'); ?>
                 </span>
             </a>
             <div id="<?php echo $menulinkd."_". $finalmainid ?>" class="card-body <?php echo $collapse; ?>" data-parent="#accordion" >

                <!--  Nested raw   --> 
                <?php
                if( have_rows('menu_list') ): ?>
                <ul>
                   <?php
                                // loop through rows (sub repeater)
                   while( have_rows('menu_list') ): the_row();?>

<li>

               <span class="float-right font-weight-bold">  <?php echo the_sub_field('price'); ?></span>
                <h6><?php echo the_sub_field('menu_list_list'); ?></h6>
				

               
               

            </li>       
               <?php endwhile; ?>
           </ul>
       <?php endif; //if( get_sub_field('items') ): ?>             
   </div>      
</div>
</div>

<?php $count++; endwhile;?>              
<?php endif; 
return $output;
}

add_shortcode('accordion', 'accordion');

/*------------------------------------*\
   End accordion Menu Tab
\*------------------------------------*/



/*------------------------------------*\
  4.  Oxo Subpages peek
\*------------------------------------*/

function subpage_peek() {
    global $post;
      $id = get_the_ID();
      
    //query subpages
    $args = array(
        'post_parent' => $id,
        'post_type' => 'page'
    );
    $subpages = new WP_query($args);
     
    // create output
    if ($subpages->have_posts()) :
        
        while ($subpages->have_posts()) : $subpages->the_post();
             $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
            
            $output .= '
     <div class="col-sm-4 nopadding event-list">
          <div class="image-box">
        <a href="'.get_the_permalink().'"> 
              <img class="img-responsive" src="'.$featured_img_url.'">
              </a>

              <div class="caption">
                <h3>'.get_the_title().'</h3>
            
                <p>'.get_the_excerpt().'</p>
                <a href="'.get_the_permalink().'">Plan your '.get_the_title().' </a>
              </div>
          </div>
        </div>

';

endwhile;
        
    else :
        $output = '<p>No subpages found.</p>';
    endif;
     
    // reset the query
    wp_reset_postdata();
     
    // return something
    return $output;
}

add_shortcode('subpage_peek', 'subpage_peek');

/*------------------------------------*\
  -- End Oxo Subpages peek--
\*------------------------------------*/






/*------------------------------------*\
  5.  Oxo Global Variables
\*------------------------------------*/

add_action('wp_head', 'oxo_global_vars');
function oxo_global_vars() {
//    $id = get_the_ID();
//    $post_objects = get_field("sub_pages", $id);
//    $introtext = get_field("introductory_text" , $id);
//    $event_objects = get_field('event_list', $id);
}



/*------------------------------------*\
  5.  End Oxo Global Variables
\*------------------------------------*/



/*------------------------------------*\
  6.  Oxo Extra Function
\*------------------------------------*/


function oxo_phone() {
    $output .= '     
 <a class="call-txt" href="tel:442078033888"> +44 (0)20 7803 3888</a>
';
    return $output;
}

add_shortcode('oxo_phone', 'oxo_phone');

/*------------------------------------*\
  6.  Oxo Extra Function
\*------------------------------------*/





/*------------------------------------*\
  7.  Register all Navigation
\*------------------------------------*/

// Register OXO Navigation
function register_OXO_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
       
        'top-menu' => __('Top Menu', 'oxonav'), // Main Navigation
        'footer-menu' => __('Footer Menu', 'oxofooternav'), // Main Navigation
        'social-menu' => __('Social Menu', 'oxosocialnav'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)

    ));
}


/*------------------------------------*\
  -- End  Register all Navigation
\*------------------------------------*/




/*------------------------------------*\
  8.  Load Jquery Scripts
\*------------------------------------*/

//(header.php)

function oxo_include_custom_jquery() {

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'oxo_include_custom_jquery');


//(generic)

add_action( 'wp_enqueue_scripts', 'custom_load_bootstrap' );

function custom_load_bootstrap()
{    wp_enqueue_style('bootstrap-css', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-theme', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css');
    wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css');
    wp_enqueue_style('rapcdn', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', array('jquery'), true);
    wp_enqueue_script('tab-script', get_template_directory_uri() . '/assets//js/tab.js', array('jquery'), null, true);
    wp_enqueue_script('tmybookatable.js', get_template_directory_uri() . '/assets/js/mybookatable.js', array('jquery'), null, true);
    wp_enqueue_script('bookatable', 'https://bda.bookatable.com/deploy/lbui.direct.min.js');
}



//(conditional script loading)


function register_foundation_style() {
  if ( is_front_page() ) {
     wp_enqueue_script('homescripts.js', get_template_directory_uri() . '/assets/js/homescripts.js', array('jquery'), null, true);
  }

else {
    wp_enqueue_script('pagescripts.js', get_template_directory_uri() . '/assets/js/pagescripts.js', array('jquery'), null, true);
    wp_enqueue_script('lbuidirect', 'https://bda.bookatable.com/deploy/lbui.direct.min.js');
    
}


}
add_action( 'wp_enqueue_scripts', 'register_foundation_style' );




function oxoblank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    	wp_register_script('conditionizr', get_template_directory_uri() . '/assets/js/lib/conditionizr-4.3.0.min.js', array('jquery'), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/lib/modernizr-2.7.1.min.js', array('jquery'), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('oxoblankscripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('oxoblankscripts'); // Enqueue it!


        wp_register_script('oxoaccscripts', get_template_directory_uri() . '/assets/js/jquery.responsiveTabs.min.js', array('jquery'), '2.0.0'); // Custom scripts
        wp_enqueue_script('oxoaccscripts'); // Enqueue it!

        wp_register_script('loadscripts', get_template_directory_uri() . '/assets/js/lib/loadMoreResults.js', array('jquery'), '5.1.0'); // Custom scripts
        wp_enqueue_script('loadscripts'); // Enqueue it!



    }
}




function oxoblank_styles()
{
  

if ( is_front_page() ) {
     wp_register_style('oxohome', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('oxohome'); // Enqueue it!

  }

else {
  wp_register_style('inner', get_template_directory_uri() . '/inner.css', array(), '1.0', 'all');
    wp_enqueue_style('inner'); // 
    
}




    wp_register_style('oxoaccordin', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');
    wp_enqueue_style('oxoaccordin'); // Enqueue it!


    wp_register_style('oxoaccordinres', get_template_directory_uri() . '/assets/css/responsive-tabs.css', array(), '1.0', 'all');
    wp_enqueue_style('oxoaccordinres'); // Enqueue it!
}


/*------------------------------------*\
  8.  End Load Jquery Scripts
\*------------------------------------*/


/*------------------------------------*\
  9. OXO Side Bar
\*------------------------------------*/


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Social Icons', 'oxoblank'),
        'description' => __('Social links ...', 'oxoblank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="ooo">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Site Url', 'oxoblank'),
        'description' => __('Site Url Link', 'oxoblank'),
        'id' => 'site-url',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<span class="hidden">',
        'after_title' => '</span>',
       
    ));



    // Oxo towe calendar

     register_sidebar(array(
        'name' => __('Oxo Tower', 'calendar'),
        'description' => __('Oxo Towder Calendar ...', 'calendar'),
        'id' => 'calendar-area',
        'before_widget' => '<div id="%1$s" class="oxo-calendar">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));



}


/*------------------------------------*\
  .  End OXO Side Bar
\*------------------------------------*/


/*------------------------------------*\
  10. Extra Function
\*------------------------------------*/

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}



// Remove Admin bar
function remove_admin_bar()
{
    return false;
}



// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function oxowp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}



// Custom Excerpts
function oxowp_index($length) // Create 20 Word Callback for Index page Excerpts, call using oxowp_excerpt('oxowp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using oxowp_excerpt('oxowp_custom_post');
function oxowp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function oxowp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}







function theme_deregister_jquery_from_wp_core() {
    if( is_admin() ) {
        return;
    }

    // Use jquery and jquery core from the google cdn instead of wordpress included
    wp_deregister_script( 'jquery-ui-core' );
    wp_deregister_script( 'jquery-ui-tab' );
    wp_deregister_script( 'jquery-ui-autocomplete' );
    wp_deregister_script( 'jquery-ui-accordion' );
    wp_deregister_script( 'jquery-ui-autocomplete' );
    wp_deregister_script( 'jquery-ui-button' );
    wp_deregister_script( 'jquery-ui-datepicker');
    wp_deregister_script( 'jquery-ui-dialog' );
    wp_deregister_script( 'jquery-ui-draggable' );
    wp_deregister_script( 'jquery-ui-droppable' );
    wp_deregister_script( 'jquery-ui-mouse' );
    wp_deregister_script( 'jquery-ui-position' );
    wp_deregister_script( 'jquery-ui-progressbar');
    wp_deregister_script( 'jquery-ui-resizable' );
    wp_deregister_script( 'jquery-ui-selectable');
    wp_deregister_script( 'jquery-ui-slider' );
    wp_deregister_script( 'jquery-ui-sortable' );
    wp_deregister_script( 'jquery-ui-tabs' );
    wp_deregister_script( 'jquery-ui-widget' );
    wp_deregister_script( 'jquery' );
}

/**
 * Register jQuery and jQuery UI from Google Cdn
 *
 * @return void
 */
function theme_register_jquery_from_cdn() {
    if( is_admin() ) {
        return;
    }
    // Unregister currents jquery
    theme_deregister_jquery_from_wp_core();

    // Register from google cdn
    wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js' );
    wp_register_script( 'jquery-ui-core', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array( 'jquery' ), '1.12.1', true);
}

   

/*-------------RR New line Wed-----------------------*\
\*------------------------------------*/

function custom_title( $title_parts ) {
    $page_id   = site_get_page_id(); // custom function, you might want to use global $post here
    $seo_title = @get_post_meta( $page_id, '_aioseop_title' );

    if ( isset( $seo_title[0] ) ) {
        $title = $seo_title[0];
    } elseif ( isset( $page_id ) ) {
        $title = get_the_title( $page_id );
    }

    $page_title           = isset( $title ) ? $title : 'Page not found in backend';
    $title_parts['title'] = $page_title;

    return $title_parts;
}



/*------------------------------------*\
	11 Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'oxoblank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_enqueue_scripts', 'oxoblank_styles'); // Add Theme Stylesheet
add_action('init', 'register_OXO_menu'); // Add HTML5 Blank Menu
add_action('init', 'oxowp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head','wp_oembed_add_discovery_links');
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

// Add Filters

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3 );

function wpse156165_menu_add_class( $atts, $item, $args ) {
    $class = get_the_title();
    $atts['class'] = $class;
    return $atts;
}

add_action( 'wpcf7_init', 'custom_views_post_title' );

function custom_views_post_title() {
    wpcf7_add_shortcode( 'custom_views_post_title', 'custom_views_post_title_shortcode_handler' );
}

function custom_views_post_title_shortcode_handler( $tag ) {
    global $post;
   $title = get_the_title();
   $output .= '<option value="'. $post->ID .'">'. $title .' </option>';
    return $output;

}




wp_localize_script( 'twentyfifteen-script', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No post found', 'twentyfifteen'),
));
function more_post_ajax(){

    $postsPerPage = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $brand_name = (isset($_POST['brand_name'])) ? $_POST['brand_name'] : '';
    header("Content-Type: text/html");

   if($brand_name=='everything')
   {
	   $args = array( 'suppress_filters' => true,'posts_per_page' => $postsPerPage, 'post_type' => 'post', 'paged'    => $page); 
   
	   
   }
   else{
	   
	 $args = array( 'suppress_filters' => true,'posts_per_page' => $postsPerPage, 'tag' => $brand_name, 'paged'    => $page);	 
   }
	

    $loop = new WP_Query($args);

    $out = '';
	/*
if (have_posts()) :
                        while (have_posts()) : the_post(); */ 
   if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
	//$out .='hello';
	?>
	
	  
	  <?php  if($brand_name=='everything')
   {
	   echo ' <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 ebox">';
	   
   }
   else{
	   
	 echo ' <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 moreFbox">';
   }
   ?>
       
                                <div class="card-content">
                                    <div class="card-img">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?></a>
                                    </div>
                                    <div class="card-desc">
                                        <h3>
                                            <a href="<?php the_permalink(); ?>"><?php 
                                                $post_title_content = the_title();
                                                echo substr($post_title_content, 0, 20);
                                             ?></a>
                                        </h3>
                                        <p class="listing-date"> <?php $post_date = get_the_date('l F j ');
                                            echo $post_date; ?></p>
                                        <p> <?php 
                                            $excerpt = get_the_excerpt();
                                            $excerpt = substr( $excerpt , 0, 90); 
                                            echo $excerpt;
                                         ?></p>
                                        <a href="<?php the_permalink(); ?>"><?php //the_title(); ?></a>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php the_permalink(); ?>"><?php //the_title(); ?></a>
							<?php

    endwhile;
    endif;
    wp_reset_postdata();
	//$out='';
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


?>
