
$(document).ready(function($) {

    //save .wrapper block width
    window.wrapperWidth = $('.wrapper').width();
    console.log('window.wrapperWidth', window.wrapperWidth);

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
                var scripts = '';
                if(typeof response.thumbnails == 'object'){
                    $.each(response.thumbnails, function(index, item){
                        var iconText = 'View';
                        var videoIconClass = '';
                        console.log(item.isVideo);
                        if(item.isVideo){
                            iconText = '<img src="/wp-content/themes/zabellos/images/gallery/icon_play.png">';
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
                        var itemContent = '';
                        var itemClass = '';

                        //modal window handlers
                        scripts += '<script type="text/javascript">$("#gallery-modal-'+dataTargetNum+'").on(\'hide.bs.modal\', modalHideHandler);</script>';
                        scripts += '<script type="text/javascript">$("#gallery-modal-'+dataTargetNum+'").on(\'show.bs.modal\', modalShowHandler);</script>';

                        //content
                        if(item.isVideo === true){
                            itemClass = 'video-popup';
                            scripts += '<script type="text/javascript">resizeVideos()</script>';
                            itemContent = '<iframe width="500" height="360" frameborder="0" title="YouTube video player" type="text/html" src="http://www.youtube.com/embed/'+item.video_id+'?enablejsapi=1" allowfullscreen></iframe>';
                        }
                        else{
                            itemClass = 'img-popup';
                            itemContent = '<img src="'+item.url+'" alt="'+item.alt+'" class="img-responsive" />';
                        }

                        popups +=
                            '<div class="modal fade modalVideo" tabindex="-1" role="dialog" aria-hidden="true" id="gallery-modal-'+dataTargetNum+'">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="button-close">' +
                                            '<button onclick="modalHideHandler(null, \'img-popup'+dataTargetNum+'\')" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                                        '</div>' +
                                        '<div class="modal-body">';
                        //add content
                        popups+=            '<div class="'+itemClass+'" id="'+itemClass+dataTargetNum+'">'+itemContent+'</div>';

                        //comments
                        if(!item.isVideo) {
                            popups += '<div class="popup-comments">';
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
                            $.each(comments, function (index, comment) {

                                var date = moment(comment.comment_date).calendar();

                                popups += '<div class="item-comment ' + ((index == 0) ? 'first-item-comment' : '') + '">' +
                                '<p>' + comment.comment_author + '&nbsp' +
                                '<time datetime="' + comment.comment_date + '">' + date + '</time>' +
                                '</p>' +
                                '<p>' + comment.comment_text + '</p>' +
                                '</div>';

                            });
                            popups += '</div>'; //popup-comments
                            //end comments
                        }


                        popups += '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    });
                }


                $('.gallery-content .container .row').append(thumbnails);
                $('.popup').append(popups+scripts);


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
    console.log('modalShowHandler');
    console.log('window.wrapperWidth', window.wrapperWidth);
    $('.wrapper').width(window.wrapperWidth);
}

function modalHideHandler(e, videoContainerId){
    console.log('modalHideHandler');
    if(!videoContainerId){
        var id = e.target.id;
        $('#'+id+' .video-popup').each(function(){
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

function resizeVideos(){
    // Find all YouTube videos
    var $allVideos = $("iframe[src^='//www.youtube.com']"),

    // The element that is fluid width
        $fluidEl = $("body");

// Figure out and save aspect ratio for each video
    $allVideos.each(function() {

        $(this)
            .data('aspectRatio', this.height / this.width)

            // and remove the hard coded width/height
            .removeAttr('height')
            .removeAttr('width');

    });

    // When the window is resized
    $(window).resize(function() {

        var newWidth = $fluidEl.width();

        // Resize all videos according to their own aspect ratio
        $allVideos.each(function() {

            var $el = $(this);
            $el
                .width(newWidth)
                .height(newWidth * $el.data('aspectRatio'));

        });

        // Kick off one resize to fix all videos on page load
    }).resize();
}