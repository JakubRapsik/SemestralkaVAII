<?php

//Zacatie novej session
session_start();

//Kontrola ci je user uz prihlaseny
//if (isset($_SESSION['userid'])) {
//    echo $_SESSION['userid'];
////    session_destroy();
//    header("Location: homePage.php");
//    exit;
//}