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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- 
            FONT AWESOME CDN
        -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--
            JQUERY CDN
        -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
                    <input type="submit" name="submit" id="submit" value="Finish Test" class="btn btn-primary">
                </form>
            </div>
        </div>

        <div id="submit_status" style="display:none;" >
            <div class="jumbotron">
                <div class="text-center">
                    <h1 class="display-3">Submitting...</h1>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <script src="./../js/full_screen.js"></script>
    </body>
</html>