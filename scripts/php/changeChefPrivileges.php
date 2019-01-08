<?php
include('DataBase.php');
session_start();

if(isset($_SESSION['login']) && isset($_POST['login'])){
    $db = new DataBase();

    if($db->checkChefPrivileges($_POST['login'])){
        echo 'revoke';
        $db->revokeChefPrivileges($_POST['login']);
    }
    else{
        echo 'grant';
        $db->grantChefPrivileges($_POST['login']);
    }
    $db->close();
}