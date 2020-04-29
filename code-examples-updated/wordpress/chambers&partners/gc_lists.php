<?php 
   $termslists = get_terms('gc_list');
 ?>



<div class="clearfix release-section">
    <div class="wprapper-bx">
        <div class="row">
		<?php
		if (!empty($termslists ) && !is_wp_error($termslists )) {
		   foreach ($termslists  as $term) {
			  $taxonomy = $term->taxonomy;
			  $term_id = $term->term_id;
			  $logo = get_field('gc_list_logo', $taxonomy.'_'.$term_id);
               $link = get_permalink($taxonomy.'_'.$term_id);

			  $associates_with = get_field('select_associate', $taxonomy.'_'.$term_id);
			  $associate_names = array();
			  
			   ?>
            <div class="col-sm-12 col-md-6">
                <div class="release-list">
                    <div class="release-left">
                        <img src="<?php print_r($logo)?>" alt="">
                    </div>
                    <div class="release-right">
                        <div class="release-content">
                            <h2><a href="<?php echo $term->slug; ?> ">  <?=$term->name?>   </a></h2>
                        </div>
                        <?php 
						//echo count($associates_with);
						if(!empty($associates_with)){
						?>
                        <div class="associ-bx">
                            <p>IN ASSOCIATION WITH</p>
							<?php
							foreach($associates_with as $associate){
												 //$company_logo = get_field('company_logo', 'gc_company_'.$associate);
												 $terma = get_term( $associate, 'gc_company' );
												 $associate_names[] = $terma->name;
			                  
							  }
							?>
                            <span><?php echo implode(" ",$associate_names)?><span>
                        </div>
						<?php
						}
						?>
                        <a href="<?php echo $term->slug; ?> " class="arrow-right"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            
             <?php
                               // echo'<option value="' .$home_url.'/'.$term->taxonomy.'/'.$term->slug.'" >' . $term->name . '</option>'."\r";
                           }
                        }
             ?>
            
            
        </div>
       
    </div>