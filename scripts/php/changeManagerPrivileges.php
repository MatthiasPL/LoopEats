<?php
include('DataBase.php');
session_start();

if(isset($_SESSION['login']) && isset($_POST['login'])){
    $db = new DataBase();

    if($db->checkManagerPrivileges($_POST['login'])){
        $db->revokeManagerPrivileges($_POST['login']);
    }
    else{
        $db->grantManagerPrivileges($_POST['login']);
    }
    $db->close();
}