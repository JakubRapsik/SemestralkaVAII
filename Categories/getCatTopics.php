<?php
session_start();
include('../includes/config.php');
include "../includes/functions.php";
$autor = $_SESSION['username'];
$page = $_POST["page"];
$category = $_POST["category"];
$limit = $_POST['limit'];
$start_from = ($page - 1) * $limit;

$sql = "SELECT Id_categorie FROM Categories where Nazov = ?";
$categ = getValuesFromDB($db, $sql, array($category => "s"), 1, false)[0];

$sql = "SELECT * FROM Topics where Id_categorie = ?";
$pocet = getValuesFromDB($db, $sql, array($categ => "i"), 1, true)[0];

if ($category != "") {

    $sql = $db->prepare("SELECT Id_topicu,Nazov,topic_Description FROM Topics where Id_categorie = ? LIMIT ?, ?");
    $sql->bind_param("iii", $categ, $start_from, $limit);
} else {
    $sql = $db->prepare("SELECT Id_topicu,Nazov,topic_Description FROM Topics order by Cas desc LIMIT ?");
    $sql->bind_param("i", $limit);
}
$sql->execute();
$sql->store_result();
$sql->bind_result($idtopic, $nazov, $descr);

$sql2 = "SELECT permisie FROM Users where meno = ?";
$perm = getValuesFromDB($db, $sql2, array($autor => "s"), 1, false)[0];

?>
<?php
$i = 1;
while ($sql->fetch()) {

    $sql2 = "SELECT * FROM Posts where Id_topicu = ?";
    $rowcount = getValuesFromDB($db, $sql2, array($idtopic => "i"), null, true)[0];

    $sql2 = "SELECT Meno FROM Users join Topics T on Users.Id = T.id_user where Id_topicu = ?";
    $meno = getValuesFromDB($db, $sql2, array($idtopic => "i"), 1, false)[0];

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
                            <a href='../Topics/topic.php?data=$nazov'>
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>$nazov</a>
                                <div class="subCategoryTxt">$descr</div></div>
                                 <div class="forumCount">
                                 <div class="activityCreator">By: $meno</div>
                        <div class="countSetup">$rowcount
                    <span style="color: whitesmoke;">Posts</span>
                </div>
term;
    if ($autor == $meno || $perm > 0) {
        $html .= <<<term
                <div style="margin-left: 2.5vh;">
                    <a href="../Topics/edit-topic.php?topic=$nazov" style = "font-size: 15px" >Edit</a >
                </div>
term;
        if ($category != "") {
            $html .= <<<term
                <div style="margin-left: 2.5vh;">
                   <a onclick = 'deleteTopics("$category","$nazov",$page,"all",$pocet - 1)' style = "color: red; font-size: 15px" >Delete</a >
                </div >
term;
        } else {
            $html .= <<<term
                <div style="margin-left: 2.5vh;">
                   <a onclick = 'deleteTopics("$category","$nazov",$page,null, $pocet - 1)' style = "color: red; font-size: 15px" >Delete</a >
                </div >
term;
        }
    }
    $html .= '</div >
                </div >';
    echo $html;
}
?>