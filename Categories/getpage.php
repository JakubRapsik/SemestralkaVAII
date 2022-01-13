<?php

if (isset($_POST['page'])) {
    // Include pagination library file
    include_once 'Pagination.php';

    // Include database configuration file
    require_once 'includes/config.php';

    $baseURL = 'getpage.php';
    $offset = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = 8;

    $all = $db->query(" SELECT * FROM Topics join Categories C on C.Id_categorie = Topics.Id_categorie 
 where C.Nazov = 'Announcements'");
    $rowCount = mysqli_num_rows($all);

    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'currentPage' => $offset,
        'contentDiv' => 'dataContainer');
    $pagination = new Pagination($pagConfig);

    $all = $db->query(" SELECT * FROM Topics join Categories C on C.Id_categorie = Topics.Id_categorie 
 where C.Nazov = 'Announcements' limit $offset,$limit");
    ?>
    <div style="height: 200%" class="main-grid-layout box1Container">
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1"><?php echo $data ?></div>
        <div class="box1Text">
            <div>
                <?php
                while ($row1 = $all->fetch_row()) {
                    $offset++;
                    $sql = "SELECT * FROM Posts where Id_topicu = $row1[0]";
                    if ($result = mysqli_query($db, $sql)) {
                        $rowcount = mysqli_num_rows($result);
                    }
                    echo '
            <div class="forumContainerSpacing">
                <div class="categoryRow">
                    <a href="/Categories/categorie.php?data=' . $row1[2] . '">
                        <i class="fa fa-comment-o" aria-hidden="true" style="color: lightgray;margin-right: 3px">
                        </i>' . $row1[2] . '</a>
                    <div class="subCategoryTxt">' . $row1[4] . '</div>
                </div>
                <div class="forumCount">
                    <div class="countSetup">' . $rowcount . '
                        <span style="color: whitesmoke;">Posts</span>
                    </div>
                </div>
            </div>
            ';
                }
                ?>
            </div>
            <div style="align-self: center">
                <?php echo $pagination->createLinks(); ?>
            </div>
        </div>
    </div>
    <?php echo $pagination->createLinks(); ?>
    <?php
}

