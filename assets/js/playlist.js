// create youtube player
var player;
function onYouTubePlayerAPIReady() {
    player = new YT.Player('player', {
        height: '195',
        width: '100%',
        videoId: '',
        playerVars: {
            'showinfo': 0,
            'controls': 1,
            'rel': 0,
            'enablejsapi': 1
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange,
            'onError': onPlayerError
        }
    });
}
// autoplay video
function onPlayerReady(event) {
    event.target.playVideo();
}

function stopVideo(){
    player.stopVideo();

}
// when video ends
function onPlayerStateChange(event) {

    video_check_interval = setInterval(function () {
        checkTopVideo(player);
    }, 3000);
    clearInterval(video_check_interval);

    /** whent video is done playing */
    if (event.data === 0) {

        //var curr_promise = getCurrentSong();
        var id = $('.video_row')[1].id;
        var song_promise = getSongById(id);

        song_promise.then(function(data){

            var song = JSON.parse(data);

            /**
             * if top song votes are 0
             * get total number of videos on the list
             * play a random song of the playlist
             * */
            if (song.votes == 0) {

                $.ajax({
                    url: 'get_number_of_videos',
                    type: 'GET'

                }).done(function (data) {

                    var next_song_index = Math.floor((Math.random() * data) + 1);
                    console.info("next_song_index", next_song_index);
                    var next_song_id = $('.video_row')[next_song_index].id;

                    playSongById(next_song_id);
                });

            } else {
                /**
                 * play top video
                 */
                $.ajax({
                    url: 'get_playing_video_id',
                    type: 'GET',
                    success: function (data) {

                        var id = data;
                        console.info("playing Video ID", id);
                        var promise = resetPlayingVideoVotes(id);

                        promise.then(function () {
                            checkTopVideo(player);
                            setPlayingVideo();

                        });
                    }
                });

            }

        });

    } else if (event.data === 1) {

        console.info("Video is PLAYING")
        clearInterval(video_check_interval);

    } else {
        console.info("Waiting");
    }
}
/**
 * jQuery event handlers and intervals
 * */

$(document).ready(function () {

    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    $('.up').on('click', this, function () {
        upvoteSong(this)
    });
    $('.down').on('click', this, function () {
        downvoteSong(this)
    });
    $('#get_songs').on('click', getAllSongs);
    getAllSongs();
    setInterval(getAllSongs, 2000);
    setInterval(displayCurrentSong, 2000);


    $('#start').on('click', function () {

        player = makeYoutubePlayer();
        //checkTopVideo(player);
        playTopVideo(player);
        setTimeout(videoVisible, 3000);
        setPlayingVideo();
        player.playVideo();
    });
    $('#stop').on('click', stopVideo);

    $('#next').on('click', function () {

        nextVideo();
    });

    $('#random').on('click', randomVideo);

    $('#down1').on('click', down1);

});


/**
 * functions
 *
 */

function down1(){
    var promise = getCurrentSong();

    promise.then(function(data){

        var song = JSON.parse(data);
        console.info("song.id", song.id);
        var current_song = document.getElementById(song.id);

        console.info("current_song", current_song);
        var next_song_id = current_song.nextSibling.id;
        console.info("next_song_id", next_song_id);

       playSongById( next_song_id );

    })

}

function playSongById(next_song_id) {

    $.ajax({
        url: 'get_top_video_url/' + next_song_id,
        type: 'POST'

    }).done(function (data) {

        var next_video_id = data.substring(30, data.length);

        player.loadVideoById(next_video_id, 0, "large");
        player.playVideo();

        $.ajax({
            url: 'set_playing_video/' + next_song_id,
            type: 'POST'
        })


    });


}

function getSongById(id){

    return $.ajax({
        url: 'get_song_by_id/' + id,
        type: 'POST'
    })
}

function getCurrentSong(){
    return  $.ajax({
        url: 'get_current_song',
        type: 'GET'

    });
}

function randomVideo() {
    $.ajax({
        url: 'get_current_song',
        type: 'GET'

    }).done(function (data) {

        var song = JSON.parse(data);


        if (song.votes == 0) {

            $.ajax({
                url: 'get_number_of_videos',
                type: 'GET'

            }).done(function (data) {

                var next_song_index = Math.floor((Math.random() * data) + 1);
                console.info("next_song_index", next_song_index);
                var next_song_id = $('.video_row')[next_song_index].id;

                playSongById(next_song_id);
            });

        } else {

            console.info("Random is not possible. Wait until all votes are 0")
        }


    });


}


function displayCurrentSong() {

    $.ajax({
        url: 'get_current_song',
        type: 'GET',
        success: function (data) {

            var curr = JSON.parse(data);


            var span = $('<span id="curr_' + curr.id + '" >' + curr.video_title + '</span>');
            $('#display-current').html("");
            $('#display-current').append(span);

        }

    })


}
function makeYoutubePlayer(){

    var player = new YT.Player('player', {
        height: '195',
        width: '100%',
        videoId: '',
        playerVars: {
            'showinfo': 0,
            'controls': 1,
            'rel': 0,
            'enablejsapi': 1
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange,
            'onError': onPlayerError
        }
    });

    return player;
}

function nextVideo() {

    $.ajax({
        url: 'get_playing_video_id',
        type: 'GET',
        success: function (data) {

            var id = data;
            console.info("playing Video ID", id);
            resetPlayingVideoVotes(id);

        }
    });


}

//when error
function onPlayerError(event){

    console.info("There was an error", event.data);
    if(event.data == 150){

        console.info( "Error 150. Owner does not allow embedded videos");
        var song_promise = getCurrentSong();
        song_promise.then(function(data){

            var song = JSON.parse(data);
            downvoteSong(song.id);
            downvoteSong(song.id);
            downvoteSong(song.id);
            playTopVideo(player);
            setPlayingVideo();
        });



    } else if( event.data == 2) {

        console.info("Error 2. Cannot load the video");
        stopVideo();
        playTopVideo(player);
        setPlayingVideo();
    }else{
        playTopVideo(player);
        stopVideo();
        setPlayingVideo();
    }
}

function videoVisible() {

    $('.YT-video-API')[0].style.display = 'block';

}

function setPlayingVideo() {

    var id = $('.video_row')[1].id;

    $.ajax({
        url: 'set_playing_video/' + id,
        type: 'POST'
    })


}

function playTopVideo(player) {
    var id = $('.video_row')[1].id;

    console.log("top_video_id: " + id);

    $.ajax({
        url: 'get_top_video_url/' + id,
        type: 'POST',
        success: function (data) {
            console.info("top_video_url", data);
            var next_video_id = data.substring(30, data.length);

            player.loadVideoById(next_video_id, 0, "large");
        }
    });
}
function resetPlayingVideoVotes(id) {

    return $.ajax({
        url: 'reset_top_video_votes/' + id,
        type: 'POST'
    }).done(function () {

        setTimeout(function () {
            playTopVideo(player);

            setPlayingVideo();
        }, 2500);
    })
}

function resetTopVideoVotes() {

    var id = $('.video_row')[1].id;

    $.ajax({
        url: 'reset_top_video_votes/' + id,
        type: 'POST'
    })
}

function compareVideosIds(top_id, curr_id, player) {

    console.info("top_id", top_id);
    console.info("curr_id", curr_id);
    console.info("player.getVideoUrl()", player.getVideoUrl());
    var areEqual = top_id.localeCompare(curr_id) == 0;
    var isCurrent = top_id == curr_id;

    if (areEqual && isCurrent) {

        console.info("let the music play")
    } else {

        player.loadVideoById(top_id, 0, "large");

    }
}

function checkTopVideo(player) {

    // var $src = $('#myVideo')[0].src;
    // console.info("current_video_url", $src);

    var id = $('.video_row')[1].id;

    console.log("top_video_id: " + id);

    $.ajax({
        url: 'get_top_video_url/' + id,
        type: 'POST',
        success: function (data) {
            console.info("top_video_url", data);

        }
    }).then(function (data) {

        //compareVideos(data, $src, player);

        var db_id = data.substring(30, data.length);
        var vid_url = player.getVideoUrl();
        var curr_id = vid_url.substring(vid_url.length - 11, vid_url.length);

        compareVideosIds(db_id, curr_id, player);
    });


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