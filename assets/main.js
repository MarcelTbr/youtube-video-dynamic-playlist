$(document).ready(function () {

    //$('input[type="submit"]').on('click', changeVideo);



});

var changeVideo = function(e){

    e.preventDefault();

    //reset video title
    //$('#vid_title').html('');

    var $yt_url = $('#yt_video').val();

    var url_root = 'https://www.youtube.com/embed/';

    var yt_video_id = $yt_url.slice(32, $yt_url.length);

    $('#out').html(url_root+yt_video_id);
        console.info("url_root", url_root);
        console.info("yt_video_id", yt_video_id);


    /* === AUTOPLAY === */
    document.getElementById('myVideo').contentWindow.location = (url_root + yt_video_id + '?autoplay=1');

    //document.getElementById('myVideo').contentWindow.location = (url_root + yt_video_id);

    //reset the input field
    $('#yt_video').val('');


};

