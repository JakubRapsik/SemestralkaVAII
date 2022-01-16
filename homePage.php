<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script src="/Scripts/ajax.js"></script>
    <style>
        .mySlides {
            display: none;
        }
    </style>
    <title>homePage</title>
</head>
<body>
<div class="main-grid-layout container">


    <!--Kontajner pre Header a SearchBar-->
    <?php include "includes/mainMenu.php"; ?>


    <!--    Kontajner pre Fav.Categorie-->
    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px" class="nameOfBox1">Favourite Category's</div>
        <div class="box1Text" id="catvysledok">
        </div>
    </div>

    <!--Kontajner pre Aktivne Topicky-->
    <div class="main-grid-layout box2Container">
        <div class="nameOfBox2" style="padding-top: 10px">New Topic's</div>
        <div class="box2Text" id="vysledok">
        </div>
    </div>


    <!--Kontajner pre Sidebar-->
    <?php include "includes/sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "includes/reklama.php"; ?>

    <div class="design footer">Footer</div>
</div>
<script>
    getTopic(null, 1, 3);
    getCategory(null, 1);
</script>
</body>
</html>