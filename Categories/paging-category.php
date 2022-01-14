<?php
include('../includes/config.php');

$categ = $_POST['category'];
$limit = 5;
$pocet = $db->prepare("SELECT * FROM Topics 
    join Categories C on C.Id_categorie = Topics.Id_categorie 
        where C.Nazov = ?");
$pocet->bind_param("s", $categ);
$pocet->execute();
$pocet->store_result();
$pocet->fetch();
$total_records = $pocet->num_rows;

$total_pages = ceil($total_records / $limit);

$html = "";

if (!empty($total_pages)):
    for ($i = 1; $i <= $total_pages; $i++):
        $html .= <<<term
            <li style='display:inline-block' class='aktualna' id='$i'>
                <a onclick='getTopic("$categ",$i)'>$i</a>
            </li>
term;
    endfor;
endif;
echo $html;
