<?php
    require './../PHPMailerAutoload.php';
    require './../php/config.php';

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
                    <h5 class="card-header h5">General Rules\'s Rule</h5>
                    <div class="card-body">
                        <ul>
                            <li>1.This test consists of '.$num_of_questions.' questions.</li>
                            <li>2.The time alloted for this test is '.$time_alloted.' minutes.</li>
                            <li>3.On clicking the below button the browser will go full screen.</li>
                            <li>4.<b>The test must be given in full screen only</b></li>
                            <li>5.<b>Do not exit full screen</b> as it may lead to end your test.</li>
                            <li>6.<b>Do not switch tabs or close the browser</b> as it may lead to end your test.</li>
                            <li>7.The moment you exit full screen or submit the test, the test will be its over.</li>
                            <br>
                            <div >
                                <button type="button" id="full-scr" class="btn btn-info">Go full screen</button>
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
                            Time:<h5><span id="exam-timer">'.$time_alloted.':00</span></h5>
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
                WHERE test_id = '$test_id'
                ORDER by question_number ASC;
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
                die("Error: Could not connect. ". mysqli_connect_errno());
            }else{
                $test_id = $_COOKIE["test_id"];
                $student = $_COOKIE["student_loggedIn"];

                $query = "  SELECT test_num_of_ques, test_answers, test_subject, test_topic
                            FROM test_details
                            WHERE test_id = '$test_id';
                ";

                $result = mysqli_query($con, $query);

                if(!$result){
                    die("Error: Could Not Connect");
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_NUM);
                    $num_of_questions           =       $row[0];
                    $test_answers               =       $row[1];
                    $subject                    =       $row[2];
                    $topic                      =       $row[3];    
                    $response_array             =       "";
                    
                    for($i = 1; $i <= $num_of_questions; $i++){
                        if(isset($_POST["question_".$i]) ){
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
                        echo "Hello2";
                        die("Error: Could Not connect. ".mysqli_connect_errno());
                    }else{

                        $query = "
                            SELECT email,firstname,lastname
                            FROM student
                            WHERE student_username = '$student'
                        ";
                        $result = mysqli_query($con, $query);
                        if(!$result){
                            echo "Hello1";
                            die("Error: Could Not connect. ".mysqli_connect_errno());
                        }else{
                            $row = mysqli_fetch_array($result, MYSQLI_NUM);

                            $email              =           $row[0];
                            $fname              =           $row[1];
                            $lname              =           $row[2];

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
                            
                            // $mail->addCC('cc@example.com');
                            // $mail->addBCC('bcc@example.com');

                            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                            $mail->isHTML(true);                                  // Set email format to HTML
                            
                            $mssg = '
                                    <!DOCTYPE html>
                                    <html>
                                        <head>
                                            
                                            <title>Result</title>
                                        </head>
                                        <body>
                                            <div class="jumbotron" style="background-color: palegoldenrod; padding:2em;">
                                                <h1 class="display-3">'.$subject.'</h1>
                                                <p class="lead">
                                                    Topic: '.$topic.'
                                                </p>
                                                <div class="conatiner">
                                                    <div class="alert alert-info">
                                                        <strong>Hello!</strong> '.$fname.' '.$lname.'.
                                                        This is to inform you that you have obtained '.$correct_answers.' out of '.$num_of_questions.' in '.$subject.' test on the topic '.$topic.'.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </body>
                                    </html>
                            ';

                            $mail->Subject = 'Attempted Test';
                            $mail->Body    = $mssg;
                            $mail->AltBody = 'HELLO '.$fname.' '.$lname.' This is the results of your attempted test.
                            Subject: '.$subject.'Topic: '.$topic.' Marks Obtained: '.$correct_answers.'  out of  '.$num_of_questions.'.';

                            $mail->send();
                        }

                        setcookie("test_id", "", time() - 3600,"/");
                        header("Location: http://localhost:8080/online-examination-system/views/studentAccess.php");
                    }
                }
            }
        };
    }

    // ***************   TEST PAGE FUNCTIONS ENDS ********************//

?>
