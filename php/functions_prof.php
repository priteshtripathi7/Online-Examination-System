<?php
    // ***************   PROFESSOR LOGIN PAGE VALIDATION ********************//

    // FUNCTION 1 : This function checks whether the username and password are correct or not.

    function validate_professor_login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // ERRORS LIST EMPTY AT BEGINNING
            $errors = [];

            // CONNECT THE DATABASE
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con === false){

                // IF ERROR KILL THE CONNECTION AND APPLICATION
                die("ERROR: Could not connect. " . mysqli_connect_error());

            }else{

                // ACCESS POST ELEMENTS
                $username    = $_POST["professor_username"];
                $password    = $_POST["professor_password"];

                // FORM QUERY TO CHECK IF USERNAME IS EXIST
                $query =    "SELECT password FROM professor 
                            WHERE professor_username= '$username'";
                $result = mysqli_query($con, $query);

                if(!$result){

                    // IF ERROR IN QUERY KILL CONNECTION
                    die("ERROR: Could not connect.");

                }else{

                    // FILTER THE DATA
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $row_cnt = mysqli_num_rows($result);

                    // IF ROW COUNT = 1 THEN CHECK IF PASSWORD MATCHES
                    if($row_cnt == 1){

                        if($row["password"] == md5($password)){

                            // IF PASSWORD MATCHES THEN MOVE TO REQUIRD PAGE
                            header("Location: http://localhost:8080/online-examination-system/views/professorAccess.php");

                        }else{

                            // ELSE APPEND ERROR LIST
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

                        // IF PASSWORD DOESN'T MATCH APPEND ERRORS LIST
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

                // ECHO EACH ERRORS
                foreach($errors as $error){
                    echo $error;
                }
                
            }    
        }
    }
    
    // ***************   PROFESSOR LOGIN PAGE VALIDATION END    ********************//

?>