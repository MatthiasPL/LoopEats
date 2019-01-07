<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 07.01.2019
 * Time: 09:33
 */

class DataBase
{
    private $username = "hpgrouph_bazuka";
    private $password = "5CKhm2L88";
    private $servername = "localhost";
    private $dbname = "hpgrouph_bazka";

    private $link;

    function DataBase(){
        $this->link = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    function close(){
        $this->link->close();
    }

    function addUser($login, $password, $name, $surname, $is_manager, $is_chef){
        $sql = "INSERT INTO `staff` (`staff_id`, `login`, `password`, `name`, `surname`, `manager`, `chef`) VALUES (null, '$login', '$password', '$name', '$surname', '$is_manager', '$is_manager')";
        $this->link->query($sql);
    }

    function removeUser($login){
        $sql = "DELETE FROM `staff` WHERE `login`='$login'";
        $this->link->query($sql);
    }

    function checkPassword($login, $password){
        $pass = md5($password);
        $sql = "SELECT `login` FROM `staff` WHERE `login` = '$login' AND `password` = '$pass'";
        if(mysqli_num_rows($this->link->query($sql))){
            return true;
        }
        else{
            return false;
        }
    }
}