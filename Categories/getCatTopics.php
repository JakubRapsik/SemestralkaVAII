<?php
session_start();
include('../includes/config.php');
include "../includes/functions.php";
$autor = $_SESSION['username'];
$page = $_POST["page"];
$category = $_POST["category"];
$limit = $_POST['limit'];
$start_from = ($page - 1) * $limit;


if ($category != "") {

    $sql = "SELECT Id_categorie FROM Categories where Nazov = ?";
    $categ = getValuesFromDB($db, $sql, array($category => "s"), 1, false)[0];

    $sql = $db->query("SELECT * FROM Topics where Id_categorie = $categ LIMIT $start_from, $limit");
} else {
    $sql = $db->query("SELECT * FROM Topics Order By Cas desc LIMIT $limit");
}

$sql2 = "SELECT permisie FROM Users where meno = ?";
$perm = getValuesFromDB($db, $sql2, array($autor => "s"), 1, false)[0];


?>
<?php
$i = 1;
while ($row = $sql->fetch_row()) {

    $sql2 = "SELECT * FROM Posts where Id_topicu = ?";
    $rowcount = getValuesFromDB($db, $sql2, array($row[0] => "i"), null, true)[0];

    $sql2 = "SELECT Meno FROM Users join Topics T on Users.Id = T.id_user where Id_topicu = ?";
    $meno = getValuesFromDB($db, $sql2, array($row[0] => "i"), 1, false)[0];

    if ($autor == $meno || $perm > 0) {
        $html = <<<term
        <div class="forumContainerSpacing" style="margin-top: 1%; margin-bottom: 1%">
term;
    } else {
        $html = <<<term
        <div class="forumContainerSpacing">
term;
    }
    $html .= <<<term
                            <div class="categoryRow">
                            <a href='../Topics/topic.php?data=$row[2]'>
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>$row[2]</a>
                                <div class="subCategoryTxt">$row[4]</div></div>
                                 <div class="forumCount">
                                 <div class="activityCreator">By: $meno</div>
                        <div class="countSetup">$rowcount
                    <span style="color: whitesmoke;">Posts</span>
                </div>
term;
    if ($autor == $meno || $perm > 0) {
        $html .= <<<term
                <div style="margin-left: 2.5vh;">
                    <a href="../Topics/edit-topic.php?topic=$row[2]" style = "font-size: 15px" >Edit</a >
                </div>
term;
        if ($category != "") {
            $html .= <<<term
                <div style="margin-left: 2.5vh;">
                   <a onclick = 'deleteTopics("$category","$row[2]",$page,"all")' style = "color: red; font-size: 15px" >Delete</a >
                </div >
term;
        } else {
            $html .= <<<term
                <div style="margin-left: 2.5vh;">
                   <a onclick = 'deleteTopics("$category","$row[2]",$page,null)' style = "color: red; font-size: 15px" >Delete</a >
                </div >
term;
        }
    }
    $html .= '</div >
                </div >';
    echo $html;
}
?>