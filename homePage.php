<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>homePage</title>
</head>
<body>
<div class="main-grid-layout container">


    <!--Kontajner pre Header a SearchBar-->
    <?php include "mainMenu.php"; ?>


    <!--    Kontajner pre Fav.Categorie-->
    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px" class="nameOfBox1">Favourite Category's</div>
        <div class="box1Text">
            <div>
                <?php
                require_once "config.php";
                $recom = $db->query("SELECT * from Categories where Categories.Id_categorie>0 order by Id_categorie ASC limit 3");
                while ($row1 = $recom->fetch_row()) {
                    $sql = "SELECT Id_topicu FROM Topics where Id_categorie = $row1[0]";
                    if ($result = mysqli_query($db, $sql)) {
                        $rowcount = mysqli_num_rows($result);
                    }
                    $sql2 = "SELECT * FROM Posts where Id_categorie = $row1[0]";
                    if ($result2 = mysqli_query($db, $sql2)) {
                        $rowcount2 = mysqli_num_rows($result2);
                    }
                    echo '<div class="forumContainerSpacing">
                            <div class="categoryRow">
                            <a href="/Categories/categorie.php?data=' . $row1[1] . '">
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
                ?>
            </div>
        </div>
    </div>

    <!--Kontajner pre Aktivne Topicky-->
    <div class="main-grid-layout box2Container">
        <div class="nameOfBox2" style="padding-top: 10px">Active Topic's</div>
        <div class="box2Text">
            <div>
                <div class="activityContainerSpacing">
                    <a href="https://google.sk"><i class="fa fa-comment-o" aria-hidden="true"
                                                   style="color: lightgray"></i>
                        Topic1</a>
                    <div class="forumCount">
                        <div class="activityCreator">By: Jakub Rapsik</div>
                        <div class="countSetup">729
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="activityContainerSpacing">
                    <a href="https://google.sk"><i class="fa fa-comment-o" aria-hidden="true"
                                                   style="color: lightgray"></i>
                        Topic2</a>
                    <div class="forumCount">
                        <div class="activityCreator">By: Jakub Rapsik</div>
                        <div class="countSetup">729
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="activityContainerSpacing">
                    <a href="https://google.sk"><i class="fa fa-comment-o" aria-hidden="true"
                                                   style="color: lightgray"></i>
                        Topic3</a>
                    <div class="forumCount">
                        <div class="activityCreator">By: Jakub Rapsik</div>
                        <div class="countSetup">729
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="activityContainerSpacing">
                    <a href="https://google.sk"><i class="fa fa-comment-o" aria-hidden="true"
                                                   style="color: lightgray"></i>
                        Topic4</a>
                    <div class="forumCount">
                        <div class="activityCreator">By: Jakub Rapsik</div>
                        <div class="countSetup">729
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Kontajner pre Sidebar-->
    <?php include "sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "reklama.php"; ?>

    <div class="design footer">Footer</div>
</div>
</body>
</html>