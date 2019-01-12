<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 10.01.2019
 * Time: 11:26
 */
include('DataBase.php');
session_start();

if(count($_SESSION['cart'])){
    $db = new DataBase();
    $overallPrice = 0;
    //echo "<div class='table-responsive'>";
    echo "<table class=\"table\">";
    echo "<thead class=\"thead-dark\">";
    echo "<tr><th scope=\"col\">Name</th><th scope=\"col\">#</th><th scope=\"col\">Price</th><th scope=\"col\" class='text-center'>Remove</th>";
    echo "</tr></thead><tbody>";

    while ($productQuantity = current($_SESSION['cart'])) {
        //echo $db->returnDishName(key($_SESSION['cart']))." Quantity: ".$product.' Remove | Edit quantity';
        echo "<tr><td>{$db->returnDishName(key($_SESSION['cart']))}</td><td>{$productQuantity}</td><td>{$db->returnDishPrice(key($_SESSION['cart']))}$</td><td class='text-center'><a href='#' class=\"fas fa-trash-alt rmfromcart\" id='".key($_SESSION['cart'])."'></a></td></tr>";
        $overallPrice += $productQuantity * $db->returnDishPrice(key($_SESSION['cart']));
        next($_SESSION['cart']);
    }
    //echo "Price: ".number_format((float)$overallPrice, 2, '.', '')."$";
    echo "<td colspan='4' class='text-right'>Total: ".number_format((float)$overallPrice, 2, '.', '')."$</td>";
    echo "</tbody></table>";
    $db->close();
}
else{
    echo "Cart is empty";
}