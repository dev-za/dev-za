$(document).ready(function($) {
    window.loadedItems = 0;
    window.totalItems = 0;
    window.isLoading = false;

    loadGalleryItems(window.loadedItems);

    $(window).scroll(function(){
        if  ($(window).scrollTop() == $(document).height() - $(window).height() && !window.isLoading){
            if(window.loadedItems < window.totalItems){
                loadGalleryItems(window.loadedItems);
            }

        }
    });

    function loadGalleryItems(loadedItems){
        $('div#inifiniteLoader').show();
        window.isLoading = true;
        $.ajax({
            url:"/wp-content/themes/zabellos/ajax/load_gallery.php",
            type: 'GET',
            data: {postID: '16', loadedItems: loadedItems},
            success: function(response) {
                var thumbnails = '';
                var popups = '';
                if(typeof response.thumbnails == 'object'){
                    $.each(response.thumbnails, function(index, item){

                        var dataTargetNum = loadedItems + index;

                        thumbnails += '<div class="col-xs-6 col-sm-4">' +
                        '<div class="gallery-img">' +
                        '<img src="'+item.url+'" alt="'+item.alt+'" width="381" height="382" class="img-responsive" />' +
                        '<div class="hover-view">' +
                        '<a href="#" role="button" data-toggle="modal" data-target="#gallery-modal-'+ dataTargetNum +'">View</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    });
                }

                if(typeof response.popups == 'object'){
                    $.each(response.popups, function(index, item){
                        var dataTargetNum = loadedItems + index;
                        popups +=
                            '<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="gallery-modal-'+dataTargetNum+'">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="button-close">' +
                                            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<div class="img-popup">';
                        console.log(item.video_frame);
                        if(item.video_frame){
                            popups += item.video_frame;
                        }
                        else{
                            popups += '<img src="'+item.url+'" alt="'+item.alt+'" class="img-responsive" />';
                        }



                         popups +=  '</div>' +
                        '<div class="popup-comments">';

                        var comments = item.comments;
                        $.each(comments, function(index, comment){

                            popups +=               '<div class="item-comment '+((index == 0)?'first-item-comment':'')+'">' +
                            '<p>'+comment.comment_author+'&nbsp' +
                            '<time datetime="'+comment.comment_date+'">'+comment.comment_date+'</time>' +
                            '</p>' +
                            '<p>'+comment.comment_text+'</p>' +
                            '</div>';

                        });

                        popups +=                    '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    });
                }


                $('.gallery-content .container .row').append(thumbnails);
                $('.popup').append(popups);


                if(response.loadedItems){
                    window.loadedItems = response.loadedItems;
                    console.log(window.loadedItems);
                }

                window.totalItems = response.totalItems;
                $('div#inifiniteLoader').hide();
                window.isLoading = false;
            }
        });

    }
});