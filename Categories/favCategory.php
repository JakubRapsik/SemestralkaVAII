<?php
include "includes/config.php";

if (isset($_GET["data"])) {
    $data = $_GET["data"];
}
if (empty($data)) {
    $fav = $db->query("SELECT * from Categories where Categories.Id_categorie>0 order by Id_categorie limit 3");
} else {
    $fav = $db->query("SELECT * from Categories where Categories.Id_categorie>0 order by Id_categorie");
}
while ($row1 = $fav->fetch_row()) {

    $request = $db->prepare("SELECT Id_topicu FROM Topics where Id_categorie = ?");
    $request->bind_param("i", $row1[0]);
    $request->execute();
    $request->store_result();
    $request->fetch();
    $rowcount = $request->num_rows;

    $request2 = $db->prepare("SELECT * FROM Posts where Id_categorie = ?");
    $request2->bind_param("i", $row1[0]);
    $request2->execute();
    $request2->store_result();
    $request2->fetch();
    $rowcount2 = $request2->num_rows;

    echo '<div class="forumContainerSpacing">
                            <div class="categoryRow">
                            <a href="/Categories/categorie.php?data=' . $row1[1] . '& data2=' . $rowcount . '">
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>' . $row1[1] . '</a>
                                <div class="subCategoryTxt">' . $row1[3] . '</div></div>
                                 <div class="forumCount">
                                    <div class="countSetup">' . $rowcount . '
                    <span style="color: whitesmoke;">Topics</span>
                </div>
                        <div class="countSetup">' . $rowcount2 . '
                    <span style="color: whitesmoke;">Posts</span>
                </div>           
                </div>
                </div>';
}