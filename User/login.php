<?php
global $error;

require_once "../includes/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email)) {
        $error .= '<p>Please enter email.</p>';
    }
    if (strlen($email) > 100) {
        $error .= '<p>Email address is too long</p>';
    }
    if (empty($password)) {
        $error .= '<p>Please enter your password.</p>';
    }
    if (strlen($password) > 30) {
        $error .= '<p>Password is too long</p>';
    }

    if (empty($error)) {
        if ($poziadavka = $db->prepare("SELECT meno , heslo FROM Users WHERE email = ?")) {
            $poziadavka->bind_param('s', $email);
            $poziadavka->execute();
            $poziadavka->store_result();
            $poziadavka->bind_result($meno, $hash);
            $poziadavka->fetch();
            if ($poziadavka->num_rows > 0) {
                if (password_verify($password, $hash)) {
                    $_SESSION["username"] = $meno;
                    $_SESSION["usermail"] = $email;
                    header("location: ../homePage.php");
                    exit;
                } else {
                    $error .= '<p>The password is not valid.</p>';
                }
            } else {
                $error .= '<p>No User exist with that email address.</p>';
            }
        }
        $poziadavka->close();
    }
}
mysqli_close($db);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <!--Kontajner pre Login-->
    <div class="main-grid-layout box1Container" style="text-align: center;max-width: 60%;margin-left: 20%">
        <div style="padding-top: 10px" class="nameOfBox1">Login</div>
        <?php echo $error; ?>
        <div class="box1Text">
            <div class="fillWindows">
                <form action="#" method="post">
                    <div class="fillWindows">
                        <label>
                            <input type="email" name="email" placeholder="Email" required>
                        </label>
                    </div>
                    <div class="fillWindows">
                        <label>
                            <input type="password" name="password" id="Psw" placeholder="Password" required>
                        </label>
                    </div>
                    <div>
                        <button type="submit" name="submit" value="Submit">Login</button>
                    </div>
                    <div>
                        <label>
                            <script src="../Scripts/passwordShow.js"></script>
                            <input type="checkbox" onclick="showPassword()"> Show Password
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Kontajner pre Register-->
    <div class="main-grid-layout box2Container" style="text-align: center;max-width: 60%;margin-left: 20%">
        <div class="nameOfBox2" style="padding-top: 10px"><a
                    href="registration.php"><span>No account? Create one here</span></a></div>
    </div>

    <!--Kontajner pre Sidebar-->
    <?php include "../includes/sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "../includes/reklama.php"; ?>


    <div class="design footer">Footer</div>

</div>
</body>
</html>