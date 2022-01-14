<?php
include "includes/config.php";
$fav = $db->query("SELECT * from Topics where Id_topicu>0 order by Cas limit 4");
while ($row1 = $fav->fetch_row()) {

    $request = $db->prepare("SELECT * FROM Posts where Id_topicu = ?");
    $request->bind_param("i", $row1[0]);
    $request->execute();
    $request->store_result();
    $request->fetch();
    $rowcount = $request->num_rows;

    $request2 = $db->prepare("SELECT meno FROM Users where Id = ?");
    $request2->bind_param("s", $row1[6]);
    $request2->execute();
    $request2->store_result();
    $request2->bind_result($autor);
    $request2->fetch();

    echo '<div class="activityContainerSpacing">
                            <div class="categoryRow">
                            <a href="/Topics/topic.php?data=' . $row1[2] . '">
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>' . $row1[2] . '</a>
                                <div class="subCategoryTxt">' . $row1[4] . '</div></div>
                                 <div class="forumCount">
                        <div class="activityCreator">By: ' . $autor . '</div>
                        <div class="countSetup"> ' . $rowcount . '
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>';
}