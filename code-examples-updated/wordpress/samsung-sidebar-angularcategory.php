<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */


function is_b2bfield_by_label($l = null, $t = null)
{
    if ($l == null || $t == null) return false;
    $fields = get_acf_fields($t);
    if (!is_array($fields)) return false;
    $ret = false;
    foreach ($fields as $field) {
        foreach ($field as $f) {
            if ($f['label'] == $l) $ret = true;
        }
        if ($field['label'] == $l) $ret = true;
    }
    return $ret;
}

function get_options_by_label($l = null, $t = null)
{
    if ($t == null) return false;
    $fields = get_acf_fields($t);
    if (!is_array($fields)) return false;
    $return = false;
    if ($l == null) {
        $return = $fields;
    } else {
        foreach ($fields as $field) {
            if ($field['label'] == $l) $return = $field;
        }
    }
    return $return;
}

function get_acf_fields($tarm)
{
    $pages = get_posts(array(
        'post_type' => 'b2bproducts',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'b2bproducts_category',
                'terms' => $tarm,
            )
        )
    ));
    $id = $pages[0]->ID;
    if (empty($id)) {
        $posts = get_posts(array(
            'post_type' => 'b2bproducts',
            'numberposts' => -1,
        ));
        $id = $posts[0]->ID;
    }
    $defaults = array(
        'post_id' => $id,
        'post_category' => array($tarm),
        'taxonomy' => array($tarm)
    );
    $ids = apply_filters('acf/location/match_field_groups', array(), $defaults);
    if (!is_array($ids)) return false;
    $fields = array();
    foreach ($ids as $id) {
        if ($id != 1275) $fields = apply_filters('acf/field_group/get_fields', array(), $id);
    }
    return $fields;
}

?>


<!---sidebar---->

<div class="left-sidebar">


    <!---CAT WIDGET---->
    <div class="cat-widget product-related-menu">

        <h4><?php _e('Product Category','samsung'); ?></h4>

        <!-- <ul>
            <li class="active"><a href="#">Cameras</a></li>
            <li><a href="#">Lens</a></li>
             <li><a href="#">Monitors</a></li>
              <li><a href="#">Video Recorders</a></li>
               <li><a href="#">Encoders</a></li>
                <li><a href="#">Decoders</a></li>
                 <li><a href="#">Controllers</a></li>
                  <li><a href="#">Accessories</a></li>
                   <li><a href="#">Software</a></li>
        </ul> -->
        <?php echo get_product_left_menu(); ?>

        <ul>
            <?php $term = get_term(153, 'b2bproducts_category'); ?>
            <li><a href="<?php echo get_term_link(153, 'b2bproducts_category'); ?>"><?php echo $term->name; ?></a></li>
            <?php $term = get_term(145, 'b2bproducts_category'); ?>
            <li><a href="<?php echo get_term_link(145, 'b2bproducts_category'); ?>"><?php echo $term->name; ?></a></li>
        </ul>

    </div>
    <!---CAT WIDGET---->


    <!---CAT WIDGET---->


    <!---CAT WIDGET---->
    <div class="cat-widget product-related-menu">

        <h4><?php _e('Product Family','samsung'); ?></h4>

        <ul style="width:100%">
            <li class="{{cate}}" ng-repeat="cate in cat" ng-class="{active: $index == selected}"><a
                    ng-click="filter(cate.toLowerCase(),$index)" href="javascript:void(0)">{{cate}}</a></li>

        </ul>

    </div>
    <!---CAT WIDGET---->


    <!---CAT WIDGET---->
    <div id="filter" class="cat-widget">

        <h4><?php echo icl_translate('samsung','Filter by','Filter by'); ?></h4>

        <!--accordion--->
        <div class="acc-product accordion-effect">
            <ul id="accordion">

                <!--repeater--->

                <!--repeater--->
                <li>

                    <span ng-hide="resolution.length<1" class="tab-heading"><?php _e('Resolution','samsung'); ?></span>

                    <div class="tab-reveal">


                        <!---attribute---->
                                            <span ng-repeat="res in resolution" class="attribute">
                                            	<input type="checkbox" ng-click="filterChecked()" class="checkbox">
                                                <span class="attribute-label">{{res}}</span>
                                            </span>

                        <!---attribute---->

                    </div>

                </li>
                <!--repeater--->

                <!--repeater--->
                <li>

                    <span ng-hide="ptype.length<1" class="tab-heading"> <?php _e('Product Type','samsung'); ?> </span>

                    <div class="tab-reveal">


                        <!---attribute---->
                                            <span ng-repeat="pt in ptype" class="attribute">
                                            	<input type="checkbox" ng-click="filterChecked()" class="checkbox">
                                                <span class="attribute-label">{{pt}}</span>
                                            </span>
                        <!---attribute---->

                    </div>

                </li>
                <!--repeater--->

                <li>

                    <span ng-hide="series.length<1" class="tab-heading"> <?php _e('Series','samsung'); ?>  </span>

                    <div class="tab-reveal">


                        <!---attribute---->
                                            <span ng-repeat="ser in series" class="attribute">
                                            	<input type="checkbox" ng-click="filterChecked()" class="checkbox">
                                                <span class="attribute-label">{{ser}}</span>
                                            </span>
                        <!---attribute---->

                    </div>

                </li>
                <!--repeater--->

                <li>

                    <span ng-hide="platform.length<1" class="tab-heading"> <?php _e('Platform','samsung'); ?>   </span>

                    <div class="tab-reveal">


                        <!---attribute---->
                                            <span ng-repeat="pla in platform" class="attribute">
                                            	<input type="checkbox" ng-click="filterChecked()" class="checkbox">
                                                <span class="attribute-label">{{pla}}</span>
                                            </span>
                        <!---attribute---->

                    </div>

                </li>


                <!--repeater--->
                <li>

                    <span ng-hide="environment.length<1" class="tab-heading"><?php _e('Environment','samsung'); ?></span> 

                    <div class="tab-reveal">


                        <!---attribute---->
                                            <span ng-repeat="en in environment" class="attribute">
                                            	<input type="checkbox" ng-clicked="filterChecked()" class="checkbox">
                                                <span class="attribute-label">{{en}}</span>
                                            </span>
                        <!---attribute---->


                    </div>

                </li>
                <!--repeater--->
                
                <li>
                    <span ng-hide="out_of_the_box_active.length < 1" class="tab-heading"><?php echo icl_translate('generic','sidebar-environment','Out of the box'); ?></span>
                    <div class="tab-reveal">
                        <!---attribute---->
                        <span ng-repeat="en in out_of_the_box_active" class="attribute">
                            <input type="checkbox" ng-click="filterChecked()" class="checkbox filter-out-of-the-box" value="{{en.value}}">
                            <span class="attribute-label">{{en.label}}</span>
                        </span>
                        <!---attribute---->
                    </div>
                </li>                                


            </ul>


        </div>
        <!--accordion--->


    </div>
    <!---CAT WIDGET---->


    <!---need help---->
    <div class="need-help widget-corner">

        <a href="<?php echo get_permalink(icl_object_id(1868, 'page', false, ICL_LANGUAGE_CODE)); ?>">

            <img class="help-image" src="<?php echo get_asset_url('images/small-contact.jpg'); ?>">

            <div class="bottom-caption">
                <h3><?php echo icl_translate('Generic', 'Sidebar texts', 'NEED MORE HELP?'); ?></h3>
                <span
                    class="small-texts"><?php echo icl_translate('Generic', 'Sidebar texts 2', 'Get in touch'); ?></span>
            </div>
                     
                     <span class="corner-flag">
                     	+
                     </span>

        </a>


    </div>
    <!---need help---->


    <!---sidebar---->


</div>


<!---sidebar---->