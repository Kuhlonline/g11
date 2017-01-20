var api         = {};     
var endpoint    = './api/v1/';
var music       = false;

function init() {
    api         = new webCore(endpoint);
    api.token   = '4eeca4364c8b1c2f06ec2944e9f08931';
}

function playBackgroundMusic() {
    if (!$('audio')[0]) return;

    var player      = $('audio')[0];
    player.volume   = '0.15';
    player.play();

    music           = true;
}

function pauseBackgroundMusic() {
    if (!$('audio')[0]) return;

    var player      = $('audio')[0];
    player.pause();

    music           = false;
}