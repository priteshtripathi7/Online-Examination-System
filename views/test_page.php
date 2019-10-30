<?php

    require './../php/function_testPage.php';
    submitResponse();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Pritesh Tripathi">

        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- 
            FONT AWESOME CDN
        -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--
            JQUERY CDN
        -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Online Examination System</title>
    </head>
    <body>
        
        <?php
            outputRules();
        ?>

        <div id="subject_questions" class="container" style="padding-top:2%; display:none;">
            <?php
                outputTestDetails();
            ?>
            <br>
            <div class="accordion" id="test_questions">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])  ?>">
                    <?php
                        outputQuestions();
                    ?>
                    <br><br>
                    <input type="submit" name="submit" value="Finish Test" class="btn btn-primary">
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('#full-scr').click(function(){
                    $('#subject_questions').css('display', 'block');
                    $('#rules').css('display', 'none');
                    document.documentElement.requestFullscreen();
                });
            });
            $('input[type=radio]').click(function(){
                if (this.previous) {
                    this.checked = false;
                }
                this.previous = this.checked;
            });
        </script>
    </body>
</html>