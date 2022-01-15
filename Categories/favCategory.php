<?php /** @noinspection ALL */
session_start();
if (isset($_POST["data"])) {
    $data = $_POST["data"];
    $page = $_POST["page"];
}
include "../includes/config.php";
$limit = 5;
$start_from = ($page - 1) * $limit;

if ($data == "") {
    $fav = $db->query("SELECT * from Categories where Categories.Id_categorie>0 order by Id_categorie limit 3");
} else {
    $fav = $db->query("SELECT * from Categories where Categories.Id_categorie>0 order by Id_categorie LIMIT $start_from, $limit");
}
while ($row1 = $fav->fetch_row()) {

    $request = $db->prepare("SELECT Id_topicu FROM Topics where Id_categorie = ?");
    $request->bind_param("i", $row1[0]);
    $request->execute();
    $request->store_result();
    $request->fetch();
    $rowcount = $request->num_rows;

    $user = $_SESSION['username'];
    $poziadavka = $db->prepare('SELECT permisie FROM Users where meno = ?');
    $poziadavka->bind_param('s', $user);
    $poziadavka->execute();
    $poziadavka->store_result();
    $poziadavka->bind_result($perm);
    $poziadavka->fetch();

    $request2 = $db->prepare("SELECT * FROM Posts where Id_categorie = ?");
    $request2->bind_param("i", $row1[0]);
    $request2->execute();
    $request2->store_result();
    $request2->fetch();
    $rowcount2 = $request2->num_rows;

    if ($perm == 1) {
        $html = <<< term
        <div class="forumContainerSpacing" style="margin-top: 1%; margin-bottom: 1%">
term;
    } else {
        $html = <<< term
        <div class="forumContainerSpacing">
term;
    }
    $html .= <<< term
                            <div class="categoryRow">
                            <a href="/Categories/categorie.php?data=$row1[1]&data2='all'">
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>$row1[1]</a>
                                <div class="subCategoryTxt">$row1[3]</div></div>
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
                <div style="text-align: center">
                    <a onclick = '' href = "#" style = "font-size: 15px" > Edit</a >
                </div>
term;
        if ($data != "") {
            $html .= <<<term
                    <div style="text-align: center">
                    <a onclick = 'deleteCategory("$row1[1]","all",$page)' style = "color: red; font-size: 15px" > Delete</a >
                </div>
term;
        } else {
            $html .= <<<term
                    <div style="text-align: center">
                    <a onclick = 'deleteCategory("$row1[1]",null,$page)' style = "color: red; font-size: 15px" > Delete</a >
                </div>
term;
        }
    }
    $html .= '
                </div>
                </div>';
    echo $html;
}