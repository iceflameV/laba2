<?php
function sessionChange(){
    $signIn = 0;
    $first_name = 0;
    $id = 0;
    $role = 0;
    if (isset($_SESSION['signIn'])) {
        $signIn = $_SESSION['signIn'];
        $first_name = $_SESSION['name'];
        $id = $_SESSION['id'];
        $role = $_SESSION['user_title'];
    }
    session_destroy();
    session_start();
    if ($signIn != 0) {
        $_SESSION['signIn'] = $signIn;
        $_SESSION['name'] = $first_name;
        $_SESSION['id'] = $id;
        $_SESSION['user_title'] = $role;
    }
}
