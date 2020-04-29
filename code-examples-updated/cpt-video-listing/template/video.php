
    <div class="container">
        <h1 class=" col-sm-12 text-center" > <?php echo _e('Video listing', 'video-text-domain'); ?></h1>
        <div class="row">

            <div class="col-sm-4 col-lg-3 col-md-3 filter">
                <form id="filter-video">
                    <input type="hidden" name="action" value="video_lists">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="price-range"><?php echo _e('Video Name', 'video-text-domain'); ?></label>
                        <div class="clear-fix"></div>
                        <input name="filter[title]" type="text" placeholder="<?php echo _e('Video Name', 'video-text-domain'); ?>" class="input-location form-control"/>
                        <div class="clear-fix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="star-range"><?php echo _e('Video Type', 'video-text-domain'); ?></label>
                        <select class="form-control select-range" name="filter[videotype]">
						 <option value="" selected><?php echo _e('Select Type', 'video-text-domain'); ?></option>
                            <option value="Youtube" ><?php echo _e('Youtube', 'video-text-domain'); ?></option>
                            <option value="Vimeo"><?php echo _e('Vimeo', 'video-text-domain'); ?></option>
                            <option value="Dailymotion"><?php echo _e('Dailymotion', 'video-text-domain'); ?></option>
                         
                        </select>

                     
                    </div>
                </div>

				</br>
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-default btn-primary video-filter"><?php echo _e('Filter', 'video-text-domain'); ?><</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-sm-8 col-lg-9 col-md-9" id="video-lists"></div>
        </div>

        <div class="row">
            <div class="col-sm-4 col-lg-2 col-md-2">

            </div>
            <div class="col-sm-8 col-lg-8 col-md-8" id="pagination"></div>
        </div>
    </div>


<script type="text/x-template" id="video-view-template">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="thumbnail col-sm-12 col-md-4" style="height:150px;">
            <img style="_DISPLAY_NONEIMG_" class="image-url" width="275" height="183" src="_IMAGE_URL_" />
			<iframe height="140px" style="_DISPLAY_NONEIFR_" class="video-url"   src="_MY_URL_">
           </iframe> </div>
        <div class="caption col-sm-8">
            <h2>_TITLE </h2>
            <p> <b> <?php echo _e('Video Title : ', 'video-text-domain'); ?></b> <span class="title">_TITLE_V_</span></p>
			 <p> <b> <?php echo _e('Video Sub Title :', 'video-text-domain'); ?> </b> <span class="title">_TITLE_S_</span></p>
            <p> <b>  <?php echo _e('Video Type: ', 'video-text-domain'); ?></b><span class="star">_TYPE_</span></p>
            <p class="description">_DESCRIPTION_</p>
        </div>
    </div>
</script>


<script type="text/x-template" id="video-view-template-not-found">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="thumbnail">
        <div class="caption">
            <p><?php echo _e('No Video found!', 'video-text-domain'); ?></p>
        </div>
    </div>
</script>