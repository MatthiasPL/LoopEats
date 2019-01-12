<?php
session_start();

if(isset($_POST['dish_id']) && isset($_POST['quantity'])){
    $_SESSION['cart'][$_POST['dish_id']]=$_POST['quantity'];
    echo $_SESSION['cart'][$_POST['dish_id']];
}
else{
    //echo "niet";
}
