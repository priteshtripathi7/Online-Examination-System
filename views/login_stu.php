<?php
    if(isset($_COOKIE["student_loggedIn"])){
        header("Location: http://localhost:8080/online-examination-system/views/studentAccess.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Pritesh Tripathi">
        <link rel="stylesheet" href="./../css/index.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <title>Student's Login</title>
    </head>
    <body style="font-family: 'Raleway', sans-serif;">

        

        <div id="login-stu-full-size">
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" style="background-color:#161616 !important; border-bottom: 10px solid #399ca4; padding-bottom: 0; ">
                
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="padding-left:70vw;">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link" href="./index.html">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="./admin.php">Admin Login</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#" style="display: inline-block; background-color:#399ca4;">Student Login<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="./login_prof.php">Professor Login</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container" style="max-width: 45rem !important">
                <div class="row text-center" id="error-div" style="max-width: 45rem;">
                    <!-- Error Alert -->
                    <?php
                        require "./../php/functions_stud.php";
                        validate_student_login();
                    ?>
                </div>
            </div>

            <div class="card container"  style="max-width: 45rem; background-color: rgba(0,0,0,0.7) !important; color:white; top: 25vh;">
                <h5 class="card-header display-4" style="font-family: 'Montserrat', sans-serif;">Student's Login</h5>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                        <div class="form-group row">
                            <label for="student_username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="student_username" id="student_username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="student_password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="student_password" id="student_password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ">
                            <input type="submit" class="btn btn-info btn-lg" value="Login" name="login" id="login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>