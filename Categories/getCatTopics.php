<?php

include('../includes/config.php');

$limit = 6;
$page = $_GET["page"] ?? 1;;
$data = $_GET["data"];
$start_from = ($page - 1) * $limit;

$request = $db->prepare("SELECT Id_categorie FROM Categories where Nazov = ?");
$request->bind_param("s", $data);
$request->execute();
$request->store_result();
$request->bind_result($categ);
$request->fetch();

$sql = $db->query("SELECT * FROM Topics where Id_categorie = $categ LIMIT $start_from, $limit");
?>
<body>
<?php
$i = 1;
while ($row = $sql->fetch_row()) {
    $request2 = $db->prepare("SELECT * FROM Posts where Id_topicu = ?");
    $request2->bind_param("i", $row[0]);
    $request2->execute();
    $request2->store_result();
    $request2->fetch();
    $rowcount = $request2->num_rows;

    echo '<div class="forumContainerSpacing">
                            <div class="categoryRow">
                            <a href="../Topics/topic.php?data=' . $row[2] . '">
                            <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                                </i>' . $row[2] . '</a>
                                <div class="subCategoryTxt">' . $row[4] . '</div></div>
                                 <div class="forumCount" id="side">
                        <div class="countSetup">' . $rowcount . '
                    <span style="color: whitesmoke;">Posts</span>
                </div>      
                <div style="text-align: right">
                   <a onclick=removedata("' . $data . '","' . $row[2] . '") href="#" style="color: red;">Delete</a>
                </div> 
                </div>
                </div>';
}
?>
</body>
<script>
    function removedata(data, remove) {
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
        };
        xhttp.open("GET", "../Topics/remove-topic.php?data=" + data + "&remove=" + remove, true);
        xhttp.send();

    }
</script>