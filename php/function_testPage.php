<?php
    
    // ***************   TEST PAGE FUNCTIONS ********************//

    // Function 1: This function outputs the rules of the test.
    
    function outputRules(){
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con == false){
            die("Error: Could Not Connect ". mysqli_connect_errno());
        }else{
            $test_id = $_COOKIE["test_id"];

            $query = "
                SELECT * 
                FROM test_details
                WHERE test_id = '$test_id'
            ";

            $result = mysqli_query($con, $query);
            if(!$result){
                die("Error: Could Not Connect");
            }else{
                $row  = mysqli_fetch_array($result, MYSQLI_NUM);
     
                $num_of_questions   =       $row[3];
                $time_alloted       =       $row[6];

                $HTML = '
                    <div class="card container" id="rules"  style="max-width: 45rem;; top: 25vh;">
                    <h5 class="card-header h5">Test\'s Rule</h5>
                    <div class="card-body">
                        <ul>
                            <li>1.This test consists of '.$num_of_questions.' questions.</li>
                            <li>2.The time alloted for this test is '.$time_alloted.' minutes.</li>
                            <li>3.On clicking the below button the browser will go full screen.</li>
                            <li>4.The moment you exit full screen or submit the test its over.</li>
                            <br>
                            <div >
                                <button type="button" id="full-scr" class="btn btn-primary">Go full screen</button>
                            </div>
                        </ul>
                    </div>
                    </div>
                ';
                
                echo $HTML;
            }
        }
    }


    // Function 2: This function outputs the test details on the page.

    function outputTestDetails() {
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con == false){
            die("Error: Could Not Connect ". mysqli_connect_errno());
        }else{
            $test_id = $_COOKIE["test_id"];

            $query = "
                SELECT * 
                FROM test_details
                WHERE test_id = '$test_id'
            ";

            $result = mysqli_query($con, $query);
            if(!$result){
                die("Error: Could Not Connect");
            }else{
                $row  = mysqli_fetch_array($result, MYSQLI_NUM);
                
                $test_subject       =       $row[1];
                $test_topic         =       $row[2];      
                $num_of_questions   =       $row[3];
                $time_alloted       =       $row[6];

                $HTML = '
                <div id="test_header" class="sticky-top container text-center bg-dark" style="color:white; padding:1% 0%;">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>'.$test_subject.' quiz</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            Questions:<h5> '.$num_of_questions.' </h5>
                        </div>
                        <div class="col-md-6">
                            Topic:<h5> '.$test_topic.' </h5>
                        </div>
                        <div class="col-md-3">
                            Time:<h5> '.$time_alloted.' </h5>
                        </div>
                    </div>
                </div>
                ';

                echo $HTML;
            }
        }
    }

    // Function 3: This function fetches and outputs the questions.

    function outputQuestions(){
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con == false){
            die("Error: Could Not Connect. ".mysqli_connect_errno());
        }else{
            $test_id = $_COOKIE["test_id"];

            $query = "
                SELECT * 
                FROM question_details
                WHERE test_id = '$test_id';
            ";

            $result = mysqli_query($con, $query);

            if(!$result){
                die("Error : Could Not Connect ");
            }else{

                while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                    $question_number        =       $row[1];
                    $question               =       $row[2];
                    $option_1               =       $row[3];
                    $option_2               =       $row[4];
                    $option_3               =       $row[5];
                    $option_4               =       $row[6];

                    $options = '';

                    for($i = 3; $i <= 6; $i++){
                        if($row[$i] != "NULL"){
                            $val = $i - 2;
                            $temp = '
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_'.$question_number.'" id="'.$question_number.'" value="'.$val.'">
                                <label class="form-check-label" for="'.$question_number.'">
                                    '.$row[$i].'
                                </label>
                            </div>
                            ';
                            $options .= $temp;
                        }
                    }
                    
                    $HTML = '
                        <div class="card">
                            <div class="card-header" id="heading'.$question_number.'">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$question_number.'" aria-expanded="false" aria-controls="collapse'.$question_number.'">
                                        '.$question_number.'. '.$question.'
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse'.$question_number.'" class="collapse" aria-labelledby="heading'.$question_number.'" data-parent="#test_questions">
                                <div class="card-body">
                                    
                                    '.$options.'

                                </div>
                            </div>
                        </div>
                
                    ';
                    echo $HTML;
                }
            }
        }
    }

    // Function 4: This function validates the response of the student

    function submitResponse(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con == false){
                echo "Hello1";
                die("Error: Could not connect. ". mysqli_connect_errno());
            }else{
                $test_id = $_COOKIE["test_id"];
                $student = $_COOKIE["student_loggedIn"];

                $query = "  SELECT test_num_of_ques, test_answers
                            FROM test_details
                            WHERE test_id = '$test_id';
                ";

                $result = mysqli_query($con, $query);

                if(!$result){
                    echo "Hello2";
                    die("Error: Could Not Connect");
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    $num_of_questions           =       $row[0];
                    $test_answers               =       $row[1];
                    $response_array             =       "";
                    
                    for($i = 1; $i <= $num_of_questions; $i++){
                        if(isset($_POST["question_".$i])){
                            $response_array .= $_POST["question_".$i];
                        }else{
                            $temp = "_";
                            $response_array .= $temp;
                        }
                    }
                    
                    $correct_answers = 0;

                    for($i = 0; $i < $num_of_questions; $i++){
                        if($response_array[$i] == $test_answers[$i]){
                            $correct_answers++;
                        }
                    }

                    $query = "
                        INSERT INTO responses(test_id, student_id, student_response, marks_obtained)
                        VALUES ('$test_id', '$student', '$response_array', $correct_answers)
                    ";

                    $result = mysqli_query($con, $query);

                    if(!$result){
                        echo "Hello3";
                        die("Error: Could Not connect. ".mysqli_connect_errno());
                    }else{
                        setcookie("test_id", "", time() - 3600,"/");
                        header("Location: http://localhost:8080/online-examination-system/views/studentAccess.php");
                    }
                }
            }
        };
    }

    // ***************   TEST PAGE FUNCTIONS ENDS ********************//

?>
