<?php
include('DataBase.php');
session_start();

if(isset($_POST['name'])){
    $db = new DataBase();
    $sql = "SELECT * FROM `dishes` WHERE `name` LIKE `%{$_POST['dish_name']}%`";
    $db->printOrderMenu($sql);
    $db->close();
}
