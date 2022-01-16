<?php

require_once "../includes/config.php";
include "../includes/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['Name'], "");
    $name = str_replace(' ', '', $name);
    $descr = ($_POST['Description']);

    if ($findName = $db->prepare("SELECT * FROM Categories WHERE Nazov = ?")) {
        $findName->bind_param('s', $name);
        $findName->execute();
        $findName->store_result();
        if ($findName->num_rows > 0) {
            $error .= '<p>Category with this name already exists</p>';
        } else {
            if (empty($name)) {
                $error .= '<p>Name must have at least 1 character.</p>';
            }
            if (empty($descr)) {
                $error .= '<p>Please enter your description.</p>';
            }
            if (empty($error)) {
                $sql = "SELECT max(Id_categorie) FROM Categories";
                $maxid = getValuesFromDB($db, $sql, null, 1, false)[0];
                $maxid++;

                $datetime = date("Y-m-d H:i:s", time());
                $vlozenieDB = $db->prepare("INSERT INTO Categories (Id_categorie, Nazov, Cas,cat_Description) 
                VALUES (?, ?, ?,?);");
                $vlozenieDB->bind_param("isss", $maxid, $name, $datetime, $descr);
                $vysledok = $vlozenieDB->execute();
                if ($vysledok) {
                    $error .= '<p>Category was added successfully</p>';
                    header("location: ../menu.php?data=all");
                    exit;
                } else {
                    $error .= '<p>Something went wrong!</p>';
                }
            }
        }
    }
    $findName->close();
    mysqli_close($db);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
</head>
<body>
<div class="main-grid-layout container">

    <!--Kontajner pre Header a SearchBar-->
    <?php include "../includes/mainMenu.php"; ?>

    <div class="main-grid-layout box1Container">
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1">Create new category</div>
        <?php echo $error; ?>
        <div class="box1Text">
            <div class="fillWindows">
                <form action="#" method="post">
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <input type="text" name="Name" placeholder="Name" required
                                   style="margin-top: 1%; text-align: center;">
                        </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Description" rows="5" cols="40" maxlength="255"
                                      id="descr"
                                      placeholder="Description" required></textarea>
                        </label>
                    </div>
                    <div style="text-align: center">
                        <button type="submit" name="submit" value="Submit">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <?php include "../includes/sidebar.php"; ?>

    <?php include "../includes/reklama.php"; ?>

    <div class="design footer">Footer</div>

</div>

</body>
</html>