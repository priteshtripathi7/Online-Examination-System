<?php
    require './../php/functions_makeTest.php';
    saveTestToDB();
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
    <body style="font-family: 'Raleway', sans-serif;">
        
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" style="background-color:#161616 !important; border-bottom: 10px solid #399ca4; padding-bottom: 0; ">
            <i class="fa fa-user-circle" aria-hidden="true" style="color:white; padding-left:4%; font-size: 20px;"></i>
            <span style="color:white; padding-left:2%;">
                
                <?php
                    $user = $_COOKIE["professor_loggedIn"];
                    echo $user;
                ?>
            </span>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse float-right" id="navbarTogglerDemo03" style="padding-left:65vw;">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="./professorAccess.php">Test Results</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="display: inline-block; background-color:#399ca4;">Make Test<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn" href="./../logout-system/prof_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="jumbotron">
            <h1 class="display-2">Make Test</h1>
        </div>

        <div class="container">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" >

                <div class="form-group row">
                    <label for="test_subject" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="test_subject" name="test_subject">

                            <?php
                                outputSubject();
                            ?>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="test_topic" class="col-sm-2 col-form-label">Topic of test:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="test_topic" id="test_topic" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="test_time" class="col-sm-2 col-form-label">Time alloted in minutes:</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" max="60" class="form-control" name="test_time" id="test_time" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number_of_questions" class="col-sm-2 col-form-label">Number of Questions:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="number_of_questions" id="number_of_questions" value="0" disabled>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="test_password" class="col-sm-2 col-form-label">Test Access Password:</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="test_password" id="test_password" required>
                    </div>
                </div>

                <div id="questions_list">
                    <!--
                        QUESTION LIST GOES HERE....
                    -->
                </div>
                <br><br>
                
                <div class="text-center" style="padding-bottom: 15px;">
                    <button type="button" class="btn btn-success col-sm-2" onclick="addQuestion()">
                        <i class="fa fa-plus-circle col-sm-0.5" aria-hidden="true"></i>
                        <span class="col-sm-1.5">ADD Question</span>
                    </button>
                </div>
                
                <div class="text-center" style="padding-bottom: 15px;">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit" >
                </div>
                
            </form>
        </div>
        <br>
        <br>
        <script>
            document.getElementById('number_of_questions').value = '0';
            // window.onbeforeunload = function(){
            //     return 'Are you sure you want to leave?';
            // };
            
        </script>
        <script src="./../js/app.js"></script>
        <script type="text/javascript">
            window.onbeforeunload = function() {
                return "Dude, are you sure you want to leave? Think of the kittens!";
            }
        </script>
    </body>
</html>


