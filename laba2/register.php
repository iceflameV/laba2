<?php
session_start();

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style1.css">
    <style>
        .btn {
            text-decoration: none;
            background: #774a96;
            font-size: 18px;
            padding: 10px 17px;
            border: 1px solid;
            color: #ffffff;
            cursor: pointer;
        }
        .error {
            font-size: 18px;
            color: #ff0000;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <p class="text">Sign Up</p>
</div>
<div>
    <img class="logo" src="assets/img/logo.png" alt="logo" width="130" height="104">
</div>
<div align="center">
    <?php
    echo '<form action="signUp.php" method="post">';
    echo '<input class="register" type="text" name="first_name" placeholder="First Name">';
    if (isset($_SESSION['first_name']) and $_SESSION['first_name'] == false) {
        echo '<p class="error">Fill the first name.</p>';
    }
    echo '<input class="register" type="text" name="last_name" placeholder="Last Name">';
    if (isset($_SESSION['last_name']) and $_SESSION['last_name'] == false) {
        echo '<p class="error">Fill the last name.</p>';
    }
    echo '<input class="register" list="Role" name="title" placeholder="Select Role">
            <datalist id="Role">
                <option value="Admin">
                <option value="User">
            </datalist>';
    if (isset($_SESSION['title']) and $_SESSION['title'] == false) {
        echo '<p class="error">Incorrect role<p>';
    }
    echo '<input class="register" type="email" name="email" placeholder="Email">';
    if (isset($_SESSION['email']) and $_SESSION['email'] == false) {
        echo '<p class="error">Fill the email.</p>';
    }
    echo ' <input class="register" type="password" name="password" placeholder="Password">';

    if (isset($_SESSION['password']) and $_SESSION['password'] == false) {
        echo '<p class="error">Password must be at least 6 symbols.</p>';
    }
    echo '<input class="register" type="password" name="repassword" placeholder="Repeat Password">';

    if (isset($_SESSION['repassword']) and $_SESSION['repassword'] == false) {
        echo '<p class="error">Incorrect repeated password.</p>';
    }
    echo ' <input type="submit" name="submit" value="Sign Up" class="btn">';
    echo '</form>';
    ?>
</div>
</body>
</html>
