<?php /** @noinspection ALL */
session_start();
include('../includes/config.php');
$autor = $_SESSION['username'];
$page = $_POST["page"];
$category = $_POST["category"];
$limit = $_POST['limit'];
$start_from = ($page - 1) * $limit;


if ($category != "") {
    $request = $db->prepare("SELECT Id_categorie FROM Categories where Nazov = ?");
    $request->bind_param("s", $category);
    $request->execute();
    $request->store_result();
    $request->bind_result($categ);
    $request->fetch();

    $sql = $db->query("SELECT * FROM Topics where Id_categorie = $categ LIMIT $start_from, $limit");
} else {
    $sql = $db->query("SELECT * FROM Topics Order By Cas desc LIMIT $limit");
}

$permisie = $db->prepare("SELECT permisie FROM Users where meno = ?");
$permisie->bind_param("s", $autor);
$permisie->execute();
$permisie->store_result();
$permisie->bind_result($perm);
$permisie->fetch();

?>
<?php
$i = 1;
while ($row = $sql->fetch_row()) {
    $request2 = $db->prepare("SELECT * FROM Posts where Id_topicu = ?");
    $request2->bind_param("i", $row[0]);
    $request2->execute();
    $request2->store_result();
    $request2->fetch();
    $rowcount = $request2->num_rows;

    $request3 = $db->prepare("SELECT Meno FROM Users join Topics T on Users.Id = T.id_user where Id_topicu = ?");
    $request3->bind_param("i", $row[0]);
    $request3->execute();
    $request3->store_result();
    $request3->bind_result($meno);
    $request3->fetch();

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
                                 <div class="forumCount" id="side">
                                 <div class="activityCreator">By: $meno</div>
                        <div class="countSetup">$rowcount
                    <span style="color: whitesmoke;">Posts</span>
                </div>
term;
    if ($autor == $meno || $perm > 0) {
        $html .= <<<term
                <div style="text-align: center">
                    <a onclick = '' href = "#" style = "font-size: 15px" >Edit</a >
                </div>
term;
        if ($category != "") {
            $html .= <<<term
                <div style = "text-align: center" >
                   <a onclick = 'deleteTopics("$category","$row[2]",$page,"all")' style = "color: red; font-size: 15px" >Delete</a >
                </div >
term;
        } else {
            $html .= <<<term
                <div style = "text-align: center" >
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