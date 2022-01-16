<?php
include "../includes/config.php";
include "../includes/functions.php";

$topic = $_POST['topic'];
$limit = 2;

$sql = "SELECT * FROM Posts join Topics T on T.Id_categorie = Posts.Id_categorie and T.Id_topicu = Posts.Id_topicu
where T.Nazov = ?";
$total_records = getValuesFromDB($db, $sql, array($topic => "s"), null, true)[0];

$total_pages = ceil($total_records / $limit);

$html = "";

if (!empty($total_pages)):
    for ($i = 1; $i <= $total_pages; $i++):
        $html .= <<<term
            <div style='display:inline-block' class='aktualna' id='$i'>
                <a onclick='getPosts("$topic",$i)'>$i</a>
            </div>
term;
    endfor;
endif;
echo $html;