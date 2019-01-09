<?php
include('DataBase.php');
session_start();

if(isset($_SESSION['login'])){
    $db = new DataBase();
    $db->printAllCardsWithDishes();
    $db->close();
}