<?php
include('../includes/config.php');

$limit = 5;
$page = $_GET["page"] ?? 1;;
$start_from = ($page - 1) * $limit;

$sql = $db->query("SELECT * FROM Topics LIMIT $start_from, $limit");
?>
<body>
<?php
while ($row = $sql->fetch_row()) {
    $sql2 = "SELECT * FROM Posts where Id_topicu = $row[0]";
    if ($result2 = mysqli_query($db, $sql2)) {
        $rowcount = mysqli_num_rows($result2);
    }
    echo '<div class="forumContainerSpacing">
                            <div class="categoryRow">
                            <a href="/Categories/categorie.php?data=' . $row[2] . '& data2=' . $rowcount . '">
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>' . $row[2] . '</a>
                                <div class="subCategoryTxt">' . $row[4] . '</div></div>
                                 <div class="forumCount">
                        <div class="countSetup">' . $rowcount . '
                    <span style="color: whitesmoke;">Posts</span>
                </div>           
                </div>
                </div>';
}
?>
</body>