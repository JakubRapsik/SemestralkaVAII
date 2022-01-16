<?php
include('../includes/config.php');


$limit = 5;
$pocetCat = $db->prepare("SELECT * FROM Categories");
$pocetCat->execute();
$pocetCat->store_result();
$pocetCat->fetch();
$total_records = $pocetCat->num_rows;

$total_pages = ceil($total_records / $limit);

$html = "";

if (!empty($total_pages)):
    for ($i = 1; $i <= $total_pages; $i++):
        $html .= <<<term
            <div style='display:inline-block' class='aktualna' id='$i'>
                <a onclick='getCategory("all",$i)'>$i</a>
            </div>
term;
    endfor;
endif;
echo $html;
