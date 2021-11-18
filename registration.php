<?php

global $error;
global $insertQuery;

require_once "config.php";
require_once "newSession.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    if ($query = $db->prepare("SELECT * FROM Users WHERE email = ?")) {
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        if ($query->num_rows > 0) {
            $error .= '<p>The email address is already registered!</p>';
        } else {
            if (strlen($password) < 6) {
                $error .= '<p>Password must have atleast 6 characters.</p>';
            }
            if (empty($confirm_password)) {
                $error .= '<p>Please enter confirm password.</p>';
            } else {
                if (empty($error) && ($password != $confirm_password)) {
                    $error .= '<p>Password did not match.</p>';
                }
            }
            if (empty($error)) {
                $insertQuery = $db->prepare("INSERT INTO Users (meno, heslo, email) VALUES (?, ?, ?);");
                $insertQuery->bind_param("sss", $fullname, $password_hash, $email);
                $result = $insertQuery->execute();
                if ($result) {
                    $error .= '<p>Your registration was successful!</p>';
                    $_SESSION['userid'] = $fullname;
                } else {
                    $error .= '<p>Something went wrong!</p>';
                }
            }
        }
    }
    $query->close();
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
    <title>Registration</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "mainMenu.php"; ?>

    <!--Kontajner pre Register-->
    <div class="main-grid-layout box1Container" style="text-align: center;max-width: 70%;margin-left: 15%">
        <div style="padding-top: 10px" class="nameOfBox1">Registration</div>
        <?php echo $error; ?>
        <div class="box1Text">
            <div class="fillWindows register">
                <form action="" method="post">
                    <div>
                        <label>
                            <input type="text" name="name" placeholder="Username" required minlength="6"
                                   maxlength="15">
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="email" name="email" placeholder="Email Address" required minlength="6">
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="password" name="password" placeholder="Password" required>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="password" name="confirm_password" placeholder="Password Confirmation" required>
                        </label>
                    </div>
                    <div>
                        <button type="submit" name="submit" value="Submit">Register</button>
                    </div>
                    <div>
                        <label>
                            <input type="checkbox" checked="checked" name="remember" required><a
                                    style="margin-left: 1%;"
                                    href="registration.php">Accepting
                                terms and conditions</a>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Kontajner pre Login-->
    <div class="main-grid-layout box2Container" style="text-align: center;max-width: 70%;margin-left: 15%">
        <div class="nameOfBox2" style="padding-top: 10px"><a
                    href="login.php"><span>already have an account? log in</span></a></div>
    </div>

    <!--Kontajner pre Sidebar-->
    <div class="main-grid-layout sidebarContainer">
        <div style="padding-top: 10px" class="sidebarContent">Content</div>
        <div class="sidebarContentText">
            <div>
                <div class="sidebarContentTextStyle">
                    <a href="homePage.php">Profile</a>
                </div>
                <div class="sidebarContentTextStyle">
                    <a href="homePage.php">Friends</a>
                </div>
                <div class="sidebarContentTextStyle">
                    <a href="homePage.php">Massages</a>
                </div>
                <div style="text-align: center;margin-top: 1vh;margin-bottom: -15vh">
                    <a href="homePage.php">Your Posts</a>
                </div>
            </div>
        </div>
        <div style="padding-top: 10px" class="sidebarSettings">Settings</div>
        <div class="sidebarSettingsText">
            <div class="sidebarContentText">
                <div>
                    <div class="sidebarContentTextStyle">
                        <a href="homePage.php">User Settings</a>
                    </div>
                    <div class="sidebarContentTextStyle">
                        <a href="homePage.php">Help Center</a>
                    </div>
                    <div style="text-align: center;margin-top: 1vh;margin-bottom: -15vh">
                        <a href="homePage.php">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Reklamy-->
    <div class="design ads">
        <a href="homePage.php"><img src="Resources/ads.jpg" alt=""></a>
    </div>
    <div class="design footer">Footer</div>

</div>
</body>
</html>