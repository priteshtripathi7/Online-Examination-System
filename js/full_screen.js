$(document).ready(function(){

    // This adds a event listener of click on full screen mode
    $(document).on("keydown", keydown);
    $(document).on("keyup", keyup);
    $(document).on("keydown", disableF5);
    

    $('#full-scr').click(function(){
        $('#subject_questions').css('display', 'block');
        $('#rules').css('display', 'none');
        document.documentElement.requestFullscreen();
        
        $(document).keyup(function(e) {
            if (e.key === "Escape") { 
                console.log("Hello");
               alert('You are exiting full screen');
            }
        });
        
        let test_time = $('#exam-timer').text();
        
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

function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };


document.addEventListener("keydown", e => {
    if(e.key == "F11") e.preventDefault();
});


