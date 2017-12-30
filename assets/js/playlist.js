$(document).ready(function () {

    $('.up').on('click', this, function () {
        upvoteSong(this)
    });
    $('.down').on('click', this, function () {
        downvoteSong(this)
    });

});

function upvoteSong(id) {

    console.log("VOTED!");
    console.log("upvote", id);

    /** song_up/id **/
    $.ajax({
        url: 'song_up/' + id,
        type: 'POST',
        success: function (data) {
            console.log("song points: " + data);

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