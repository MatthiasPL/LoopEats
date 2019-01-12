<?php
include('DataBase.php');
session_start();

    $db = new DataBase();
    $sql = "SELECT * FROM `dishes`";
    $db->printOrderMenu($sql);
    $db->close();