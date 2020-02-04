var video = document.querySelector('.rain');
var juice = document.querySelector('.v-juice');
var btn = document.getElementById('play-pause');
var btn2 = document.getElementById('mute-unmute');

function tooglePlayPause(){
    if(video.paused){
        btn.className = "pause";
        video.play();
    }else {
        btn.className = "play";
        video.pause();
    }
}

function toogleMuteUnmute(){
    if(video.muted){
        btn2.className = "mute";
        video.muted = false;
    }else{
        btn2.className = "unmute";
        video.muted = true;
    }
}

btn.onclick = function() {
    tooglePlayPause();
};

btn2.onclick = function() {
    toogleMuteUnmute();
};

video.addEventListener("timeupdate", function(){
    var juicePos = video.currentTime / video.duration;
    juice.style.width = juicePos * 100 + "%";
    if(video.ended){
        btn.className = "play";
    }
});