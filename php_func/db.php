<?php
    $con = mysqli_connect('localhost', 'root', '', 'Online-Examination-System');
    
    function query($query){
        global $con;
        return mysqli_query($con, $query);
    }

    function fetch_array($results){
        global $con;
        return mysqli_fetch_array($results);
    }
?>