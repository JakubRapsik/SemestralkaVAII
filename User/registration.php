<?php
global $error;
global $vlozenieDB;
require_once "../includes/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);


    if ($poziadavka = $db->prepare("SELECT * FROM Users WHERE email = ?")) {
        $poziadavka->bind_param('s', $email);
        $poziadavka->execute();
        $poziadavka->store_result();
        if ($poziadavka->num_rows > 0) {
            $error .= '<p>The email address is already registered!</p>';
        } else {
            if (empty($email)) {
                $error .= '<p>Please enter email.</p>';
            }
            if (strlen($email) > 100) {
                $error .= '<p>Email address is too long</p>';
            }
            if (strlen($password) < 8) {
                $error .= '<p>Password must have atleast 8 characters.</p>';
            }
            if (strlen($password) > 30) {
                $error .= '<p>Password is too long</p>';
            }
            if (strlen($name) < 6) {
                $error .= '<p>Name must have atleast 6 characters.</p>';
            }
            if (strlen($name > 75)) {
                $error .= '<p> Name can have maximum of 75 characters</p>';
            }
            if (empty($confirm_password)) {
                $error .= '<p>Please enter confirm password.</p>';
            } else {
                if (empty($error) && ($password != $confirm_password)) {
                    $error .= '<p>Password did not match.</p>';
                }
            }
            if (empty($error)) {
                $vlozenieDB = $db->prepare("INSERT INTO Users (meno, heslo, email) VALUES (?, ?, ?);");
                $vlozenieDB->bind_param("sss", $name, $password_hash, $email);
                $vysledok = $vlozenieDB->execute();
                if ($vysledok) {
                    $error .= '<p>Your registration was successful!</p>';
                    $_SESSION['username'] = $name;
                    header("location: ../homePage.php");
                    exit;
                } else {
                    $error .= '<p>Something went wrong!</p>';
                }
            }
        }
    }
    $poziadavka->close();
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <!--Kontajner pre Register-->
    <div class="main-grid-layout box1Container" style="text-align: center;max-width: 70%;margin-left: 15%">
        <div style="padding-top: 10px" class="nameOfBox1">Registration</div>
        <?php echo $error; ?>
        <div class="box1Text">
            <div class="fillWindows register">
                <form action="#" method="post">
                    <div>
                        <label>
                            <input type="text" name="name" placeholder="Username" required minlength="6">
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="email" name="email" placeholder="Email Address" required minlength="6">
                        </label>
                    </div>
                    <div>
                        <div>
                            <label>
                                <input type="password" name="password" id="Psw" placeholder="Password" required
                                       minlength="8">
                            </label>
                        </div>
                        <div>
                            <label>
                                <meter value="0" max="4" id="strength-meter"></meter>
                            </label>
                            <div id="strength-text"></div>
                        </div>
                        <script src="../Scripts/passwordStrength.js"></script>
                    </div>
                    <div>
                        <label>
                            <input type="password" name="confirm_password" id="CPsw" placeholder="Password Confirmation"
                                   required>
                        </label>
                    </div>
                    <div>
                        <label>
                            <script src="../Scripts/passwordShow.js"></script>
                            <input type="checkbox" onclick="showPassword()"><a
                                    style="margin-left: 1%;">Show Password</a>
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
    <div class="main-grid-layout box2Container"
         style="text-align: center;max-width: 70%;margin-left: 15%; margin-top: 7%">
        <div class="nameOfBox2" style="padding-top: 10px"><a
                    href="login.php"><span>already have an account? log in</span></a></div>
    </div>

    <!--Kontajner pre Sidebar-->
    <?php include "../includes/sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "../includes/reklama.php"; ?>


    <div class="design footer">Footer</div>

</div>
</body>
</html>