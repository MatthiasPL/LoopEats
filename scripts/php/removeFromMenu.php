<?php
include('DataBase.php');
session_start();

if(isset($_SESSION['login']) && isset($_POST['dish_id'])){
    $db = new DataBase();
    $db->removeDish($_POST['dish_id']);
    $db->close();
}