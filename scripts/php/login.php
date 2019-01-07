<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 07.01.2019
 * Time: 10:40
 */
session_start();
if(isset($_POST['login']) && isset($_POST['password'])){
    $db = new DataBase();
    if($db->checkPassword($_POST['login'], $_POST['password'])===TRUE){
        echo "tak";
    }
    else{
        echo "nie";
    }
}
echo "cos";