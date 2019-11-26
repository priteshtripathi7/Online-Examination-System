<?php
    
    // ***************   PROFESSOR ACCESS PAGE FUNCTIONS ********************//

    // FUNCTION 1 : This function prints all the tests given by the professor.

    function listOutTests(){
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con == false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }else{
            $professor = $_COOKIE["professor_loggedIn"];
            $query =    "SELECT test_subject, test_topic, test_num_of_ques, time_alloted, test_id FROM test_details 
                            WHERE teacher_id= '$professor'";
            $result = mysqli_query($con, $query);
            if(!$result){
                die("ERROR: Could not connect.");
            }else{
                while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                
                    $subject            =      $row[0];
                    $topic              =      $row[1];
                    $number_of_ques     =      $row[2];
                    $time_alloted       =      $row[3];
                    $test_id            =      $row[4];
                    
                    

                    $HTML = "
                        <div class=\"card col-sm-6 col-md-4\" style=\"width: 8rem; padding: 1rem;\">
                        <img src=\"./../img/".$subject.".jpg\" class=\"card-img-top \" alt=\"".$subject."\" style=\"height:30vh;\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">".$subject."</h5>
                            <p class=\"card-text\">
                                <p>TOPIC  : <span style=\"font-weight:bold;\">".$topic."</span></p>
                                <p>NUMBER OF QUESTIONS  : <span style=\"font-weight:bold;\">".$number_of_ques."</span></p>
                                <p>TIME ALLOTED  : <span style=\"font-weight:bold;\">".$time_alloted."</span> minutes.</p>
                            </p>
                            <form method=\"GET\" action=\"./see_response.php\">
                            <input type=\"submit\" id=\"".$test_id."\" name=\"".$test_id."\" value=\"See responses\" class=\"btn btn-info\" >
                            </form>
                            
                        </div>
                        </div>
                    ";
                    echo $HTML;
                }
            }
        }
    }

    function testDetails() {
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
                        <p class="lead">
                        Subject:        '.$subject.'
                        <br>
                        Topic:          '.$topic.'
                        <br>
                        Maximum marks:  '.$number_of_ques.'
                        <br>
                        Time alloted:   '.$time_alloted.' minutes
                        </p>
                        ';
                        echo $HTML;
                    }
                }
            }
        }
    }

    function outputResponses() {
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con == false){
                die("Error: Could not connect ".mysqli_connect_errno());
            }else{
                foreach($_GET as $key => $value){
                    $test_id  =  $key;

                    $query = "
                        SELECT student_id, marks_obtained
                        FROM responses
                        WHERE test_id = '$test_id'
                        ORDER BY student_id
                    ";

                    $result = mysqli_query($con, $query);
                    if(!$result){
                        die("Error: Could not connect ".mysqli_connect_errno());
                    }else{
                        $count = 1;
                        $row_count = mysqli_num_rows($result);
                        if($row_count == 0){
                            $mssg = '
                                <div class="alert alert-danger conatiner" role="alert">
                                    There are no attempts yet.
                                </div>
                            ';
                            echo $mssg;
                        }
                        while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                            $student            =        $row[0];
                            $marks              =        $row[1];

                            $query2 = "
                                SELECT firstname, lastname 
                                FROM student
                                WHERE student_username = '$student'
                            ";

                            $result2  = mysqli_query($con, $query2);

                            $row2 = mysqli_fetch_array($result2, MYSQLI_NUM);

                            $firstname         =       $row2[0];
                            $lastname          =       $row2[1];
                            $student           =       strtoupper($student);
                            $HTML = '
                                <tr> 
                                    <th scope="row">'.$count.'</th>
                                    <td>'.$student.'</td>
                                    <td>'.$firstname.' '.$lastname.'</td>
                                    <td>'.$marks.'</td>
                                    <td>
                                        <form method = "POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                                            <input type="submit" name="'.$test_id.'_'.$student.'" value="Clear Response" class="text-center btn btn-danger">
                                        </form>
                                    <td>
                                </tr>
                            ';
                            echo $HTML;
                            $count++;
                        }
                    }
                }
            }
        }
    }

    function checkDelete() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
            if($con == false){
                die("Error: Could not connect ".mysqli_connect_errno());
            }else{
                foreach($_POST as $key => $value){
                    $res = explode("_", $key);
                    $test_id = $res[0];
                    $student = $res[1];

                    $query = "
                        DELETE FROM responses
                        WHERE test_id = '$test_id' AND student_id = '$student'
                    ";

                    $result = mysqli_query($con, $query);
                    if(!$result){
                        die("Error: Could not connect ".mysqli_connect_errno());
                    }else{
                        header("Location: http://localhost:8080/online-examination-system/views/professorAccess.php");
                    }
                }
            }
        }
    }

?>

