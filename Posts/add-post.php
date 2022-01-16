<?php
require_once "../includes/config.php";
include "../includes/functions.php";
session_start();
$topic = $_GET['topic'];
$user = $_SESSION['username'];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $cont = ($_POST['Content']);

    if (empty($cont)) {
        $error .= '<p>Content must have at least 1 character.</p>';
    }

    if (empty($error)) {
        $sql = "SELECT Id FROM Users where meno = ?";
        $usrid = getValuesFromDB($db, $sql, array($user => "s"), 1, false)[0];

        $sql = "SELECT Id_topicu,Id_categorie FROM Topics where Nazov = ?";
        $vysledok = getValuesFromDB($db, $sql, array($topic => "s"), 2, false);
        $topicid = $vysledok[0];
        $catgid = $vysledok[1];

        $datetime = date("Y-m-d H:i:s", time());
        $request = $db->prepare("INSERT INTO Posts(Id, Cas, Id_topicu, Id_categorie, post_Obsah) VALUE (?,?,?,?,?);");
        $request->bind_param("isiis", $usrid, $datetime, $topicid, $catgid, $cont);
        $vysledok = $request->execute();
        if ($vysledok) {
            $error .= '<p>Category was added successfully</p>';
            header("location: ../Topics/topic.php?data=$topic");
            exit;
        } else {
            $error .= '<p>Something went wrong!</p>';
        }
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
    <title>Add post</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1">Add new post</div>
        <?php echo $error; ?>
        <div class="box1Text">
            <div class="fillWindows">
                <form action="#" method="post">
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Content" rows="5" cols="40" maxlength="500"
                                      id="descr"
                                      placeholder="Content" required></textarea>
                        </label>
                    </div>
                    <div style="text-align: center">
                        <button type="submit" name="submit" value="Submit">Add</button>
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
