$(document).on('ready', function(event) {


    playBackgroundMusic();



    $('.audio-btn').on('click', function(event) {

        if (music) {
            $('.audio-btn').removeClass('glyphicon-pause').addClass('glyphicon-play');
        } else {
            $('.audio-btn').removeClass('glyphicon-play').addClass('glyphicon-pause');
        }

        return (music) ? pauseBackgroundMusic() : playBackgroundMusic();
    });

    $('a.signin').on('click', function(event) {
        $('div.signin').show(250);
        $('div.signup').hide(250);
    });

    $('a.signup').on('click', function(event) {
        $('div.signup').show(250);
        $('div.signin').hide(250);
    });

    $('button.signin').on('click', function(event) {

    });

    $('button.signup').on('click', function(event) {

    });


});