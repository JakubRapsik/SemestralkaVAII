<?php
include "../includes/config.php";


if (isset($_POST["remove"])) {
    $remove = $_POST["remove"];
}

echo $remove;

$stmt = $db->prepare('DELETE FROM Categories WHERE Nazov = ?');
$stmt->bind_param('s', $remove);
$stmt->execute();
