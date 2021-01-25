<?php
session_start();
require_once 'db.php';

include_once 'session.php';
sessionChange();

$signUp = 1;

if($_SESSION['user_title'] == "user") {
    $title = $_GET['title'];
}

$target_dir = "public/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


if ($_POST['first_name']== null) {
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
if ($_POST['email']== null) {
    $_SESSION['email'] = false;
    $signUp = 0;
}
if ( $_POST['password'] !== $_POST['repassword']) {
    $_SESSION['repassword'] = false;
    $signUp = 0;
}
if ($_POST['title'] != "admin" and $_POST['title'] != "user" and $_SESSION['user_title'] == "admin") {
    $_SESSION['title'] = false;
    $signUp = 0;
}

if ($_FILES["fileToUpload"]["tmp_name"] == null) {
    $_SESSION['photo'] = false;
    $signUp = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    $signUp = 0;
    $_SESSION['photo'] = false;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    $signUp = 0;
    $_SESSION['photo'] = false;
}

if ($signUp != 0) {
    $user = "UPDATE users SET first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', email='".$_POST['email']."', password='".$_POST['password']."', photo='$target_file' WHERE id='".$_GET['id']."'";
    if($_SESSION['user_title'] == "admin"){
        $rol = "UPDATE roles SET title='".$_POST['title']."' WHERE id='".$_GET['id']."'";
        mysqli_query($conn, $rol) or die('Error querying database.');
    }
    mysqli_query($conn, $user) or die('Error querying database.');
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) or die('Error uploading a photo.');
} else {
    $_SESSION['edit'] = false;
}
header('Location: user.php?id=' .$_GET['id']. '');
mysqli_close($conn);
?>