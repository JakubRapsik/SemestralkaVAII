<?php
include "../includes/config.php";
include "../includes/functions.php";

$topic = $_POST['topic'];
$limit = 2;

$sql2 = "SELECT * FROM Posts join Topics T on T.Id_categorie = Posts.Id_categorie and T.Id_topicu = Posts.Id_topicu
where T.Nazov = ?";
$total_records = getValuesFromDB($db, $sql2, array($topic => "s"), null, true)[0];

$total_pages = ceil($total_records / $limit);

$html = "";

if (!empty($total_pages)):
    for ($i = 1; $i <= $total_pages; $i++):
        $html .= <<<term
            <li style='display:inline-block' class='aktualna' id='$i'>
                <a onclick='getPosts("$topic",$i,2)'>$i</a>
            </li>
term;
    endfor;
endif;
echo $html;