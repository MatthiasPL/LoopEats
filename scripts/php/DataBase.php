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
        $sql = "INSERT INTO `staff` (`staff_id`, `login`, `password`, `name`, `surname`, `manager`, `chef`) VALUES (null, '$login', '".md5($password)."', '$name', '$surname', '$is_manager', '$is_chef')";
        $this->link->query($sql);
    }

    function removeUser($staff_id){
        $sql = "DELETE FROM `staff` WHERE `staff_id`='$staff_id'";
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

    function checkManagerPrivileges($login){
        $sql = "SELECT `manager` FROM `staff` WHERE `login` = '$login' AND `manager` = '1'";
        if(mysqli_num_rows($this->link->query($sql))){
            return true;
        }
        else{
            return false;
        }
    }

    function checkChefPrivileges($login){
        $sql = "SELECT `login` FROM `staff` WHERE `login` = '$login' AND `chef` = '1'";
        if(mysqli_num_rows($this->link->query($sql))){
            return true;
        }
        else{
            return false;
        }
    }

    function revokeManagerPrivileges($login){
        $sql = "UPDATE `staff` SET `manager` = '0' WHERE `login` = '$login'";
        $this->link->query($sql);
    }

    function grantManagerPrivileges($login){
        $sql = "UPDATE `staff` SET `manager` = '1' WHERE `login` = '$login'";
        $this->link->query($sql);
    }

    function revokeChefPrivileges($login){
        $sql = "UPDATE `staff` SET `chef` = '0' WHERE `login` = '$login'";
        $this->link->query($sql);
    }

    function grantChefPrivileges($login){
        $sql = "UPDATE `staff` SET `chef` = '1' WHERE `login` = '$login'";
        $this->link->query($sql);
    }

    function printAllCardsWithStaff(){
        $sql = "SELECT * FROM `staff`";
        $result = $this->link->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class=\"row\">";
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"col-sm-12 col-md-4 align-items-stretch\">";
                    echo "<div class=\"card h-100\">";
                        echo "<div class=\"card-body\" id='".$row["login"]."'>";
                            echo "<h5 class=\"card-title\">".$row["name"]." ".$row["surname"]."</h5>";
                            echo "<h6 class=\"card-subtitle mb-2 text-muted\">";
                                if($row["manager"]=="1"){
                                    echo "<span class=\"badge badge-info\">Manager</span> ";
                                }
                                if($row["chef"]=="1"){
                                    echo "<span class=\"badge badge-light\">Chef</span>";
                                }
                            echo "</h6>";
                            echo "<a href=\"#\" class=\"card-link rmstaff\">Remove from staff</a><br />";
                            echo "<a href=\"#\" class=\"manager card-link\">";
                            if($row["manager"]=="1"){
                                echo "Revoke";
                            }
                            else{
                                echo "Grant";
                            }
                            echo " manager privileges</a><br />";
                            echo "<a href=\"#\" class=\"chef card-link\">";
                            if($row["chef"]=="1"){
                                echo "Revoke";
                            }
                            else{
                                echo "Grant";
                            }
                            echo " chef privileges</a>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No staff";
        }
    }
}