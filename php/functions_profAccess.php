<?php
    
    // ***************   PROFESSOR ACCESS PAGE FUNCTIONS ********************//

    // FUNCTION 1 : This function prints all the tests given by the professor.

    function listOutTests(){
        $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
        if($con == false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }else{
            $professor = $_COOKIE["professor_loggedIn"];
            $query =    "SELECT test_subject, test_topic, test_num_of_ques, time_alloted FROM test_details 
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
                            <a href=\"#\" class=\"btn btn-primary\">See responses</a>
                        </div>
                        </div>
                    ";
                    echo $HTML;

                }
            }
        }
    }

?>