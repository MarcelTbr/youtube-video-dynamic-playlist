$(document).ready(function () {

   $('#get_songs').on('click', getAllSongs);

   setInterval(getAllSongs, 2000);

});

function getAllSongs() {
    var $url = 'get_all_songs';
    $.ajax({
        url: $url,
        type: 'POST',
        success: function (result) {
            var songs = JSON.parse(result);
            //console.info('result', result);
            songs.forEach(displaySongs);

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

    function makeRow(song, index){

        var row = $('<div class="video_row"></div>');
        var num = $('<span> ' + ++index + ' </span>');
        row.append(num);
        var title = $('<span class="title">' +  song.video_title + '</span>');
        row.append(title);
        // var src = $('<span>' + song.video_url + '</span>');
        // row.append(src);
        var count_span = $('<span class="count-span"></span>');
        var votes = $('<span>0</span>');
        count_span.append(votes);
        var up = $('<img class="up" src="../assets/img/arrow_up_48px.svg" ></img>');
        count_span.append(up);
        var down = $('<img class="down" src="../assets/img/arrow_down_48px.svg" ></span>');
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

    songs.forEach(function(song, index){

        $('#playlist').append(makeRow(song, index));

    })

}