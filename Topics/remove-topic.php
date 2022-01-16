<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../User/login.php");
    exit;
}

if (isset($_POST["category"])) {
    $data = $_POST["category"];
    $remove = $_POST["remove"];
}

include "../includes/config.php";

$stmt = $db->prepare('DELETE FROM Topics WHERE Nazov = ?');
$stmt->bind_param('s', $remove);
$stmt->execute();


