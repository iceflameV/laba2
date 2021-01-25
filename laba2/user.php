<?php
session_start();
require_once 'db.php';

$res = mysqli_query($conn, "SELECT users.id, users.first_name, users.last_name, users.email, users.photo, users.password, roles.title FROM users LEFT JOIN roles ON users.id = roles.id WHERE users.id='" . $_GET['id'] . "'");
$user = mysqli_fetch_array($res);

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
        .sel {
            font-size: 20px;
        }

        .photo {
            padding: 21px 10px;
            vertical-align: text-top;
        }

        .error {
            font-size: 18px;
            color: red;
            text-align: center;
        }

        .user_btn {
            background: #774a96;
            font-size: 19px;
            border-radius: 10%;
            padding: 10px 17px;
            border: 1px solid;
            color: #000000;
            text-decoration: none;
            cursor: pointer;
            margin-right: 1em;
            margin-left: 2.2em;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <p class="text">User page</p>
</div>
<div>
    <img class="logo" src="assets/img/logo.png" alt="logo" width="130" height="104">
</div>
<div>
    <?php
    echo '<table align="center">';
    echo '<tr>';
    echo '<td class="photo">';
    echo "<img src = " . $user['photo'] . " alt='User photo' width='250' height='200' >";
    echo '</td>';
    if ((isset($_SESSION['signIn'])) and ($_SESSION['user_title'] == 'admin' or $_GET['id'] == $_SESSION['id'])) {
        echo '<td>';
        echo '<form action="edit.php?id=' . $_GET['id'] . '" method="post" enctype="multipart/form-data">';
        echo '<input class="admin_inform" type="text" name="first_name" value=' . $user['first_name'] . '>';
        if (isset($_SESSION['first_name']) and $_SESSION['first_name'] == false) echo '<p class="error">Fill the first_name.</p>';
        echo '<input class="admin_inform" type="text" name="last_name" value=' . $user['last_name'] . '>';
        if (isset($_SESSION['last_name']) and $_SESSION['last_name'] == false) echo '<p class="error">Fill the last_name.</p>';
        if ($_SESSION['user_title'] == 'admin') {
            echo '<input class="admin_inform" list="Role" name="title" value=' . $user['title'] . '>
            <datalist id="Role">
                <option value="Admin">
                <option value="User">
            </datalist>';
        }
//        if (isset($_SESSION['title']) and $_SESSION['title'] == false) echo '<p class="error">Incorrect role.</p>';
//        echo '<input class="admin_inform" type="email" name="email" value=' . $user['email'] . '>';
//
//        if (isset($_SESSION['email']) and $_SESSION['email'] == false) echo '<p class="error">Fill in the email.</p>';
//        echo ' <input class="admin_inform" type="text" name="password" value=' . $user['password'] . '>';
//
//        if (isset($_SESSION['password']) and $_SESSION['password'] == false) echo '<p class="error">Password must be at least 6 symbols.</p>';
//        echo '<input class="admin_inform" type="password" name="repassword" value=' . $user['password'] . '>';
//
//        if (isset($_SESSION['repassword']) and $_SESSION['repassword'] == false) echo '<p class="error">Incorrect repassword.</p>';
//        echo ' <p class="sel" align="center">Select image to upload</p>
//                    <input class="admin_inform" type="file" name="fileToUpload">';
//        if (isset($_SESSION['photo']) and $_SESSION['photo'] == false) echo '<p class="error">Choose the photo. Size < 500kb.<br>Format jpeg, png, jpg, gif.</p>';
//
//        if ($_SESSION['user_title'] == 'admin') {
//            echo '<a class="user_btn" href="delete.php?id=' . $_GET['id'] . '" >Delete</a>';
//        }
//
//        echo ' <input class="user_btn" type="submit" name="submit" value="Edit">';
//        echo '</form>';
//        echo '</td>';

        if (isset($_SESSION['title']) and $_SESSION['title'] == false) echo '<p class="error">Incorrect role.</p>';
        echo '<input class="admin_inform" type="email" name="email" value=' . $user['email'] . '>';

        if (isset($_SESSION['email']) and $_SESSION['email'] == false) echo '<p class="error">Fill in the email.</p>';
        echo ' <input class="admin_inform" type="password" name="password" value=' . $user['password'] . '>';

        if (isset($_SESSION['password']) and $_SESSION['password'] == false) echo '<p class="error">Password must be at least 6 symbols.</p>';
        echo '<input class="admin_inform" type="password" name="repassword" value=' . $user['password'] . '>';

        if (isset($_SESSION['repassword']) and $_SESSION['repassword'] == false) echo '<p class="error">Incorrect repassword.</p>';
        echo ' <p class="sel" align="center">Select image to upload</p>
                    <input class="admin_inform" type="file" name="fileToUpload">';
        if (isset($_SESSION['photo']) and $_SESSION['photo'] == false) echo '<p class="error">Choose the photo. Size < 500kb.<br>Format jpeg, png, jpg, gif.</p>';
        if ($_SESSION['user_title'] == 'admin') {
            echo '<a class="user_btn" href="delete.php?id=' . $_GET['id'] . '" >Delete</a>';
        }
        echo ' <input class="user_btn" type="submit" name="submit" value="Edit">';
        echo '</form>';
        echo '</td>';
    } else {
        echo '<td>';
        echo '<p class="inform">' . $user["first_name"] . '</p>';
        echo '<p class="inform"> ' . $user["last_name"] . '</p>';
        echo '<p class="inform">' . $user["email"] . '</p>';
        echo '<p class="inform">' . $user["title"] . '</p>';
        echo '</td>';
    }
    echo '</tr>';
    echo '</table>';
    ?>
</div>

</body>
</html>

