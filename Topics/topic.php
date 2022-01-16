<?php
require_once "../includes/config.php";
include "../includes/functions.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../User/login.php");
    exit;
}

if (isset($_GET["data"])) {
    $topic = $_GET["data"];
} else {
    header("Location: ../menu.php?data=all");
    exit;
}
$autor = $_SESSION['username'];
$edit = true;

$sql = "SELECT topic_Description,topic_Obsah FROM Topics where Nazov = ?";
$data = getValuesFromDB($db, $sql, array($topic => "s"), 2, false);
$descr = $data[0];
$cont = $data[1];


$edit = false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script src="../Scripts/ajax.js"></script>
    <title>Topic</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <?php include "../Topics/topic-formular.php"; ?>

    <div class="main-grid-layout box2Container">
        <div class="nameOfBox2" style="padding-top: 10px">Posts</div>
        <div class="box2Text" id="postvysledok">
        </div>
        <div style="text-align: center" class='pagination text-center' id="postpaging">
        </div>
        <div class="box2Container" style="text-align: center">
            <div class="nameOfBox2"><a style=" font-size: 25px" href="../Posts/add-post.php?topic=<?php echo $topic ?>">Add
                    Post</a></div>
        </div>
    </div>

    <?php include "../includes/sidebar.php"; ?>

    <div class="design footer">Footer</div>

</div>
<script>
    getPosts('<?php echo $topic ?>', 1);
    getPostPageCount('<?php echo $topic ?>');
</script>
</body>
</html>
