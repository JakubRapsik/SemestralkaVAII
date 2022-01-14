<?php
include('../includes/config.php');

$categ = $_POST['category'];
$limit = 5;
$request = $db->prepare("SELECT * FROM Topics 
    join Categories C on C.Id_categorie = Topics.Id_categorie 
        where C.Nazov = ?");
$request->bind_param("i", $categ);
$request->execute();
$request->store_result();
$request->fetch();
$total_records = $request->num_rows;

//$sql = $db->query("SELECT * FROM Topics where Id_categorie = $categ");
//$total_records = mysqli_num_rows($sql);
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
