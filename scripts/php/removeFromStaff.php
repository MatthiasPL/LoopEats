<?php
include('DataBase.php');
session_start();

if(isset($_SESSION['login']) && isset($_POST['staff_id'])){
    $db = new DataBase();
    $db->removeUser($_POST['staff_id']);
    $db->close();
}