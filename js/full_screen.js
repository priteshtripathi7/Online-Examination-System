$(document).ready(function(){

    // This adds a event listener of click on full screen mode
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
    

    $('#full-scr').click(function(){
        $('#subject_questions').css('display', 'block');
        $('#rules').css('display', 'none');
        document.documentElement.requestFullscreen();
        
        let test_time = $('#exam-timer').text();
        //let test_time = '0:10';
        
        let timer_decrement = setInterval( function() {

            let timer = test_time.split(':');
            let minutes = parseInt(timer[0], 10);
            let seconds = parseInt(timer[1], 10);

            --seconds;

            minutes = (seconds < 0) ? --minutes : minutes;

            if (minutes < 0) {
                clearInterval(timer_decrement);
                $('#subject_questions').css('display', 'none');
                $('#submit_status').css('display', 'block');
                $('#submit').click();
            }
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;


            $('#exam-timer').html(minutes + ':' + seconds);
            test_time = minutes + ':' + seconds;

        }, 1000);
    });


    $('#submit').click(function(){
        $('#subject_questions').css('display', 'none');
        $('#submit_status').css('display', 'block');
    });

    $('#returntotest').click(function(){
        document.documentElement.requestFullscreen();
    })
});

function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};

function keyup(e){
    // Key up Ctrl
    if ((e.which || e.keyCode) == 17) 
        ctrlKeyDown = false;
};

document.addEventListener("keydown", e => {
    if(e.key == "F11") e.preventDefault();
});

document.addEventListener("fullscreenchange", onFullScreenChange, false);
document.addEventListener("webkitfullscreenchange", onFullScreenChange, false);
document.addEventListener("mozfullscreenchange", onFullScreenChange, false);

function onFullScreenChange() {
    if ((!window.screenTop && !window.screenY)) {
        let scr1 = $('#subject_questions').css('display');
        let scr2 = $('#rules').css('display');

        if(scr1 == 'block' && scr2 == 'none'){
            $('#confirmation').click();
        }
    }
}