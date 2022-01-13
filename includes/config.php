<?php

$servername = "semestralka-webserver-DB-1";
$username = "root";
$password = "password";
$dbname = "myDB";
global $db;
//Vytvorenie pripojenia
$db = new mysqli($servername, $username, $password, $dbname);
// Kontrola prepojenia
if ($db->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
