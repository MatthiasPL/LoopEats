<?php
/**
 * Created by PhpStorm.
 * User: jeste
 * Date: 12.01.2019
 * Time: 15:04
 */

include('DataBase.php');
session_start();

$db = new DataBase();

if(isset($_SESSION['login']) && $db->checkChefPrivileges($_SESSION['login'])){
    $fp = fopen('orders/lock', 'r+');
    if($lock = flock($fp, LOCK_EX)){
        $inp = file_get_contents('orders/orders.json');
        $tempArray = json_decode($inp, TRUE);

        echo "<div class='row'>";

        foreach ($tempArray as $key => $val) {
            $time[$key] = $val['time'];
        }

        array_multisort($time, SORT_ASC, $tempArray);

        foreach ($tempArray as $order){
            echo "<div class='col-sm-12 col-md-4 h-100'>";
            echo "<table class=\"table\"><thead class=\"thead-dark\"><tr><th scope='col' colspan='2' class='text-center'>{$order['id']} - {$order['time']}</th></tr></tr><tr><th scope=\"col\">Name</th><th scope=\"col\">#</th></tr></thead><tbody>";
            //echo $order['surname'];
            foreach ($order['products'] as $products){
                echo "<tr><th scope=\"col\">".$db->returnDishName($products['id'])."</th><th scope=\"col\">{$products['quantity']}</th></tr>";
            }
            echo "<tr><th scope='col' colspan='2' class='text-right'><a href='#' class=\"fas fa-trash-alt rmfromorders\" id=\"".$order['id']."\"> Remove</a></th></tr>";
            echo "</tbody></table>";
            echo "</div>";
        }

        echo "</div>";
    }
    flock($fp, LOCK_UN);
    fclose($fp);
}

$db->close();