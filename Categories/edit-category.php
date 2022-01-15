<?php

require_once "../includes/config.php";
include "../includes/functions.php";

if (isset($_GET["category"])) {
    $category = $_GET["category"];
} else {
    header("Location: ../menu.php?data=all");
}
$sql = "SELECT cat_Description FROM Categories where Nazov = ?";
$descr = getValuesFromDB($db, $sql, array($category => "s"), 1, false)[0];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['Name'], "");
    $name = str_replace(' ', '', $name);
    $descrNew = ($_POST['Description']);

    if ($name == $category && $descr == $descrNew) {
        header("Location: ../Categories/edit-category.php?category=$category");
    }

    $sql = "SELECT Nazov FROM Categories where Nazov = ?";
    $kontrola = getValuesFromDB($db, $sql, array($name => "s"), null, true)[0];

    if ($kontrola > 0) {
        $error .= '<p>Category with this name already exists</p>';
    } else {
        if (strlen($name) < 1) {
            $error .= '<p>Name must have at least 1 character.</p>';
        }
        if (strlen($descrNew) < 1) {
            $error .= '<p>description must have at least 1 character.</p>';
        }

        if (empty($error)) {
            $sql = "SELECT Id_categorie FROM Categories where Nazov = ?";
            $id = getValuesFromDB($db, $sql, array($category => "s"), 1, false)[0];

            if ($name != $category && $descr != $descrNew) {
                $request = $db->prepare("UPDATE Categories set Nazov = ?,cat_Description = ? where Id_categorie = ?");
                $request->bind_param("ssi", $name, $descrNew, $id);
                $request->execute();
                header("Location: ../menu.php?data=all");
            }
        }

    }


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
    <title>edit-Category</title>
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
                            <input value="<?php echo $category ?>" type="text" name="Name" placeholder="Name" required
                                   style="margin-top: 1%; text-align: center;">
                        </label>
                    </div>
                    <div class="fillWindows" style="text-align: center;">
                        <label>
                            <textarea class="textarea" name="Description" rows="5" cols="40" maxlength="255"
                                      id="descr"
                                      placeholder="Description" required><?php echo $descr ?></textarea>
                        </label>
                    </div>
                    <div style="text-align: center">
                        <button type="submit" name="submit" value="Submit">Edit</button>
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