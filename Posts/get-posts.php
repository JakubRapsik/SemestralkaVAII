<?php
include('../includes/config.php');
include "../includes/functions.php";
session_start();
$page = $_POST['page'];
$topic = $_POST['topic'];
$autor = $_SESSION['username'];
$limit = 3;
$start_from = ($page - 1) * $limit;

$sql = $db->prepare("SELECT Posts.Id,Posts.Id_topicu,post_Obsah FROM Posts 
    join Topics T on T.Id_topicu = Posts.Id_topicu and T.Id_categorie = Posts.Id_categorie where T.Nazov = ?");
$sql->bind_param("s", $topic);
$sql->execute();
$sql->store_result();
$sql->bind_result($iduser, $idtopic, $cont);

$counter = 0;

$sql2 = "SELECT permisie FROM Users where meno = ?";
$perm = getValuesFromDB($db, $sql2, array($autor => "s"), 1, false)[0];

while ($sql->fetch()) {
    if ($counter == 0) {
        $sql2 = "SELECT meno FROM Users where Id = ?";
        $meno = getValuesFromDB($db, $sql2, array($iduser => "i"), 1, false)[0];
    }
    $counter++;
    if ($autor == $meno || $perm > 0) {
        $html = <<<term
        <div class="forumContainerSpacing" style="margin-top: 1%; margin-bottom: 1%">
term;
    } else {
        $html = <<<term
        <div class="forumContainerSpacing">
term;
    }
    if ($edit == false) {
        $html .= <<<term
                            <label>
                             <textarea readonly class="textarea" style="width: 50vw;" name="Obsah" rows="5" cols="40" maxlength="500"
                                      id="obsah"
                                      placeholder="Content" required>$cont</textarea>
                        </label>
                                 <div class="forumCount">
                                 <div class="activityCreator">By: $meno</div>
term;
    } else {
        $html .= <<<term
                            <label>
                             <textarea class="textarea" style="width: 50vw;" name="Obsah" rows="5" cols="40" maxlength="500"
                                      id="obsah"
                                      placeholder="Content" required>$cont</textarea>
                        </label>
                                 <div class="forumCount">
                                 <div class="activityCreator">By: $meno</div>
term;
    }
    if ($autor == $meno || $perm > 0) {
        $html .= <<<term
                <div style="margin-left: 2.5vh;">
                    <a href="edit-post.php" style = "font-size: 15px" >Edit</a >
                </div>
term;
        $html .= <<<term
                <div style="margin-left: 2.5vh;">
                   <a onclick = '' style = "color: red; font-size: 15px" >Delete</a >
                </div >
term;
    }
    $html .= '</div >
                </div >';
    echo $html;
}