<?php
    function validate_admin_login(){
        $username = "";
        $password = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST["prof-username"])){
                $con = mysqli_connect('localhost', 'root', '', 'online-examination-system');
                if($con === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                $username    = $_POST["prof-username"];
                $password    = $_POST["prof-pwd"];
                $query =    "SELECT password FROM admindetails 
                            WHERE username= '$username'";
                $result = mysqli_query($con, $query);
                if(!$result){
                    die("ERROR: Could not connect.");
                }else{
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    echo $row["password"];
                }
            }
        }
    }
?>