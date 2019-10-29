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
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Test Results</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Make Test<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="jumbotron">
            <h1 class="display-2">Make Test</h1>
        </div>

        <div class="container">
            <form method="POST" action="">

                <div class="form-group row">
                    <label for="test_topic" class="col-sm-2 col-form-label">Topic of test:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="test_topic" id="test_topic" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number_of_questions" class="col-sm-2 col-form-label">Number of Questions:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="number_of_questions" id="number_of_questions" value="0" disabled>
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

        <script>
            document.getElementById('number_of_questions').value = '0';   
        </script>
        <script src="./../js/app.js"></script>
    </body>
</html>