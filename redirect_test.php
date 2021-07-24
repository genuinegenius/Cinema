<?php
    session_start();

    echo 'id:' . $_SESSION['id'] . '<br>';
    echo 'username:' . $_SESSION['username'] . '<br>';
    echo 'ip:' . $_SESSION['ip'] . '<br>';


?>