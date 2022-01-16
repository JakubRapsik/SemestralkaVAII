<?php
require_once "../includes/config.php";
include "../includes/functions.php";
session_start();

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
    <title>Menu</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <?php include "../Topics/topic-formular.php"; ?>


    <?php include "../includes/sidebar.php"; ?>

    <?php include "../includes/reklama.php"; ?>

    <div class="design footer">Footer</div>

</div>

</body>
</html>
