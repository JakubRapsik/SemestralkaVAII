<?php
include "../includes/config.php";

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../User/login.php");
    exit;
}


if (isset($_POST["remove"])) {
    $remove = $_POST["remove"];
}

$stmt = $db->prepare('DELETE FROM Categories WHERE Nazov = ?');
$stmt->bind_param('s', $remove);
$stmt->execute();
