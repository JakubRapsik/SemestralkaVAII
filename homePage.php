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

    <!--Kontajner pre Fav.Categorie-->
    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px" class="nameOfBox1">Favourite Category's</div>
        <div class="box1Text">
            <div>
                <div class="forumContainerSpacing">
                    <div class="categoryRow">
                        <a href="https://google.sk"><i class="fa fa-comment-o" aria-hidden="true"
                                                       style="color: lightgray;margin-right: 3px">

                            </i>Announcements</a>
                        <div class="subCategoryTxt">Announcements about stuff...</div>
                    </div>
                    <div class="forumCount">
                        <div class="countSetup">20
                            <span style="color: whitesmoke;">Topics</span>
                        </div>
                        <div class="countSetup">180
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="forumContainerSpacing">
                    <div class="categoryRow">
                        <a href="https://google.sk"><i class="fa fa-comment-o" aria-hidden="true"
                                                       style="color: lightgray;margin-right: 3px">

                            </i>Questions</a>
                        <div class="subCategoryTxt">Answers to frequent questions</div>
                    </div>
                    <div class="forumCount">
                        <div class="countSetup">11
                            <span style="color: whitesmoke;">Topics</span>
                        </div>
                        <div class="countSetup">98
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="forumContainerSpacing">
                    <div class="categoryRow">
                        <a href="https://google.sk"><i class="fa fa-comment-o" aria-hidden="true"
                                                       style="color: lightgray;margin-right: 3px"></i>
                            Game Events</a>
                        <div class="subCategoryTxt">Announcements about game events</div>
                    </div>
                    <div class="forumCount">
                        <div class="countSetup">3
                            <span style="color: whitesmoke;">Topics</span>
                        </div>
                        <div class="countSetup">40
                            <span style="color: whitesmoke;">Posts</span>
                        </div>
                    </div>
                </div>
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