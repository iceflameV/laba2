<?php
session_start();
require_once 'db.php';

include_once 'session.php';
sessionChange();

$sql = "SELECT users.id, users.first_name, users.last_name, users.email, users.photo, roles.title FROM users LEFT JOIN roles ON users.id = roles.id";
//$sql = "SELECT users.id, users.first_name, users.last_name, users.email, users.photo, roles.title FROM users LEFT JOIN roles ON users.id = roles.id";

$res = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style1.css">
    <style>
        .a {
            color: #000000;
        }

        .line {
            position: relative;
            font-size: 24px;
            left: 37.5em;
            font-weight: bolder;
            color: #000000;
            margin-left: 5px;
            margin-right: 5px;
            text-decoration: none;
            display: inline-block;
            bottom: 1.3em;
        }

        .ad {
            background: #b500e7;
            font-size: 20px;
            border-radius: 5%;
            padding: 10px 17px;
            border: 1px solid;
            color: white;
            position: relative;
            top: 2em;
            left: 12.8em;
            text-decoration: none;
        }
    </style>
    <title>Lera Iceflame</title>
    <link rel="shortcut icon" href="assets/img/logo.png">
</head>
<body>
<div class="header">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <p class="text">Important web page</p>
</div>
<div>
    <img class="logo" src="assets/img/logo.png" alt="logo" width="130" height="104">
    <?php
    if (!isset($_SESSION['signIn'])) {
        echo ' <a class="link" href="#openModal">Sign In</a>';
        echo '<p class="line">|</p>';
        echo '<a class="link" href="register.php">Sign Up</a>';
    } else {
        echo '<p class="link">' . $_SESSION['name'] . '</p>';
        echo '<p class="line">|</p>';
        echo '<a class="link" href="signOut.php">Sign Out</a>';
    }
    ?>
</div>
<div id="openModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p></p>
                <a href="homePage.php" class="close">×</a>
            </div>
            <div class="modal-body">
                <form action="signIn.php" method="POST">
                    <table class="sg">
                        <tr>
                            <td>
                                Email
                            </td>
                            <td>
                                <input type="email" name="email"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Password
                            </td>
                            <td>
                                <input type="password" name="password"><br>
                            </td>
                        </tr>
                    </table>
                    <div class="modal-footer">
                        <p></p>
                        <input class="btn" type="submit" value="Sign In">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div align="center">
    <article>
        <?php
        if ($res->num_rows > 0) {
            echo '<table class="tg">';
            echo '<tr>
                <td class="tg-top">ID</td> 
                <td class="tg-top">First name</td> 
                <td class="tg-top">Last name</td> 
                <td class="tg-top">Email</td> 
                <td class="tg-top">Role</td> 
            </tr>';

            while ($row = $res->fetch_assoc()) {

                if (isset($_SESSION['signIn']) and $row['id'] == $_SESSION['id']) {
                    echo '<tr class="tg-user">';
                    echo "<td><a class='a' href='user.php?id=" . $row['id'] . "'>" . $row["id"] . "</a></td>";
                    echo '<td>' . $row["first_name"] . '</td>';
                    echo '<td>' . $row["last_name"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $row["title"] . '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr>';
                    echo "<td><a class='a' href='user.php?id=" . $row['id'] . "'>" . $row["id"] . "</a></td>";
                    echo '<td>' . $row["first_name"] . '</td>';
                    echo '<td>' . $row["last_name"] . '</td>';
                    echo '<td>' . $row["email"] . '</td>';
                    echo '<td>' . $row["title"] . '</td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
        }
        if (isset($_SESSION['signIn']) and $_SESSION['user_title'] == 'admin') {
            echo '<a class="ad" href="register.php">Add user</a>';
        }
        ?>

    </article>
</div>
</body>
</html>
