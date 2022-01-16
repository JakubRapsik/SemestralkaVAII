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

$stmt = $db->prepare("DELETE FROM Posts WHERE Id_postu = ?");
$stmt->bind_param('i', $remove);
$stmt->execute();