<?php
require_once "../includes/config.php";
include_once '../Pagination.php';


$baseURL = 'getpage.php';
$limit = 8;

if (isset($_GET["data"])) {
    $data = $_GET["data"];
    $data2 = $_GET["data2"];
}

if (!(isset($_GET['pageno']))) {
    $pageno = 1;
} else {
    $pageno = intval($_GET['pageno']);
}
if (empty($data) && $pageno < 0) {
    header("Location: ../menu.php");
}
$cnt = $data2;
$pagConfig = array(
    'baseURL' => $baseURL,
    'totalRows' => $cnt,
    'perPage' => $limit,
    'contentDiv' => 'dataContainer');
$pagination = new Pagination($pagConfig);

$all = $db->query(" SELECT * FROM Topics join Categories C on C.Id_categorie = Topics.Id_categorie 
 where C.Nazov = '$data' limit $limit")


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
    <div style="height: 200%" class="main-grid-layout box1Container">
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1"><?php echo $data ?></div>
        <div class="box1Text">
            <div>
                <?php
                $i = 0;
                while ($row1 = $all->fetch_row()) {
                    $i++;
                    $sql = "SELECT * FROM Posts where Id_topicu = $row1[0]";
                    if ($result = mysqli_query($db, $sql)) {
                        $rowcount = mysqli_num_rows($result);
                    }
                    echo '
            <div class="forumContainerSpacing">
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
            </div>
            ';
                }
                ?>
            </div>
            <div style="align-self: center">
                <?php echo $pagination->createLinks(); ?>
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


