<?php
    require './../PHPMailerAutoload.php';
    require './../php/config.php';
    // ***************   ADMIN LOGIN PAGE VALIDATION ********************//

    // FUNCTION 1 : This function checks whether the username and password are correct or not.

    function validate_admin_login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $errors = [];
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }else{
                $username    = $_POST["prof-username"];
                $password    = $_POST["prof-pwd"];
                $query =    "SELECT password FROM admindetails 
                            WHERE username= '$username'";
                $result = mysqli_query($con, $query);
                if(!$result){
                    die("ERROR: Could not connect.");
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $row_cnt = mysqli_num_rows($result);
                    if($row_cnt == 1){
                        if($row["password"] == $password){

                            setcookie("admin_loggedIn", $username, time() + (86400), '/');
                            setcookie("professor_loggedIn", "", time() - 3600,"/");
                            setcookie("student_loggedIn", "", time() - 3600,"/");

                            header("Location: http://localhost:8080/online-examination-system/views/adminAccess.php");
                        }else{
                            $mssg = "
                                <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\" style=\"display:block !important; margin-left:auto !important; margin-right:auto !important; top:3vh !important;\">
                                    <strong>Error!</strong> The credentials which you have entered, are not correct.
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
                                </div>
                            ";
                            $errors[] = $mssg;
                        }
                    }else{
                        $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> The credentials which you have entered, are not correct.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        ";
                        $errors[] = $mssg;
                    }
                }
                foreach($errors as $error){
                    echo $error;
                }
            }    
        }
    }
    
    // ***************   ADMIN LOGIN PAGE VALIDATION END    ********************//


    // ***************   ADMIN PORTAL ADD USER VALIDATION END    ********************//

    // FUNCTION 1 : This function validates the data of the add user page.
    function validate_add_user() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $errors = [];
            $usercourses = [];
            $occupation  =      $_POST["occupation"];
            $firstname   =      $_POST["firstname"];
            $lastname    =      $_POST["lastname"];
            $username    =      $_POST["username"];
            $email       =      $_POST["email"];
            if(isset($_POST["usercourses"])){
                for($i = 0; $i < count($_POST["usercourses"]); $i++){
                    $usercourses[$i] = $_POST["usercourses"][$i];
                }
            }
            
            // VALIDATION FOR FIRSTNAME
            if(strlen($firstname) < 3){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> First Name should be atleast 3 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            if(strlen($firstname) > 25){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> First Name can be atmost 25 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            for($i = 0; $i < strlen($firstname); $i++){
                if(($firstname[$i] >= 'A' && $firstname[$i] <= 'Z') || ($firstname[$i] >= 'a' && $firstname[$i] <= 'z')){
                    continue;
                }else{
                    $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> First Name should only contain letters.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                    $errors[] = $mssg;
                    break;
                }
            }

            // VALIDATION FOR LASTNAME
            if(strlen($lastname) < 3){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> Last Name should be atleast 3 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            if(strlen($lastname) > 25){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> Last Name can be atmost 25 characters long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }
            for($i = 0; $i < strlen($lastname); $i++){
                if(($lastname[$i] >= 'A' && $lastname[$i] <= 'Z') || ($lastname[$i] >= 'a' && $lastname[$i] <= 'z')){
                    continue;
                }else{
                    $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> Last Name should only contain letters.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                    $errors[] = $mssg;
                    break;
                }
            }

            // VALIDATION FOR USERNAME
            if(strlen($username) != 8){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> USERNAME must be exact 8 character long.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }

            if(count($usercourses) == 0){
                $mssg = "
                    <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                        <strong>Error!</strong> One course must be selected.
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                ";
                $errors[] = $mssg;
            }

            if(count($errors) == 0){
                $db_errors = add_user_to_db($occupation,$firstname,$lastname,$username,$usercourses, $email);
                if(count($db_errors) == 0){
                    $mssg = "
                        <script>
                            alert('The user is successfully added and a mail has been sent to him.');
                        </script>
                        
                    ";
                    echo $mssg;                    
                }else{
                    foreach($db_errors as $error){
                        echo $error;
                    }
                }
            }else{
                foreach($errors as $error){
                    echo $error;
                }
            }    
        }
    }
    
    // FUNCTION 2 : This function add user to the database and also checks thats the username and email are unique.

    function add_user_to_db($occupation,$firstname,$lastname,$username,$usercourses, $email) {
        $errors = [];
        $occupation = strtolower($occupation);
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }else{
            $query =    "SELECT * FROM $occupation 
                            WHERE ".$occupation."_username= '$username'";
            $result = mysqli_query($con, $query);
            if(!$result){
                die("ERROR: Could not connect.");
            }else{
                $row_cnt = mysqli_num_rows($result);
                if($row_cnt == 1){
                    $mssg = "
                        <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                            <strong>Error!</strong> Sorry the username already taken.
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                    ";
                    $errors[] = $mssg;
                }
                $query =    "SELECT * FROM $occupation 
                                WHERE email= '$email'";
                $result = mysqli_query($con, $query);
                if(!$result){
                    die("ERROR: Could not connect.");
                }else{
                    $row_cnt = mysqli_num_rows($result);
                    if($row_cnt == 1){
                        $mssg = "
                            <div class=\"alert alert-danger alert-dismissible fade show \" role=\"alert\"  style=\"display:block !important; margin-left:auto !important; margin-right:auto !important;top:3vh !important;\">
                                <strong>Error!</strong> Sorry the email already exists.
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                            </div>
                        ";
                        $errors[] = $mssg;
                    }
                    if(count($errors) != 0){
                        return $errors;
                    }else {
                        $count = 0;
                        $pwd = md5($username);
                        
                        $query =    "INSERT INTO $occupation(".$occupation."_username, firstname, lastname, password, email)
                                        VALUES ('$username', '$firstname', '$lastname', '$pwd', '$email')";
                        $result = mysqli_query($con, $query);
                        if(!$result){
                            die("ERROR: Could not connect.");
                        }else{
                            $count++;
                        }
                        for($i = 0; $i < count($usercourses); $i++){
                            $cur_course = $usercourses[$i];
                            $query =    "INSERT INTO courses_$occupation(course_id, ".$occupation."_id)
                                        VALUES ('$cur_course', '$username')";
                            $result = mysqli_query($con, $query);
                            if(!$result){
                                die("ERROR: Could not connect.");
                            }else{
                                $count++;
                            }
                        }
                        $mail = new PHPMailer;
                        //$mail->SMTPDebug = 4;                                 // Enable verbose debug output
                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = "smtp.gmail.com";                       // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = EMAIL;                              // SMTP username
                        $mail->Password = PASSWORD;                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to
                        $mail->setFrom(EMAIL, 'Online-Examination-Admin');
                        $mail->addAddress($email);     // Add a recipient
                        $mail->addReplyTo(EMAIL);
                        
                        $mssg = '
                                    <!DOCTYPE html>
                                    <html>
                                        <head>
                                            
                                            <title>Result</title>
                                        </head>
                                        <body>
                                            <div class="jumbotron" style="background-color: palegoldenrod; padding:2em;">
                                                <h1 class="display-3">Registration Details</h1>
                                                
                                                <div class="conatiner">
                                                    <div class="alert alert-info">
                                                    <h1>This is to inform that you have been registered.....</h1>
                                                    by the ADMIN of the Online-Examination-System.<br>
                                                    <p>Your Username is <b>'.$username.'</b> and your Password is <b>'.$username.'. Use the above credentials to login into your account.</b></p>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </body>
                                    </html>
                            ';

                        // $mail->addCC('cc@example.com');
                        // $mail->addBCC('bcc@example.com');

                        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = 'You have been registed ... !!!';
                        $mail->Body    = $mssg;
                        $mail->AltBody = "This is to inform you that you have been registered to the institute online system
                        by the Admin. Your username is ".$username." and password is ".$username." .";

                        $mail->send();
                        return $errors;
                    }
                }
            }
        }
    }
    
    // ***************   END ADMIN PORTAL ADD USER VALIDATION END    ********************//

?>