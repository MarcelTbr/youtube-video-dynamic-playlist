$(document).ready(function () {

    $('.up').on('click', this, function () {
        upvoteSong(this)
    });
    $('.down').on('click', this, function () {
        downvoteSong(this)
    });
    $('#get_songs').on('click', getAllSongs);
    setInterval(getAllSongs, 2000);
});

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