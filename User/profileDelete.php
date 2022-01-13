<?php

require_once "../config.php";
session_start();
$email = $_SESSION['usermail'];
$poziadavka = $db->prepare("DELETE FROM Users WHERE email = ?");
$poziadavka->bind_param('s', $email);
$poziadavka->execute();
require_once "sighOut.php";


