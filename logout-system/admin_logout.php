<?php
    setcookie("admin_loggedIn", "", time() - 3600,"/");
    header("Location: http://localhost:8080/online-examination-system/views/index.html");
?>