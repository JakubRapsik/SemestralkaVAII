<?php
require_once "../includes/config.php";
include "../includes/functions.php";
session_start();
$topic = $_GET['topic'];
$user = $_SESSION['username'];