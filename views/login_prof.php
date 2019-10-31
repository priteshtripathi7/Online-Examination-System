<?php
    if(isset($_COOKIE["professor_loggedIn"])){
        header("Location: http://localhost:8080/online-examination-system/views/professorAccess.php");
    }
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