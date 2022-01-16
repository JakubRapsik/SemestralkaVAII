<?php
include('../includes/config.php');
include "../includes/functions.php";
session_start();
$page = $_POST['page'];
$topic = $_POST['topic'];
$autor = $_SESSION['username'];
$limit = 2;
$start_from = ($page - 1) * $limit;

$sql = $db->prepare("SELECT Posts.Id,Posts.Id_topicu,post_Obsah,Posts.Id_postu FROM Posts 
    join Topics T on T.Id_topicu = Posts.Id_topicu and T.Id_categorie = Posts.Id_categorie where T.Nazov = ? limit ?, ?");
$sql->bind_param("sii", $topic, $start_from, $limit);
$sql->execute();
$sql->store_result();
$sql->bind_result($iduser, $idtopic, $cont, $idPost);

$counter = 0;


$sql2 = "SELECT * FROM Posts where Id_topicu = ?";
$pocet = getValuesFromDB($db, $sql2, array($idtopic => "i"), 1, true)[0];

$sql2 = "SELECT permisie FROM Users where meno = ?";
$perm = getValuesFromDB($db, $sql2, array($autor => "s"), 1, false)[0];

while ($sql->fetch()) {
    if ($counter == 0) {
        $sql2 = "SELECT meno FROM Users where Id = ?";
        $meno = getValuesFromDB($db, $sql2, array($iduser => "i"), 1, false)[0];
    }
    $counter++;
    $html = <<<term
        <div class="forumContainerSpacing" style="margin-top: 1%; margin-bottom: 1%">
                    <label>
                        <textarea readonly class="textarea" style="width: 50vw;" name="Obsah" rows="5" cols="40" maxlength="500"
                                      id="obsah$idPost"
                                      placeholder="Content" required>$cont
                        </textarea>
                    </label>
                    <div class="forumCount">
                         <div class="activityCreator">By: $meno</div>
term;

    if ($autor == $meno || $perm > 0) {
        $html .= <<<term
                <div style="margin-left: 2.5vh;">
                    <a href="edit-post.php" style = "font-size: 15px" >Edit</a >
                </div>
term;
        $html .= <<<term
                <div style="margin-left: 2.5vh;">
                   <a onclick = 'deletePost($idPost,$page,$pocet - 1,"$topic")' style = "color: red; font-size: 15px" >Delete</a >
                </div >
term;
    }
    $html .= '</div >
                </div >';
    echo $html;
}