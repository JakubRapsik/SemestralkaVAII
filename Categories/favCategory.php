<?php
session_start();
$user = $_SESSION['username'];
if (isset($_POST["data"])) {
    $data = $_POST["data"];
    $page = $_POST["page"];
}
include "../includes/config.php";
include "../includes/functions.php";
$limit = 5;
$start_from = ($page - 1) * $limit;

if ($data == "") {

    $fav = $db->prepare("SELECT Id_categorie,Nazov,cat_Description from Categories 
    where Categories.Id_categorie>0 order by Id_categorie limit 3");
} else {

    $fav = $db->prepare("SELECT Id_categorie,Nazov,cat_Description from Categories 
    where Categories.Id_categorie>0 order by Id_categorie LIMIT ?, ?");
    $fav->bind_param("ii", $start_from, $limit);
}
$fav->execute();
$fav->store_result();
$fav->bind_result($catid, $nazov, $descr);

$sql = "SELECT * FROM Categories";
$pocet = getValuesFromDB($db, $sql, null, null, true)[0];


$sql = "SELECT permisie FROM Users where meno = ?";
$perm = getValuesFromDB($db, $sql, array($user => "s"), 1, false)[0];
while ($fav->fetch()) {
    $sql = "SELECT Id_topicu FROM Topics where Id_categorie = ?";
    $rowcount = getValuesFromDB($db, $sql, array($catid => "i"), null, true)[0];

    $sql = "SELECT * FROM Posts where Id_categorie = ?";
    $rowcount2 = getValuesFromDB($db, $sql, array($catid => "i"), null, true)[0];

    if ($perm == 1) {
        $html = <<< term
        <div class="forumContainerSpacing" style="margin-top: 1%; margin-bottom: 0">
term;
    } else {
        $html = <<< term
        <div class="forumContainerSpacing">
term;
    }
    $html .= <<< term
                            <div class="categoryRow">
                            <a href="/Categories/categorie.php?data=$nazov">
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>$nazov</a>
                                <div class="subCategoryTxt">$descr</div></div>
                                 <div class="forumCount">
                                    <div class="countSetup">$rowcount
                    <span style="color: whitesmoke;">Topics</span>
                </div>
                        <div class="countSetup">$rowcount2
                    <span style="color: whitesmoke;">Posts</span>
                </div>
term;
    if ($perm == 1) {
        $html .= <<<term
                <div style="margin-left: 2.5vh;">
                    <a onclick = '' href = "../Categories/edit-category.php?category=$nazov" style = "font-size: 15px" > Edit</a >
                </div>
term;
        if ($data != "") {
            $html .= <<<term
                    <div style="margin-left: 2.5vh;">
                    <a onclick = 'deleteCategory("$nazov","all",$page,$pocet - 1)' style = "color: red; font-size: 15px" > Delete</a >
                </div>
term;
        } else {
            $html .= <<<term
                    <div style="margin-left: 2.5vh;">
                    <a onclick = 'deleteCategory("$nazov",null,$page,$pocet - 1)' style = "color: red; font-size: 15px" > Delete</a >
                </div>
term;
        }
    }
    $html .= '
                </div>
                </div>';
    echo $html;
}