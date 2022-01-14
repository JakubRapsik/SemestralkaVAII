<?php

if (isset($_GET["data"])) {
    $data = $_GET["data"];
    $remove = $_GET["remove"];
}

include "../includes/config.php";

$stmt = $db->prepare('DELETE FROM Topics WHERE Nazov = ?');
$stmt->bind_param('s', $remove);
$stmt->execute();


