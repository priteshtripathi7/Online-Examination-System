$(document).ready(function(){

    // This adds a event listener of click on full screen mode
    $('#full-scr').click(function(){
        $('#subject_questions').css('display', 'block');
        $('#rules').css('display', 'none');
        document.documentElement.requestFullscreen();


        // let test_time = $('#exam-timer').text();
        let test_time = '0:30';
        
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

    // This helps to uncheck checked radio option
    $('input[type=radio]').click(function(){
        if (this.previous) {
            this.checked = false;
        }
        this.previous = this.checked;
    });
});
