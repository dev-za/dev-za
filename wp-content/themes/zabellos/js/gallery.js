
$(document).ready(function($) {



    //save .wrapper block width
    window.wrapperWidth = $('.wrapper').width();


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
                        var iconText = 'View';
                        var videoIconClass = '';
                        console.log(item.isVideo);
                        if(item.isVideo){
                            iconText = '<img src="/wp-content/themes/zabellos/images/gallery/playVideo.png">';
                            videoIconClass = 'video-icon';
                        }

                        var dataTargetNum = loadedItems + index;
                        thumbnails += '<div class="col-xs-6 col-sm-4">' +
                        '<div class="gallery-img">' +
                        '<img src="'+item.url+'" alt="'+item.alt+'" width="381" height="382" class="img-responsive" />' +
                        '<div class="hover-view">' +
                        '<a href="#" role="button" data-toggle="modal" data-target="#gallery-modal-'+ dataTargetNum +'" class="'+videoIconClass+'">'+iconText+'</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    });
                }

                if(typeof response.popups == 'object'){
                    $.each(response.popups, function(index, item){
                        var dataTargetNum = loadedItems + index;
                        popups +=
                            '<div class="modal fade modalVideo" tabindex="-1" role="dialog" aria-hidden="true" id="gallery-modal-'+dataTargetNum+'">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="button-close">' +
                                            '<button onclick="modalHideHandler(null, \'img-popup'+dataTargetNum+'\')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                                        '</div>' +
                                        '<div class="modal-body">' +
                                            '<div class="img-popup" id="img-popup'+dataTargetNum+'">';

                        if(item.isVideo === true){
                            popups += '<iframe width="500" height="360" frameborder="0" title="YouTube video player" type="text/html" src="http://www.youtube.com/embed/'+item.video_id+'?enablejsapi=1"></iframe>';
                        }
                        else{
                            popups += '<img src="'+item.url+'" alt="'+item.alt+'" class="img-responsive" />';
                        }

                        //modal window handlers
                        popups += '<script>$("#gallery-modal-'+dataTargetNum+'").on(\'hide.bs.modal\', modalHideHandler);</script>';
                        popups += '<script>$("#gallery-modal-'+dataTargetNum+'").on(\'show.bs.modal\', modalShowHandler);</script>';



                         popups +=  '</div>' +
                        '<div class="popup-comments">';

                        moment.locale('en', {
                            calendar : {
                                lastDay : '[yesterday]',
                                sameDay : '[today]',
                                nextDay : '[tomorrow]',
                                lastWeek : 'DD.MM.YYYY',
                                nextWeek : 'DD.MM.YYYY',
                                sameElse : 'DD.MM.YYYY'
                            }
                        });

                        var comments = item.comments;
                        $.each(comments, function(index, comment){

                            var date = moment(comment.comment_date).calendar();

                            popups +=               '<div class="item-comment '+((index == 0)?'first-item-comment':'')+'">' +
                            '<p>'+comment.comment_author+'&nbsp' +
                            '<time datetime="'+comment.comment_date+'">'+date+'</time>' +
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
                }

                window.totalItems = response.totalItems;
                $('div#inifiniteLoader').hide();
                window.isLoading = false;
            }
        });

    }
});

function modalShowHandler(e){
    //apply saved width
    $('.wrapper').width(window.wrapperWidth);
}

function modalHideHandler(e, videoContainerId){
    if(!videoContainerId){
        var id = e.target.id;
        $('#'+id+' .img-popup').each(function(){
            var videoContainerId = $(this).attr('id');
            callPlayer(videoContainerId, 'stopVideo');
        });
    }
    else{
        callPlayer(videoContainerId, 'stopVideo');
    }
}

function callPlayer(frame_id, func, args) {
    if (window.jQuery && frame_id instanceof jQuery) frame_id = frame_id.get(0).id;
    var iframe = document.getElementById(frame_id);
    if (iframe && iframe.tagName.toUpperCase() != 'IFRAME') {
        iframe = iframe.getElementsByTagName('iframe')[0];
    }
    if (iframe) {
        // Frame exists,
        iframe.contentWindow.postMessage(JSON.stringify({
            "event": "command",
            "func": func,
            "args": args || [],
            "id": frame_id
        }), "*");
    }
}
