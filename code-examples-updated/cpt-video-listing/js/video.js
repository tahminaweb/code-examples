(function ($) {
    var video = {
        videoCollection : [],
        init: function () {
            this.loadvideo(undefined);
            $('.video-filter').click(this.events.filterClick);
        },

        paginate: function () {

            $('#pagination').pagination({
                dataSource: this.videoCollection,
                callback: function(data, pagination) {
                    video.render(data);
            }});
        },

        render: function (data) {

            $('#video-lists').html('');

            if(data.length == 0 || data === undefined) {
                $('#video-lists').append( $('#video-view-template-not-found').html());
            }

            $.each(data, function (key, val) {
                var template = $('#video-view-template').html();
              
                template = template.replace('_LINK_',  val.url);
                template = template.replace('_TITLE_V_',  val.title_v);template = template.replace('_TITLE_S_',  val.title_s);
				//template = template.replace('TITLE_S',  val.title_s);
                template = template.replace('_TITLE', val.title);
                template = template.replace('_DESCRIPTION_', val.description);
                template = template.replace('_PRICE_', val.price);
                template = template.replace('_LOCATION_', val.location);
				template = template.replace('_TYPE_', val.type);
				if(val.my_url && val.my_url!='')
				{
                template = template.replace('_MY_URL_', val.my_url);
				 template = template.replace('_DISPLAY_NONEIMG_', 'Display:none;');
				
				}
				else
				{
					  template = template.replace('_IMAGE_URL_', val.thumb);
					 template = template.replace('_DISPLAY_NONEIFR_', 'Display:none;');
				}
                $('#video-lists').append(template);
                console.log(val.thumb);
                console.log(val.media);

            });
        },

        loadvideo: function (filter) {
            var self = this;
            if(filter === undefined) {
                filter = {action: "video_lists"};
            }

            $.ajax({
                url: ajax_url,
                data: filter,
                success: function (result) {
                    self.videoCollection = result.data;
                    self.paginate();
                }
            });
        },

        events: {
            filterClick : function (e) {
                e.preventDefault();
                video.loadvideo($('#filter-video').serializeArray());
            }
        }
    };


    video.init();

})(jQuery)




