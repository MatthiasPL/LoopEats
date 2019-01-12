<?php

session_start();

if(isset($_POST['dish_id'])){
    unset($_SESSION['cart'][$_POST['dish_id']]);
}