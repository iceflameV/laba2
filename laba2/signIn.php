<?php
session_start();
require_once 'db.php';

$res = mysqli_query($conn, "SELECT * FROM users LEFT JOIN roles ON users.id = roles.id WHERE users.email='" .$_POST['email'] . "' and users.password='" . $_POST['password'] . "'");
$user = mysqli_fetch_array($res) or die("Incorrect password or login! Try again!");

if (is_array($user)) {
    $_SESSION['signIn'] = true;
    $_SESSION['name'] = $user['first_name'];
    $_SESSION['id'] = $user['id'];
    $_SESSION['user_title'] = $user['title'];
    header('Location: homePage.php');
}
mysqli_close($conn);
?>
