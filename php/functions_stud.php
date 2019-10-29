<?php
    // ***************   STUDENT LOGIN PAGE VALIDATION ********************//

    // FUNCTION 1 : This function checks whether the username and password are correct or not.

    function validate_student_login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $errors = [];
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }else{
                $username    = $_POST["student_username"];
                $password    = $_POST["student_password"];
                $query =    "SELECT password FROM student 
                            WHERE student_username= '$username'";
                $result = mysqli_query($con, $query);
                if(!$result){
                    die("ERROR: Could not connect.");
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $row_cnt = mysqli_num_rows($result);
                    if($row_cnt == 1){
                        if($row["password"] == md5($password)){

                            setcookie("student_loggedIn", $username, time() + (86400 * 30), '/');
                            setcookie("professor_loggedIn", "", time() - 3600,"/");
                            setcookie("admin_loggedIn", "", time() - 3600,"/");

                            header("Location: http://localhost:8080/online-examination-system/views/studentAccess.php");
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
    
    // ***************   STUDENT LOGIN PAGE VALIDATION END    ********************//

?>