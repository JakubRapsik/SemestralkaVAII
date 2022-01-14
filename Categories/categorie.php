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
        <div style="padding-top: 10px; text-align: center" class="nameOfBox1"></div>
        <div class="box1Text" id="target-content">loading...</div>


        <?php
        include('../includes/config.php');
        $limit = 5;
        $sql = $db->query("SELECT * FROM Topics");
        $total_records = mysqli_num_rows($sql);
        $total_pages = ceil($total_records / $limit);
        ?>
        <div style="text-align: center">
            <div class='pagination text-center' id="pagination">
                <?php if (!empty($total_pages)):for ($i = 1; $i <= $total_pages; $i++):
                    if ($i == 1):?>
                        <li style="display:inline-block" class='active' id="<?php echo $i; ?>"><a
                                    href='getData.php?page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
                    <?php else: ?>
                        <li style="display:inline-block" id="<?php echo $i; ?>"><a
                                    href='getData.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor;endif; ?>
            </div>
        </div>
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
        jQuery("#target-content").load("getData.php?page=1");
        jQuery("#pagination li").live('click', function (e) {
            e.preventDefault();
            jQuery("#target-content").html('loading...');
            jQuery("#pagination li").removeClass('active');
            jQuery(this).addClass('active');
            let data = "<?php echo "$data"?>"
            let pageNum = this.id;
            jQuery("#target-content").load("getData.php?page=" + pageNum + "&data=" + data);
        });
    });
</script>