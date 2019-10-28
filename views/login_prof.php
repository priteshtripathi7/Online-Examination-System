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
        <title>Professor's Login</title>
    </head>
    <body>
        <div id="login-stu-full-size">

            <div class="container" style="max-width: 45rem !important">
                <div class="row text-center" id="error-div" style="max-width: 45rem;">
                    <!-- Error Alert -->
                    <?php
                        require "./../php/functions_prof.php";
                        validate_professor_login();
                    ?>
                </div>
            </div>

            <div class="card container"  style="max-width: 45rem; background-color: rgba(0,0,0,0.7) !important; color:white; top: 25vh;">
                <h5 class="card-header display-4">Professor's Login</h5>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                        <div class="form-group row">
                            <label for="professor_username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="professor_username" class="form-control" id="professor_username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="professor_password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="professor_password" id="professor_password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 ">
                            <input type="submit" class="btn btn-primary btn-lg" value="Login" name="login" id="login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>