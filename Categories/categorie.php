<?php
session_start();
$user = $_SESSION['username'];
if (!isset($_SESSION['username'])) {
    header("Location: ../User/login.php");
}

if (isset($_GET["data"])) {
    $data = $_GET["data"];
}

if (empty($data)) {
    $all = 'all';
    header("Location: ../menu.php?data=$all");
}

?>


<!DOCTYPE html>
<html lang="">
<head>
    <!-- jQuery -->
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <script type="text/javascript" charset="utf8"
            src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script src="/Scripts/ajax.js"></script>
    <title>Category</title>
</head>
<body>
<div class="main-grid-layout container">

    <?php include "../includes/mainMenu.php"; ?>

    <div style="height: 100%" class="main-grid-layout box1Container">
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1"><?php echo $data ?></div>
        <div class="box1Text" id="vysledok">loading...</div>
        <?php
        include('../includes/config.php');

        $request = $db->prepare("SELECT Id_categorie FROM Categories where Nazov = ?");
        $request->bind_param("s", $data);
        $request->execute();
        $request->store_result();
        $request->bind_result($categ);
        $request->fetch();
        ?>
        <div style="text-align: center">
            <div class='pagination text-center' id="paging">

            </div>
        </div>
        <?php
        $user = $_SESSION['username'];
        if (isset($_SESSION['username'])) {
            echo '<div style="align-self: center">
                        <button style="width: auto;" name="submit" value="Submit"><a href="../Topics/add-topic.php">Add Topic</a></button>
                    </div>';
        }
        ?>
    </div>


    <!--Kontajner pre Sidebar-->
    <?php include "../includes/sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "../includes/reklama.php"; ?>

    <div class="design footer">Footer</div>

</div>
<script>
    getTopic('<?php echo $data ?>', 1, 5);
    getTopicPageCount('<?php echo $data ?>');
</script>
</body>