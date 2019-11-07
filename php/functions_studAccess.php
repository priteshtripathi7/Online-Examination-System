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
                    <img src=\"./../img/".$subject.".jpg\" class=\"card-img-top\" alt=\"".$subject."\" style=\"height:30vh;\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">".$subject."</h5>
                        <p class=\"card-text\">
                            <p>TOPIC  : <span style=\"font-weight:bold;\">".$topic."</span></p>
                            <p>NUMBER OF QUESTIONS  : <span style=\"font-weight:bold;\">".$number_of_ques."</span></p>
                            <p>TIME ALLOTED  : <span style=\"font-weight:bold;\">".$time_alloted."</span> minutes.</p>
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
            $row_count = mysqli_num_rows($result);
            if($row_count == 0){
                $mssg = '
                    <div class="alert alert-danger container" role="alert" style>
                        There are no test to show.
                    </div>
                ';
                echo $mssg;
            }
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
                        <img src=\"./../img/".$subject.".jpg\" class=\"card-img-top\" alt=\"".$subject."\" style=\"height:30vh;\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">".$subject."</h5>
                            <p class=\"card-text\">
                                <p>TOPIC  : <span style=\"font-weight:bold;\">".$topic."</span></p>
                                <p>MARKS OBTAINED  : <span style=\"font-weight:bold;\">".$marks_obtained." out of ".$number_of_ques."</span></p>
                            </p>
                            <form method=\"GET\" action=\"./test_responses.php\">
                            <input type=\"submit\" id=\"".$test_id."\" name=\"".$test_id."\" value=\"Check answers\" class=\"btn btn-primary\" >
                            </form>
                        </div>
                        </div>
                    ";

                    echo $HTML;
                }
                
            }
        }
    }

    // FUNCTION 4 : This function outputs test details

    function attemptedTestDetails(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con == false){
                die("Error: Could not connect ". mysqli_connect_errno());
            }else{
                foreach($_GET as $key => $value){
                    $test_id  =  $key;

                    $query = "
                        SELECT test_subject, test_topic, test_num_of_ques, time_alloted
                        FROM test_details
                        WHERE test_id = '$test_id'
                    ";

                    $result = mysqli_query($con, $query);
                    if(!$result){
                        die("Error: Could not connect ".mysqli_connect_errno());
                    }else{
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);

                        $subject            =        $row[0];
                        $topic              =        $row[1];
                        $number_of_ques     =        $row[2];
                        $time_alloted       =        $row[3];

                        $HTML = '
                        <h1 class="display-4">'.$subject.'</h1>
                        <h1 class="display-4" style="font-size: 35px;">'.$topic.'</h1>
                        <h1 class="display-4" style="font-size: 35px;">Maximum marks: '.$number_of_ques.'</h1>
                        <h1 class="display-4" style="font-size: 35px;">Time alloted: '.$time_alloted.' minutes</h1>
                        ';
                        echo $HTML;
                    }
                }
            }
        }
    }

    // FUNCTION 5 : This function outputs all the test responses

    function outputTestAnswers(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con == false){
                die("Error: Could not connect: ".mysqli_connect_errno());
            }else{
                foreach($_GET as $key => $value){
                    $test_id = $key;
                    $query = "
                        SELECT * 
                        FROM question_details
                        WHERE test_id = '$test_id';
                    ";

                    $result = mysqli_query($con, $query);

                    if(!$result){
                        die("Error : Could Not Connect ");
                    }else{
                        $student  = $_COOKIE["student_loggedIn"];
                        $query = "
                            SELECT student_response
                            FROM responses
                            WHERE test_id = '$test_id' AND student_id = '$student'
                        ";
                        $result2 = mysqli_query($con, $query);
                        $row2  = mysqli_fetch_array($result2, MYSQLI_NUM);
                        $response = $row2[0];

                        while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                            $question_number        =       $row[1];
                            $question               =       $row[2];
                            $correct_answer         =       $row[7];
                            $options = '';
                            $attempted_answer       =       $response[$question_number - 1];
                            if($correct_answer == $attempted_answer){
                                for($i = 3; $i < 7; $i++){
                                    if($row[$i] != "NULL"){
                                        $color = 'bg-white';
                                        if($i-2 == $correct_answer){
                                            $color = 'bg-success text-white';
                                        }
                                        $add = '
                                                <div class="col-sm-6" >
                                                    <input type="text" class="form-control '.$color.' " id="'.$question_number.$i.'" value="'.($i-2).')  '.$row[$i].'"  style="border:none;" disabled>
                                                </div>
                                        ';
                                        $options .= $add;
                                    }
                                }
                            }else{
                                for($i = 3; $i < 7; $i++){
                                    if($row[$i] != "NULL"){
                                        $color = 'bg-white';
                                        if($i-2 == $correct_answer){
                                            $color = 'bg-success text-white';
                                        }
                                        if($i-2 == $attempted_answer){
                                            $color = 'bg-danger text-white';
                                        }
                                        $add = '
                                                <div class="col-sm-6" >
                                                    <input type="text" class="form-control '.$color.' " id="'.$question_number.$i.'" value="'.($i-2).')  '.$row[$i].'" style="border:none;"  disabled>
                                                </div>
                                        ';
                                        $options .= $add;
                                    }
                                }
                            }
                            

                            
                            $HTML = '
                                    <div class="form-group border border-dark rounded" style="padding:2%; border">
                                        <label for="'.$question_number.'" style="font-size:20px;">'.$question_number.'. '.$question.'</label>
                                        <div class="row " style="font-size:20px">
                                        '.$options.'
                                        </div>
                                    </div>
                            ';
                            echo $HTML;
                        }
                    }
                }
            }
        }

    }

    // ***************   STUDENT ACCESS PAGE FUNCTIONS ENDS ********************//

?>
