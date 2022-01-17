<?php

require_once "../includes/config.php";
include "../includes/functions.php";

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../User/login.php");
    exit;
}
$postid = $_GET['postid'];
$topic = $_GET['topic'];
$user = $_SESSION['username'];

$sql = "SELECT post_Obsah FROM Posts where Id_postu = ?";
$cont = getValuesFromDB($db, $sql, array($postid => "i"), 1, false)[0];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $contNew = ($_POST['Content']);

    if ($cont == $contNew) {
        header("Location: ../Topics/topic.php?data=$topic");
        exit;
    }
    if (strlen($contNew) < 1) {
        $error .= '<p>Content must have at least 1 character.</p>';
    }
    if (strlen($contNew) > 500) {
        $error .= '<p>Content must have maximum of 500 characters.</p>';
    }
    if (empty($error)) {
        $sql = "UPDATE Posts set post_Obsah = ? where Id_postu = ?";
        updateData($db, $sql, array($contNew, $postid), "si");
        header("Location: ../Topics/topic.php?data=$topic");
        exit;
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit post</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1">Edit post</div>
        <?php echo $error; ?>
        <div class="box1Text">
            <div class="fillWindows">
                <form action="#" method="post">
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Content" rows="5" cols="40" maxlength="500"
                                      id="cont"
                                      placeholder="Content" required><?php echo $cont ?></textarea>
                        </label>
                    </div>
                    <div style="text-align: center">
                        <button type="submit" name="submit" value="Submit">Edit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <?php include "../includes/sidebar.php"; ?>

    <?php include "../includes/reklama.php"; ?>

    <div class="design footer">Footer</div>

</div>

</body>
</html>

