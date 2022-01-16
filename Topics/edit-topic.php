<?php

require_once "../includes/config.php";
include "../includes/functions.php";
session_start();

if (isset($_GET["topic"])) {
    $topic = $_GET["topic"];
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['Name']);
    $name = str_replace(' ', '', $name);
    $descrNew = ($_POST['Description']);
    $contNew = ($_POST['Obsah']);

    if ($name == $topic && $descr == $descrNew && $cont == $contNew) {
        header("Location: ../Topics/topic.php?data=$topic");
        exit;
    }

    $existuje = getValuesFromDB($db, "SELECT Nazov FROM Topics where Nazov = ?", array($name => "s")
        , null, true)[0];

    if ($existuje > 0 && $name != $topic) {
        $error .= '<p>Category with this name already exists</p>';
    } else {
        if (strlen($name) < 1) {
            $error .= '<p>Name must have at least 1 character.</p>';
        }
        if (strlen($descrNew) < 1) {
            $error .= '<p>description must have at least 1 character.</p>';
        }
        if (strlen($contNew) < 1) {
            $error .= '<p>Content must have at least 1 character.</p>';
        }

        if (empty($error)) {
            $sql = "SELECT Categories.Nazov FROM Categories join Topics T on Categories.Id_categorie = T.Id_categorie where T.Nazov = ?";
            $category = getValuesFromDB($db, $sql, array($topic => "s"), 1, false)[0];

            if ($name != $topic && $descr != $descrNew && $cont != $contNew) {

                $sql = "UPDATE Topics set Nazov = ?,topic_Description = ?,topic_Obsah = ?  where Nazov = ?";
                updateData($db, $sql, array($name, $descrNew, $contNew, $topic), "ssss");
                header("Location: ../Topics/topic.php?data=$topic");
                exit;
            }
            if ($name != $topic) {
                $sql = "UPDATE Topics set Nazov = ? where Nazov = ?";
                updateData($db, $sql, array($name, $topic), "ss");
                header("Location: ../Topics/topic.php?data=$topic");
                exit;
            }
            if ($descr != $descrNew) {
                $sql = "UPDATE Topics set topic_Description = ? where Nazov = ?";
                updateData($db, $sql, array($descrNew, $topic), "ss");
                header("Location: ../Topics/topic.php?data=$topic");
                exit;

            }
            if ($cont != $contNew) {
                $sql = "UPDATE Topics set topic_Obsah = ? where Nazov = ?";
                updateData($db, $sql, array($contNew, $topic), "ss");
                header("Location: ../Topics/topic.php?data=$topic");
                exit;

            }
        }

    }
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