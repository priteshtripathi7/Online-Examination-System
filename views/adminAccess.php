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
        <div id="admin-portal-full-size">
            <div class="container" style="max-width: 45rem !important">
                <div class="row text-center" id="error-div" style="max-width: 45rem;">
                    <!-- Error Alert -->
                    <?php
                        require "./../php/functions.php";
                        validate_add_user();
                    ?>
                </div>
            </div>

            <div class="card container"  style="max-width: 45rem; background-color: rgba(0,0,0,0.7) !important; color:white; top: 5vh;">
                <h5 class="card-header display-4">Add User</h5>
                <div class="card-body">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">

                        <div class="form-group">
                            <label for="occupation">Type of User</label>
                            <select class="form-control" id="occupation" name="occupation">
                            <option>Student</option>
                            <option>Professor</option>
                            </select>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" name="firstname" placeholder="First name">
                            </div>
                            <div class="col-sm-12 col-md-6">
                            <input type="text" class="form-control" name="lastname" placeholder="Last name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter User's Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter User's Username" required>
                            </div>
                        </div>

                        <fieldset class="form-group">
                            <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">User's Courses</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="usercourses[]" id="course1" value="Computer Networks">
                                <label class="form-check-label" for="course1">
                                    Computer Networks
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="usercourses[]" id="course2" value="Design and Analysis of Algorithms">
                                <label class="form-check-label" for="course2">
                                    Design and Analysis of Algorithms
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="usercourses[]" id="course3" value="Artificial Intelligence and Machine Learning">
                                <label class="form-check-label" for="course3">
                                    Artificial Intelligence and Machine Learning
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="usercourses[]" id="course4" value="Microprocessor and Interfacing Technology">
                                <label class="form-check-label" for="course4">
                                    Microprocessor and Interfacing Technology
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="usercourses[]" id="course5" value="Software Tools 3">
                                <label class="form-check-label" for="course5">
                                    Software Tools 3
                                </label>
                                </div>
                            </div>
                            </div>
                        </fieldset>

                        <div class="form-group row">
                            <div class="col-sm-6 ">
                                <input type="submit" class="btn btn-primary btn-lg" value="Add User" name="adduser" id="adduser">
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-primary btn-lg float-right" href="./../logout-system/admin_logout.php" style="color:white;">Logout</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>