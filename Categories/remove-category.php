<?php

if (isset($_POST["category"])) {
    $remove = $_POST["remove"];
}

include "../includes/config.php";

$stmt = $db->prepare('DELETE FROM Topics WHERE Nazov = ?');
$stmt->bind_param('s', $remove);
$stmt->execute();
