<?php
session_start();
require_once 'db.php';

include_once 'session.php';
sessionChange();

$signUp = 1;

if ($_POST['first_name'] == null) {
    $_SESSION['first_name'] = false;
    $signUp = 0;
}
if ($_POST['last_name'] == null) {
    $_SESSION['last_name'] = false;
    $signUp = 0;
}
if (strlen($_POST['password']) < 6) {
    $_SESSION['password'] = false;
    $signUp = 0;
}
if ($_POST['email'] == null) {
    $_SESSION['email'] = false;
    $signUp = 0;
}
if ($_POST['password']!== $_POST['repassword']) {
    $_SESSION['repassword'] = false;
    $signUp = 0;
}
if (strtolower($_POST['title']) != "admin" and strtolower($_POST['title']) != "user") {
    $_SESSION['title'] = false;
    $signUp = 0;
}

$title = strtolower($_POST['title']);

if ($signUp != 0) {
    $user = "INSERT INTO users (id, first_name, last_name, email, password) VALUES (Null, '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['email']."', '".$_POST['password']."')";
    $rol = "INSERT INTO roles (id, title) VALUES (Null, '$title')";
    $user_query_result = mysqli_query($conn, $user);
    if(!$user_query_result){
        die("Query failed");
    }
    $rol_query_result = mysqli_query($conn, $rol);
    if(!$rol_query_result){
        die("Query failed");
    }
    header('Location: homePage.php');
} else {
    header('Location: register.php');
}
mysqli_close($conn);
?>