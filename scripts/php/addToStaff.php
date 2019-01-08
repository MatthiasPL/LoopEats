<?php
include('DataBase.php');
session_start();

if(isset($_SESSION['login']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['ismanager']) && isset($_POST['ischef'])){
    $db = new DataBase();
    $db->addUser($_POST['login'], $_POST['password'], $_POST['name'], $_POST['surname'], $_POST['ismanager'], $_POST['ischef']);
    $db->close();
}