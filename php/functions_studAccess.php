<?php

    // ***************   STUDENT ACCESS PAGE FUNCTIONS ********************//

    // FUNCTION 1 : This function prints all the tests available to a student.

    function outputAvailableTests() {
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con == false){
            die("Error: Could not connect ". mysqli_connect_errno());
        }else{
            $student = $_COOKIE["student_loggedIn"];
            
            $query = "
                SELECT * FROM courses_student 
                INNER JOIN test_details 
                ON test_details.test_subject = courses_student.course_id 
                WHERE courses_student.student_id = '$student' AND
                test_details.test_id NOT IN (
                                                SELECT test_id 
                                                FROM responses
                                                WHERE student_id = '$student'
                                            )
            "; 

            $result = mysqli_query($con, $query);
            
            while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                
                $subject            =      $row[0];
                $test_id            =      $row[2];
                $topic              =      $row[4];
                $number_of_ques     =      $row[5];
                $time_alloted       =      $row[8];



                $HTML = "
                    <div class=\"card col-sm-6 col-md-4\" style=\"width: 8rem; padding: 1rem;\">
                    <img src=\"./../img/".$subject.".jpg\" class=\"card-img-top\" alt=\"".$subject."\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">".$subject."</h5>
                        <p class=\"card-text\">
                            <p>TOPIC  : <span style=\"font-weight:bold;\">".$topic."</span></p>
                            <p>NUMBER OF QUESTIONS  : <span style=\"font-weight:bold;\">".$number_of_ques."</span></p>
                            <p>TIME ALLOTED  : <span style=\"font-weight:bold;\">".$time_alloted."</span></p>
                        </p>
                        <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#".$test_id."\">
                            Attempt
                        </button>
                    </div>
                    </div>

                    

                    <!-- Modal -->
                    <div class=\"modal fade\" id=\"".$test_id."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel_".$test_id."\" aria-hidden=\"true\">
                    <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
                        <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\" id=\"exampleModalLabel_".$test_id."\">Attempt test</h5>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        <div class=\"modal-body\">
                            <form method=\"POST\" action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\">
                                <div class=\"row\">
                                    <div class=\"col\" style=\"display:none;\">
                                        <input type=\"text\" name=\"test_id\" class=\"form-control\" placeholder=\"Enter Password\" value=\"".$test_id."\">
                                    </div>
                                    <div class=\"col\">
                                        <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Enter Password\" required>
                                    </div>
                                </div>
                                <div class=\"modal-footer\">
                                    <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
                                    <input type=\"submit\"  class=\"btn btn-primary\" value=\"Attempt\">
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                ";
                
                echo $HTML;
            }
        }
    }

    // FUNCTION 2 : This function validates the settings and starts the test

    function beginTest(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con == false){
                die("Error: Could Not Connect". mysqli_connect_errno());
            }else{
                $test_id        =       $_POST["test_id"];
                $password       =       $_POST["password"];

                $query = "
                    SELECT test_password 
                    FROM test_details
                    WHERE test_id = '$test_id'
                ";
                $result = mysqli_query($con, $query);

                if(!$result){
                    die("Error: Could Not Connect.");
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    if($row[0] == md5($password)){
                        setcookie("test_id", $test_id, time() + (86400 * 30), '/');
                        header("Location: http://localhost:8080/online-examination-system/views/test_page.php");
                    }else{
                        $script = "
                            <script>
                                alert('The password entered by you is incorrect!');
                            </script>
                        ";
                        echo $script;
                    }
                }
            }
        }
    }

    // Function 3: This function outputs the attempted tests.

    function outputAttemptedTests() {
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con == false){
            die("Error: Could not connect ". mysqli_connect_errno());
        }else{
            $student = $_COOKIE["student_loggedIn"];
            
            $query = "
                SELECT test_id , marks_obtained
                FROM responses 
                WHERE student_id = '$student'
            "; 

            $result = mysqli_query($con, $query);
            
            while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                
                $test_id                =           $row[0];
                $marks_obtained         =           $row[1];

                $query2 = "
                    SELECT test_subject, test_topic, test_num_of_ques
                    FROM test_details
                    WHERE test_id = '$test_id'
                ";

                $result2 = mysqli_query($con, $query2);

                if(!$result){
                    die("Error: Could not connect.");
                }else{
                    $row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
                    $subject            =       $row2[0];
                    $topic              =       $row2[1];
                    $number_of_ques     =       $row2[2];

                    $HTML = "
                        <div class=\"card col-sm-6 col-md-4\" style=\"width: 8rem; padding: 1rem;\">
                        <img src=\"./../img/".$subject.".jpg\" class=\"card-img-top\" alt=\"".$subject."\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">".$subject."</h5>
                            <p class=\"card-text\">
                                <p>TOPIC  : <span style=\"font-weight:bold;\">".$topic."</span></p>
                                <p>MARKS OBTAINED  : <span style=\"font-weight:bold;\">".$marks_obtained." out of ".$number_of_ques."</span></p>
                            </p>
                        </div>
                        </div>
                    ";

                    echo $HTML;
                }
                
            }
        }
    }

    // ***************   STUDENT ACCESS PAGE FUNCTIONS ENDS ********************//

?>
