<?php
include('DataBase.php');
session_start();

if(isset($_SESSION['login']) && isset($_POST['dish_name']) && isset($_POST['dish_description']) && isset($_POST['price']) && isset($_POST['vegan_friendly']) && isset($_POST['gluten_free']) && isset($_POST['spicy']) && isset($_POST["contains_nuts"])){
    $db = new DataBase();
    if(isset($_POST['image_link'])){
        $db->addDishWithImage($_POST['dish_name'], $_POST['dish_description'], $_POST['vegan_friendly'], $_POST['gluten_free'], $_POST['spicy'], $_POST['contains_nuts'],$_POST['image_link'], $_POST['price'] );
    }
    else{
        $db->addDishWithoutImage($_POST['dish_name'], $_POST['dish_description'], $_POST['vegan_friendly'], $_POST['gluten_free'], $_POST['spicy'], $_POST['contains_nuts'], $_POST['price'] );
    }
    $db->close();
}