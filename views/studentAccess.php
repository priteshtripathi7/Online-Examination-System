<?php
    require './../php/functions_studAccess.php';
    beginTest();
    
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
        
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <i class="fa fa-user-circle" aria-hidden="true" style="color:white; padding-left:2%; font-size: 20px;"></i>
            <span style="color:white; padding-left:2%;">
                
                <?php
                    $user = $_COOKIE["student_loggedIn"];
                    echo $user;
                ?>
            </span>

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="padding-left:65vw;">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Available Tests<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./studentResults.php">Previous Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary" href="./../logout-system/stud_logout.php" style="color:white;">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="jumbotron">
            <h1 class="display-2">Available Tests</h1>
        </div>

        <div class="container">
            <div class="row">
                
                <?php

                    outputAvailableTests();

                ?>

            </div>
        </div>
    </body>
</html>