<?php

global $error;
global $vlozenieDB;

require_once "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $email = $_SESSION['usermail'];

    if (empty($name) && empty($password) && empty($confirm_password)) {
        header("Location: userSettings.php");
    }


    if (!empty($name)) {
        if (strlen($name) < 6) {
            $error .= '<p> Name must have atleast 6 characters.</p>';
        } else {
            $poziadavka = $db->prepare("UPDATE Users set meno = ? where email = ?");
            $poziadavka->bind_param('ss', $name, $email);
            $poziadavka->execute();
            $poziadavka->store_result();
            $_SESSION['username'] = $name;
            $poziadavka->close();
            $error .= '<p>Changes were applied</p>';
        }
    }

    if (!empty($password) && !empty($confirm_password)) {

        if (strlen($password) < 8) {
            $error .= '<p>Password must have atleast 8 characters.</p>';
        } else {
            if ($password == $confirm_password) {
                $poziadavka = $db->prepare("UPDATE Users set heslo = ? where email = ?");
                $poziadavka->bind_param('ss', $password_hash, $email);
                $poziadavka->execute();
                $poziadavka->store_result();
                $poziadavka->close();
                $error .= '<p>Changes were applied</p>';
            } else {
                $error .= '<p>Passwords dont match</p>';
            }
        }
    }
    // Close DB connection
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UserSettings</title>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "mainMenu.php"; ?>
    <!--Kontajner pre UserSettings-->
    <div class="main-grid-layout box1Container" style="text-align: center;max-width: 70%;margin-left: 15%">
        <div style="padding-top: 10px" class="nameOfBox1">User settings</div>
        <?php echo $error; ?>
        <div class="box1Text">
            <div class="fillWindows register" style="height: 100%">
                <form action="#" method="post">
                    <div>
                        <?php
                        $user = $_SESSION['username'];
                        echo '<p style="margin: 0;">Username: ' . $user . '</p>';
                        echo '<label>';
                        echo '<input type="text" name="name" placeholder="New Username" minlength="6">';
                        echo '</label>';
                        ?>
                    </div>
                    <div>
                        <div>
                            <p style="margin-bottom: 0; margin-top: 1%">Do you wish to change your password?</p>
                            <label>
                                <input type="password" name="password" id="Psw" placeholder="New Password" minlength="8">
                            </label>
                        </div>
                        <div style="margin: 0">
                            <label>
                                <meter max="4" id="strength-meter"></meter>
                                <div id="strength-text"></div>
                            </label>
                        </div>
                        <script src="Scripts/passwordStrength.js"></script>
                    </div>
                    <div>
                        <label>
                            <input type="password" name="confirm_password" placeholder="Password Confirmation">
                        </label>
                    </div>
                    <div>
                        <button type="submit" name="submit" value="Submit">Apply Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function zmazanie() {
            alert("Hello! I am an alert box!");
        }
    </script>

    <!--Kontajner pre DeleteUsera-->
    <div class="main-grid-layout box2Container" style="text-align: center;max-width: 70%;margin-left: 15%; margin-top: 1%">
        <div class="nameOfBox2" style="padding-top: 10px"><a
                    href="profileDelete.php" onclick="return confirm('Are you sure you want to delete this account?');"><span
                        style="color: red">Delete account</span></a></div>
    </div>

    <!--Kontajner pre Sidebar-->
    <?php include "sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "reklama.php"; ?>


    <div class="design footer">Footer</div>

</div>
</body>
