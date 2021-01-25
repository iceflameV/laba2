<?php
session_start();
require_once 'db.php';

mysqli_query($conn, "DELETE users, roles FROM users INNER JOIN roles ON users.id = roles.id WHERE users.id='" . $_GET['id'] . "'") or die('Connection error to db.');
if ($_GET['id'] == $_SESSION['id']) header('Location: signOut.php');
else header('Location: homePage.php');
