<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "includes/mainMenu.php"; ?>

    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px" class="nameOfBox1">All categories</div>
        <div class="box1Text">
            <div>
                <?php include "Categories/favCategory.php" ?>
            </div>
        </div>
        <?php
        include "includes/config.php";
        $user = $_SESSION['username'];
        $poziadavka = $db->prepare('SELECT permisie FROM Users where meno = ?');
        $poziadavka->bind_param('s', $user);
        $poziadavka->execute();
        $poziadavka->store_result();
        $poziadavka->bind_result($perm);
        $poziadavka->fetch();

        if (isset($_SESSION['username']) && $perm > 0) {
            echo '<div>
                        <button style="width: auto" name="submit" value="Submit"><a href="/Categories/add-category.php">Add Category</a></button>
                    </div>';
        }
        ?>
    </div>


    <?php include "includes/sidebar.php"; ?>

    <?php include "includes/reklama.php"; ?>

    <div class="design footer">Footer</div>

</div>

</body>
</html>