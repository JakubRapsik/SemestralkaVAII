<?php
include "../includes/config.php";
include "../includes/functions.php";

$categ = $_POST['category'];
$limit = 5;

$sql = "SELECT * FROM Topics 
    join Categories C on C.Id_categorie = Topics.Id_categorie 
        where C.Nazov = ?";
$total_records = getValuesFromDB($db, $sql, array($categ => "s"), null, true)[0];

$total_pages = ceil($total_records / $limit);

$html = "";

if (!empty($total_pages)):
    for ($i = 1; $i <= $total_pages; $i++):
        $html .= <<<term
            <div style='display:inline-block' class='aktualna' id='$i'>
                <a onclick='getTopic("$categ",$i,5)'>$i</a>
            </div>
term;
    endfor;
endif;
echo $html;
