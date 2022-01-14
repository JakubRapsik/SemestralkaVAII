<?php

if (isset($_GET["data"])) {
    $data = $_GET["data"];
}

if (empty($data)) {
    $all = 'all';
    header("Location: ../menu.php?data=$all");
}

?>


<!DOCTYPE html>
<html lang="">
<head>
    <!-- jQuery -->
    <link rel="stylesheet" type="text/css" href="../Styles.css"/>
    <script type="text/javascript" charset="utf8"
            src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <title>Category</title>
</head>
<body>
<div class="main-grid-layout container">

    <?php include "../includes/mainMenu.php"; ?>

    <div style="height: 100%" class="main-grid-layout box1Container">
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1"><?php echo $data ?></div>
        <div class="box1Text" id="vysledok">loading...</div>
        <?php
        include('../includes/config.php');

        $request = $db->prepare("SELECT Id_categorie FROM Categories where Nazov = ?");
        $request->bind_param("s", $data);
        $request->execute();
        $request->store_result();
        $request->bind_result($categ);
        $request->fetch();

        $limit = 6;

        $request2 = $db->prepare("SELECT * FROM Topics where Id_categorie = ?");
        $request2->bind_param("i", $categ);
        $request2->execute();
        $request2->store_result();
        $request2->fetch();
        $total_records = $request2->num_rows;

        $sql = $db->query("SELECT * FROM Topics where Id_categorie = $categ");
        $total_records = mysqli_num_rows($sql);
        $total_pages = ceil($total_records / $limit);
        ?>
        <div style="text-align: center">
            <div class='pagination text-center' id="paging">
                <?php if (!empty($total_pages)):for ($i = 1; $i <= $total_pages; $i++):
                    if ($i == 1):?>
                        <li style="display:inline-block" class="aktualna" id="<?php echo $i; ?>"><a
                                    href='getCatTopics.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                    <?php else: ?>
                        <li style="display:inline-block" id="<?php echo $i; ?>"><a
                                    href='getCatTopics.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor;endif; ?>
            </div>
        </div>
        <?php
        $user = $_SESSION['username'];
        if (isset($_SESSION['username'])) {
            echo '<div style="align-self: center">
                        <button style="width: auto;" name="submit" value="Submit"><a href="../Topics/add-topic.php">Add Topic</a></button>
                    </div>';
        }
        ?>
    </div>


    <!--Kontajner pre Sidebar-->
    <?php include "../includes/sidebar.php"; ?>

    <!--Reklamy-->
    <?php include "../includes/reklama.php"; ?>

    <div class="design footer">Footer</div>

</div>
</body>
<script>
    jQuery(document).ready(function () {
        let data = "<?php echo "$data"?>"
        jQuery("#vysledok").load("getCatTopics.php?page=1&data=" + data);
        jQuery("#paging li").live('click', function (e) {
            e.preventDefault();
            jQuery("#vysledok").html('loading...');
            jQuery("#paging li").removeClass('aktualna');
            jQuery(this).addClass('aktualna');
            let pageNum = this.id;
            jQuery("#vysledok").load("getCatTopics.php?page=" + pageNum + "&data=" + data);
        });
    });
</script>