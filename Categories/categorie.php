<?php
if (isset($_GET["data"])) {
    $data = $_GET["data"];

}
if (empty($data)) {
    header("Location: ../menu.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <!--Kontajner vsetkych topicov v kategorii-->
    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px" class="nameOfBox1">Favourite Category's</div>
        <div class="box1Text">
            <div>
                <?php
                require_once "../includes/config.php";
                $all = $db->query("SELECT * from Topics JOIN Categories C on Topics.Id_categorie = C.Id_categorie
                where C.Id_categorie = Topics.Id_categorie AND C.Nazov = '$data'");
                while ($row1 = $all->fetch_row()) {
                    $sql = "SELECT * FROM Posts where Id_topicu = $row1[0]";
                    if ($result = mysqli_query($db, $sql)) {
                        $rowcount = mysqli_num_rows($result);
                    }
                    echo '<div class="forumContainerSpacing">
                            <div class="categoryRow">
                                <a href="/Categories/categorie.php?data=' . $row1[2] . '">
                                <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>' . $row1[2] . '</a>
                                <div class="subCategoryTxt">' . $row1[4] . '</div>
                            </div>
                            <div class="forumCount">
                                <div class="countSetup">' . $rowcount . '
                                    <span style="color: whitesmoke;">Posts</span>
                                </div>           
                            </div>
                            
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>


    <!--Kontajner pre Sidebar-->
    <?php include "../includes/sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "../includes/reklama.php"; ?>

    <div class="design footer">Footer</div>
</div>
</body>


