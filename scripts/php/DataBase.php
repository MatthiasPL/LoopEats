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

    function addDishWithImage($dish_name, $dish_description, $vegan_friendly, $gluten_free, $spicy, $contains_nuts, $image_link, $price){
        $sql = "INSERT INTO `dishes` (`dish_id`, `dish_name`, `dish_description`, `vegan_friendly`, `gluten_free`, `spicy`, `contains_nuts` , `image_link`, `price`) VALUES (null, '$dish_name', '$dish_description', '$vegan_friendly', '$gluten_free', '$spicy', '$contains_nuts', '$image_link', $price)";
        $this->link->query($sql);
    }

    function addDishWithoutImage($dish_name, $dish_description, $vegan_friendly, $gluten_free, $spicy, $contains_nuts, $price){
        $sql = "INSERT INTO `dishes` (`dish_id`, `dish_name`, `dish_description`, `vegan_friendly`, `gluten_free`, `spicy`, `contains_nuts` , `image_link`, `price`) VALUES (null, '$dish_name', '$dish_description', '$vegan_friendly', '$gluten_free', '$spicy', '$contains_nuts', null, '$price')";
        echo $sql;
        $this->link->query($sql);
    }

    function removeDish($dish_id){
        $sql = "DELETE FROM `dishes` WHERE `dish_id`=$dish_id";
        $this->link->query($sql);
    }

    function printAllCardsWithDishes(){
        //CHANGE dish cards
        $sql = "SELECT * FROM `dishes`";
        $result = $this->link->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class=\"row\">";
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"col-sm-12 col-md-4 align-items-stretch\">";
                echo "<div class=\"card text-justify h-100\">";
                echo "<div class=\"card-body d-flex flex-column\" id='".$row["dish_id"]."'>";
                echo "<div class=\"card-header\">";
                if($row["gluten_free"]=="1"){
                    echo "<span class=\"badge badge-info\">Gluten free</span> ";
                }
                if($row["vegan_friendly"]=="1"){
                    echo "<span class=\"badge badge-success\">Vegan</span> ";
                }
                if($row["spicy"]=="1"){
                    echo "<span class=\"badge badge-danger\">Spicy</span> ";
                }
                if($row["contains_nuts"]=="1"){
                    echo "<span class=\"badge badge-warning\">Nuts</span> ";
                }
                echo "</div>";
                echo "<h5 class=\"card-title text-center\"><strong>".$row["dish_name"]."</strong> ".$row["price"]."$</h5>";
                if($row["image_link"]!=null){
                    echo "<img class=\"card-img\" src=\"{$row['image_link']}\" alt=\"Card image cap\"><br />";
                }
                echo "<h6 class=\"card-subtitle mb-2 text-muted\">";
                echo $row["dish_description"];
                echo "</h6>";
                echo "<a href=\"#\" class=\"card-link mt-auto rmdish\">Remove from menu</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No dishes";
        }
    }

    function printOrderMenu(){
        //CHANGE dish cards
        $sql = "SELECT * FROM `dishes`";
        $result = $this->link->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class=\"row\">";
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"col-sm-12 col-md-4 align-items-stretch\">";
                echo "<div class=\"card text-justify h-100\">";
                echo "<div class=\"card-body d-flex flex-column\" id='".$row["dish_id"]."'>";
                echo "<div class=\"card-header\">";
                if($row["gluten_free"]=="1"){
                    echo "<span class=\"badge badge-info\">Gluten free</span> ";
                }
                if($row["vegan_friendly"]=="1"){
                    echo "<span class=\"badge badge-success\">Vegan</span> ";
                }
                if($row["spicy"]=="1"){
                    echo "<span class=\"badge badge-danger\">Spicy</span> ";
                }
                if($row["contains_nuts"]=="1"){
                    echo "<span class=\"badge badge-warning\">Nuts</span> ";
                }
                echo "</div>";
                echo "<h5 class=\"card-title text-center\"><strong>".$row["dish_name"]."</strong> ".$row["price"]."$</h5>";
                if($row["image_link"]!=null){
                    echo "<img class=\"card-img\" src=\"{$row['image_link']}\" alt=\"Card image cap\"><br />";
                }
                echo "<h6 class=\"card-subtitle mb-2 text-muted\">";
                echo $row["dish_description"];
                echo "</h6>";
                echo "<div class=\"form-group mt-auto\">";
                echo "<div class=\"row\">";
                echo "<div class=\"col-sm-12 col-md-7\">";
                echo "<input type=\"number\" class=\"form-control\" id=\"quantity\" placeholder=\"Enter quantity\" value='0' min='0' max='200' required>";
                echo "</div>";
                echo "<div class=\"col-sm-12 col-md-5\">";
                echo "<a href=\"#\" class=\"card-link rmdish\">Add to cart</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No dishes";
        }
    }

    function printMenu(){
        //CHANGE dish cards
        $sql = "SELECT * FROM `dishes`";
        $result = $this->link->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class=\"row\">";
            while($row = $result->fetch_assoc()) {
                echo "<div class=\"col-sm-12 col-md-4 align-items-stretch\">";
                echo "<div class=\"card text-justify h-100\">";
                echo "<div class=\"card-body d-flex flex-column\" id='".$row["dish_id"]."'>";
                echo "<div class=\"card-header\">";
                if($row["gluten_free"]=="1"){
                    echo "<span class=\"badge badge-info\">Gluten free</span> ";
                }
                if($row["vegan_friendly"]=="1"){
                    echo "<span class=\"badge badge-success\">Vegan</span> ";
                }
                if($row["spicy"]=="1"){
                    echo "<span class=\"badge badge-danger\">Spicy</span> ";
                }
                if($row["contains_nuts"]=="1"){
                    echo "<span class=\"badge badge-warning\">Nuts</span> ";
                }
                echo "</div>";
                echo "<h5 class=\"card-title text-center\"><strong>".$row["dish_name"]."</strong> ".$row["price"]."$</h5>";
                if($row["image_link"]!=null){
                    echo "<img class=\"card-img\" src=\"{$row['image_link']}\" alt=\"Card image cap\"><br />";
                }
                echo "<h6 class=\"card-subtitle mb-2 text-muted\">";
                echo $row["dish_description"];
                echo "</h6>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "No dishes";
        }
    }
}