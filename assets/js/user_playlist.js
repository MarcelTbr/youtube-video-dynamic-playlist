$(document).ready(function () {

    $('.up').on('click', this, function () {
        upvoteSong(this)
    });
    $('.down').on('click', this, function () {
        downvoteSong(this)
    });
    $('#get_songs').on('click', getAllSongs);
    getAllSongs();
    setInterval(getAllSongs, 2000);

    video_check_interval = setInterval(function(){checkTopVideo()}, 3000);
    clearInterval(video_check_interval);

    $('#stop_audio').on('click', stopAudio);
    $('#single_user_enable').on('click', enableSoloMode);

    var e = document.getElementById('info');
    $('#single_user_enable').hover(function(){e.style.visibility = 'visible';}, function () {
        e.style.visibility = 'hidden';
    });
});

function enableSoloMode() {
    console.log("Clear interval Stop Audio");

    //clearInterval(stop_audio_interval);
    var $src = $('#myVideo')[0].src;
    $('#myVideo')[0].src = $src + "?autoplay=1";

   video_check_interval = setInterval(function(){checkTopVideo()}, 3000);
}

function stopAudio() {
    console.log("Stop Audio");

    clearInterval(video_check_interval);
    var $src = $('#myVideo')[0].src;
    // console.log("$src: " + $src);
    $('#myVideo')[0].src = $src.substr(0, $src.length-11);


}


function compareVideos(top_video_url, current_video_url) {

    var areEqual = top_video_url.localeCompare(current_video_url) == 0;
    var isCurrent = top_video_url+"?autoplay=1" == current_video_url; // !=
    console.info("top_video_url", top_video_url);
    console.info("current_video_url", current_video_url);
    console.info("areEqual", areEqual);
    console.info("isCurrent", isCurrent);
    if (isCurrent && areEqual) {

        console.info("let the video play-through");


    } else {
        var $src = $('#myVideo')[0].src;

        var src_playing = $src.substring(0, $src.length - 11);

        var areEqualLength = top_video_url.localeCompare(src_playing) == 0;

        if (areEqualLength) {
            console.info("areEqualLength", areEqualLength);
            console.info("let the video play-through, it's just in autoplay");

        } else {
                console.log("Autoplaying: " + $('#myVideo')[0].src);
            /**
             * autoplay only after second check (have to be the same after removing ?autoplay=1 string
             */
            $('#myVideo')[0].src = top_video_url + "?autoplay=1";

        }


    }

}


function checkTopVideo() {

    var $src = $('#myVideo')[0].src;
    console.info("current_video_url", $src);

    var id = $('.video_row')[1].id;

    console.log("top_video_id: " + id);

    $.ajax({
        url: 'get_top_video_url/' + id,
        type: 'POST',
        success: function (data) {
            console.info("top_video_url", data);

        }
    }).then(function (data) {

        compareVideos(data, $src);

    });

    return this;
}

function upvoteSong(id) {

    console.log("VOTED!");
    console.log("upvote", id);

    /** song_up/id **/
    $.ajax({
        url: 'song_up/' + id,
        type: 'POST',
        success: function () {
            //console.log("song points: " + data);

        }
    }).done(function () {


    });

}

function downvoteSong(id) {

    console.log("DownVOTED!");
    console.log("downvote", id);

    /** song_down/id **/
    $.ajax({
        url: 'song_down/' + id,
        type: 'POST',
        success: function (data) {
            console.log("song points: " + data);

        }
    }).done(function () {


    });

}

function getAllSongs() {
    var $url = 'get_all_songs';
    $.ajax({
        url: $url,
        type: 'POST',
        success: function (result) {
            var songs = JSON.parse(result);
            //console.info('result', result);
            //songs.forEach(displaySongs);

        }

    }).done(function (result) {
        var songs = JSON.parse(result);
        makePlaylist(songs)

    });
}

function displaySongs(item, index) {

    console.info(item.id, item.video_title);

}

function makePlaylist(songs) {

    function makeRow(song, index) {

        var row = $('<div class="video_row" id="' + song.id + '"></div>');
        var num = $('<span class="round"> ' + ++index + ' </span>');
        row.append(num);
        var title = $('<span class="title">' + song.video_title + '</span>');
        row.append(title);
        // var src = $('<span>' + song.video_url + '</span>');
        // row.append(src);
        var count_span = $('<span class="count-span"></span>');
        var votes = $('<span class="square"><b>' + song.votes + '</b></span>');
        count_span.append(votes);
        var up = $('<button ><a href="javascript:upvoteSong(' + song.id + ' )"><img class="up" src="../assets/img/arrow_up_48px.svg" ></a></button>');
        count_span.append(up);
        var down = $('<button ><a href="javascript:downvoteSong(' + song.id + ' )"><img class="down" src="../assets/img/arrow_down_48px.svg" ></a></button> ');
        count_span.append(down);
        row.append(count_span);

        return row;
    }

    function makeHeader() {
        var row = $('<div class="video_row" id="row_title"><span>Rank</span><span class="title">Title</span><span class="count-span"><span>Votes</span><span>Up || Dw</span></span></div>');
        return row;
    }

    $('#playlist').html("");
    $('#playlist').append(makeHeader());

    songs.forEach(function (song, index) {

        $('#playlist').append(makeRow(song, index));

    })

}