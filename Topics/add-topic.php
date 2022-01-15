<?php

require_once "../includes/config.php";
include "../includes/functions.php";
session_start();
$category = $_GET['category'];
$autor = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['Name'], "");
    $name = str_replace(' ', '', $name);
    $descr = ($_POST['Description']);
    $cont = ($_POST['Obsah']);

    if ($findName = $db->prepare("SELECT * FROM Topics WHERE Nazov = ?")) {
        $findName->bind_param('s', $name);
        $findName->execute();
        $findName->store_result();
        if ($findName->num_rows > 0) {
            $error .= '<p>Topic with this name already exists</p>';
        } else {
            if (empty($name)) {
                $error .= '<p>Name must have atleast 1 character.</p>';
            }
            if (empty($descr)) {
                $error .= '<p>Please enter your description.</p>';
            }
            if (empty($cont)) {
                $error .= '<p>Please enter your Content.</p>';
            }
            if (empty($error)) {
                $maxid = getValuesFromDB($db, "SELECT max(Id_topicu) FROM Topics", null, 1)[0];
                $maxid++;

                $sql = "SELECT Id_categorie FROM Categories where Nazov = ?";
                $catid = getValuesFromDB($db, $sql, array($category => "s"), 1)[0];

                $user = getValuesFromDB($db, "SELECT id FROM Users where meno = ?", array($autor => "s"), 1)[0];

                $datetime = date("Y-m-d H:i:s", time());
                $vlozenieDB = $db->prepare("INSERT INTO Topics 
                (Id_topicu, Cas, Nazov,Id_categorie,topic_Description,topic_Obsah,id_user) 
                VALUES (?, ?, ?,?,?,?,?);");
                $vlozenieDB->bind_param("ississi", $maxid, $datetime, $name, $catid, $descr, $cont, $user);
                $vysledok = $vlozenieDB->execute();
                if ($vysledok) {
                    $error .= '<p>Category was added successfully</p>';
                    header("location: ../Categories/categorie.php?data=$category");
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
                                   style="margin-top: 1%; text-align: center">
                        </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Description" rows="5" cols="40" maxlength="255"
                                      id="descr"
                                      placeholder="Description" required></textarea>
                        </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Obsah" rows="5" cols="40" maxlength="500"
                                      id="obsah"
                                      placeholder="Content" required></textarea>
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