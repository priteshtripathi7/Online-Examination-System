<?php
    require './../php/functions_profAccess.php';
    checkDelete();
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
        
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <i class="fa fa-user-circle" aria-hidden="true" style="color:white; padding-left:2%; font-size: 20px;"></i>
            <span style="color:white; padding-left:2%;">
                
                <?php
                    $user = $_COOKIE["professor_loggedIn"];
                    echo $user;
                ?>
            </span>

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="padding-left:65vw;">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" href="./professorAccess.php">Test Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./makeTest.php">Make Test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="./../logout-system/prof_logout.php" style="color:white;">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="jumbotron">
            <h1 class="display-3">Responses</h1>
            <?php
                testDetails();
            ?>
        </div>

        <div class="container">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Registration No.</th>
                        <th scope="col">Marks Obtained</th>
                        <th scope="col">Clear</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        outputResponses();
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>