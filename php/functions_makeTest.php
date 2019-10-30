<?php
    // ***************   PROFESSOR MAKE TEST PAGE FUNCTIONS    ******************** //

    // FUNCTION 1 : This function outputs all the subjects of the professor

    function outputSubject() {
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }else{
            $username = $_COOKIE["professor_loggedIn"];
            $query =    "SELECT course_id FROM courses_professor 
                            WHERE professor_id= '$username'";

            $result = mysqli_query($con, $query);
            if(!$result){
                die("ERROR: Could not connect.");
            }else{
                while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    echo var_dump($row);
                    $option = "
                        <option>$row[0]</option>
                    ";
                    echo $option;
                }
            }
        }
    }

    // FUNCTION 2 : This function saves the test to the database.
    
    function saveTestToDB() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con == false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }else{
                $professor           =     $_COOKIE["professor_loggedIn"];
                $test_subject        =     $_POST["test_subject"];
                $test_topic          =     $_POST["test_topic"];
                $time_alloted        =     $_POST["test_time"];
                $num_of_questions    =     0;
                $test_password       =     $_POST["test_password"];
                $test_password       =     md5($test_password);

                $test_id             =     $test_subject;
                $test_id            .=     $test_topic;
                $test_id            .=     $professor;
                $test_id             =     md5($test_id);
                

                $answer_str          =     "";
                foreach($_POST as $key => $value){
                    if(preg_match("/_correct_answer/",$key)){
                        $answer_str  .=  $value;
                        $num_of_questions++;
                    }
                }

                $query =    "INSERT INTO test_details(test_id, test_subject, test_topic, test_num_of_ques, 	teacher_id, test_answers, 	time_alloted, test_password)
                                    VALUES ('$test_id', '$test_subject', '$test_topic', '$num_of_questions', '$professor', '$answer_str', '$time_alloted', '$test_password')";
                
                $result = mysqli_query($con, $query);
                if(!$result){
                    die("ERROR: Could not connect.");
                }else{
                    $q_n = 0;
                    foreach($_POST as $key => $value){
                        if(preg_match("/this_is_question_/", $key)){
                            $q_n++;
                            $question_beg       =        substr($key, 8);
                            $options            =        [];
                            $question_num       =        strval($q_n);
                            $question           =        $_POST[$key];
                            $num_of_options     =        $_POST[$question_beg."_num_of_options"];
                            $options[0]         =        "NULL";
                            $options[1]         =        "NULL";
                            $options[2]         =        "NULL";
                            $options[3]         =        "NULL";
                            $correct_answer     =        $_POST[$question_beg."_correct_answer"];

                            for($i = 0; $i < $num_of_options; $i++){
                                $options[$i] = $_POST[$question_beg."_option_".$i];
                            }
                            
                            $query =    "INSERT INTO question_details(test_id, question_number, question, option_a, option_b, option_c, option_d, correct_answer)
                                            VALUES ('$test_id', '$question_num', '$question', '$options[0]', '$options[1]', '$options[2]', '$options[3]', '$correct_answer')";
                            $result = mysqli_query($con, $query);
                            if(!$result){
                                die("ERROR: Could not connect.");
                            }else{
                                
                                // ADD LOGIC TO ALERT
                                
                                header("Location: http://localhost:8080/online-examination-system/views/professorAccess.php");
                                
                            }
                        }
                    }
                }
                
            }
        }
    }

?>